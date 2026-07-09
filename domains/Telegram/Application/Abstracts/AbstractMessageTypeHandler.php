<?php

declare(strict_types=1);

namespace Telegram\Application\Abstracts;

use App\Enums\TelegramActionEnum;
use App\Enums\TelegramBotEnum;
use App\Helpers\TelegramHelper;
use App\Models\TelegramSavedRequest;
use App\Models\User;
use App\Repositories\TelegramSavedRequestRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\Contact;
use TelegramBot\Api\Types\Message;

abstract class AbstractMessageTypeHandler
{

    protected TelegramBotEnum $telegramBotEnum;

    protected bool $processingContact = false;

    protected User|null $user;

    protected AbstractMenuService $menuService;

    protected string $langPath;

    protected bool $removeSavedRequest = true;

    public function __construct(private readonly Client $bot, private readonly array $config)
    {
    }

    public function setTelegramBotEnum(TelegramBotEnum $telegramBotEnum): void
    {
        $this->telegramBotEnum = $telegramBotEnum;
    }

    public function handle(Message $message): void
    {
        $chatId = intval($message->getChat()->getId());

        $this->user = UserService::getOrCreateUserByChatId(chatId: $message->getChat()->getId());

        $this->menuService->setUser(user: $this->user);

        if (
            !is_null($message->getPhoto()) &&
            $this->checkLastRequest(message: $message)
        ) {
            return;
        }


        if (
            is_null($message->getText()) or
            $this->buttonHandle(message: $message) or
            $this->checkLastRequest(message: $message)
        ) {
            return;
        }

        TelegramHelper::sendWithMenu(
            bot: $this->bot,
            chatId: $chatId,
            message: __($this->langPath . '.messages.unknown_command'),
            menu: $this->menuService->makeMainMenuKeyboard()
        );
    }

    private function checkLastRequest(Message $message): bool
    {

        $lastRequest = TelegramSavedRequestRepository::make()->getUserLastRequest(user: $this->user, telegramBot: $this->telegramBotEnum);

        if (is_null($lastRequest)) {
            return false;
        }

        if ($lastRequest->action == TelegramActionEnum::button) {
            $this->buttonRequestHandle(message: $message, buttonName: $lastRequest->name);
        }

        if ($lastRequest->action == TelegramActionEnum::callback) {

        }

        if ($lastRequest->action == TelegramActionEnum::command) {

        }

        if ($lastRequest->action == TelegramActionEnum::customAction) {
            $this->customActionRequestHandle(message: $message, request: $lastRequest);
        }


        if ($this->removeSavedRequest) {
            $lastRequest->delete();
        }

        return true;
    }

    private function buttonHandle(Message $message): bool
    {
        $buttonIndex = AbstractButtonHandler::searchButton(text: $message->getText(), langPath: $this->langPath);

        if (is_null($buttonIndex)) {
            return false;
        }

        $handler = $this->getButtonHandler(message: $message, buttonIndex: $buttonIndex);

        if (is_null($handler)) {
            $this->bot->sendMessage($message->getChat()->getId(), __($this->langPath . '.messages.button_handler_not_found'));

            return true;
        }

        $handler->handle();

        $handler->saveRequest();

        return true;
    }

    private function buttonRequestHandle(Message $message, string $buttonName): void
    {
//        dd(11);
        $buttonIndex = AbstractButtonHandler::searchButton(text: $buttonName, langPath: $this->langPath);

        if (is_null($buttonIndex)) {
            return;
        }

        $handler = $this->getButtonHandler(message: $message, buttonIndex: $buttonIndex);

        if (is_null($handler)) {
            return;
        }

        $handler->handleRequest();

        $this->removeSavedRequest = $handler->getRemoveSavedRequest();
    }

    private function customActionRequestHandle(Message $message, TelegramSavedRequest $request): void
    {
        $handlerClass = $this->config['custom_action_handlers'][$request->name] ?? null;

        if (is_null($handlerClass)) {
            return;
        }

        /** @var AbstractCustomActionHandler $handler */
        $handler = new $handlerClass(user: $this->user, bot: $this->bot, message: $message);
        $handler->setMenuService(menuService: $this->menuService);
        $handler->setTelegramBotEnum(telegramBotEnum: $this->telegramBotEnum);
        $handler->setData(data: $request->data);

        $handler->handleRequest();

        $this->removeSavedRequest = $handler->getRemoveSavedRequest();
    }

    private function getButtonHandler(Message $message, string $buttonIndex): ?AbstractButtonHandler
    {
        if (empty($this->config['button_handlers'][$buttonIndex])) {
            return null;
        }

        /** @var AbstractButtonHandler $handler */
        $handler = new $this->config['button_handlers'][$buttonIndex](user: $this->user, bot: $this->bot, message: $message);
        $handler->setTelegramBotEnum(telegramBotEnum: $this->telegramBotEnum);
        $handler->setMenuService(menuService: $this->menuService);

        return $handler;
    }

}
