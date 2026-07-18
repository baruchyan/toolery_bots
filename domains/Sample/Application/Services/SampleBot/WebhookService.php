<?php

declare(strict_types=1);

namespace Sample\Application\Services\SampleBot;


use Telegram\Application\Abstracts\AbstractCommandHandler;
use Telegram\Application\Abstracts\AbstractWebhookService;


class WebhookService extends AbstractWebhookService
{

    public function handle(): void
    {

//        $this->client->sendMessage(527857346, '111');

//        return;

        AbstractCommandHandler::makeCommands(bot: $this->bot, client: $this->client);
//
//        $callbackQueryTypeHandler = new CallbackQueryTypeHandler(bot: $this->bot, config: $this->config);
//        $callbackQueryTypeHandler->setTelegramBotEnum(telegramBotEnum: $this->telegramBotEnum);
//        $callbackQueryTypeHandler->handle();
//
//        $this->client->on(function (Update $update) {
////
//            $message = $update->getMessage();
//
//            $this->bot->sendMessage($message->getChat()?->getId(), '111');
//
//
////            try {
////
////
////                if (is_null($message)) {
////                    return;
////                }
////
////                $messageTypeHandler = new MessageTypeHandler(bot: $this->bot, config: $this->config ?? []);
////                $messageTypeHandler->setTelegramBotEnum(telegramBotEnum: $this->telegramBotEnum);
////                $messageTypeHandler->handle(message: $message);
////            } catch (UserNotFoundException $exception) {
////                $this->bot->sendMessage($message->getChat()->getId(), 'Пользователь не найден. Обратитесь к администратору');
////            } catch (\Exception $exception) {
////                Log::error('wheel.telegram.webhook.error', [$exception->getMessage(), $exception->getTrace()]);
////            }
////
//        }, function () {
//            return true;
//        });
//
        $this->client->run();
    }
}
