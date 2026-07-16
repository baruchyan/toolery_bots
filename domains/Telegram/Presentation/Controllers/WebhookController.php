<?php

declare(strict_types=1);

namespace Telegram\Presentation\Controllers;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Telegram\Infrastructure\Models\Bot;

class WebhookController extends ApiController
{
    public function __invoke(Bot $bot): JsonResponse|Response
    {
        return new JsonResponse([]);
    }


}
