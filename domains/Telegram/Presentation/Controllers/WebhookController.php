<?php

declare(strict_types=1);

namespace Telegram\Presentation\Controllers;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Telegram\Domain\Enums\BotEnum;

class WebhookController extends ApiController
{
    public function __invoke(BotEnum $bot): JsonResponse|Response
    {
        try {

            // создать модели и миграции
            // подключить moonshine




//            $service = AbstractWebhookService::make(bot: $bot);
//
//            $service->handle();
//
            return response('ok', Response::HTTP_OK);

        } catch (\Exception $exception) {
//            Log::error($exception->getMessage(), $exception->getTrace());
//
//            return ResponseHelper::makeExceptionResponse(message: 'Webhook ' . $bot->value . ' error', exception: $exception);
            return response('ok', Response::HTTP_OK);
        }
    }


}
