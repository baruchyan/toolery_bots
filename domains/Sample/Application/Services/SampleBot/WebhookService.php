<?php

declare(strict_types=1);

namespace Sample\Application\Services\SampleBot;


use Telegram\Application\Abstracts\AbstractWebhookService;


class WebhookService extends AbstractWebhookService
{

    public function handle(): void
    {
//        AbstractCommandHandler::makeCommands(bot: $this->bot, commands: $this->config['commands'] ?? [], telegramBotEnum: $this->telegramBotEnum);
//
//        $callbackQueryTypeHandler = new CallbackQueryTypeHandler(bot: $this->bot, config: $this->config);
//        $callbackQueryTypeHandler->setTelegramBotEnum(telegramBotEnum: $this->telegramBotEnum);
//        $callbackQueryTypeHandler->handle();
//
//        $this->bot->on(function (Update $update) {
//
//            try {
//                $message = $update->getMessage();
//
//                if (is_null($message)) {
//                    return;
//                }
//
//                $messageTypeHandler = new MessageTypeHandler(bot: $this->bot, config: $this->config ?? []);
//                $messageTypeHandler->setTelegramBotEnum(telegramBotEnum: $this->telegramBotEnum);
//                $messageTypeHandler->handle(message: $message);
//            } catch (UserNotFoundException $exception) {
//                $this->bot->sendMessage($message->getChat()->getId(), 'Пользователь не найден. Обратитесь к администратору');
//            } catch (\Exception $exception) {
//                Log::error('wheel.telegram.webhook.error', [$exception->getMessage(), $exception->getTrace()]);
//            }
//
//        }, function () {
//            return true;
//        });
//
//        $this->bot->run();
    }
}
