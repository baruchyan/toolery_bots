<?php

declare(strict_types=1);

namespace Telegram\Presentation\Controllers;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Telegram\Application\Abstracts\AbstractWebhookService;
use Telegram\Infrastructure\Models\Bot;

class WebhookController extends ApiController
{
    public function __invoke(Bot $bot): JsonResponse|Response
    {
        try {
            $service = AbstractWebhookService::make(bot: $bot);
//
            $service->handle();

            return response('ok', Response::HTTP_OK);

        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
//
            return response('ok', Response::HTTP_OK);
        }
    }


}
