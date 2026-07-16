<?php

declare(strict_types=1);

namespace Telegram\Presentation\MoonShine\Bot;

use App\MoonShine\Resources\MoonShineUser\Pages\MoonShineUserFormPage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use MoonShine\Contracts\Core\DependencyInjection\CrudRequestContract;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\MenuManager\Attributes\Group;
use MoonShine\MenuManager\Attributes\Order;
use MoonShine\Support\Attributes\AsyncMethod;
use MoonShine\Support\Attributes\Icon;
use Telegram\Application\Abstracts\AbstractWebhookService;
use Telegram\Infrastructure\Models\Bot;
use Telegram\Presentation\MoonShine\Bot\Pages\BotDetailPage;
use Telegram\Presentation\MoonShine\Bot\Pages\BotFormPage;
use Telegram\Presentation\MoonShine\Bot\Pages\BotIndexPage;

/**
 * @extends ModelResource<Bot, BotIndexPage, MoonShineUserFormPage, null>
 */
#[Icon('users')]
#[Group('moonshine::ui.resource.system', 'users', translatable: true)]
#[Order(2)]
class BotResource extends ModelResource
{
    protected string $model = Bot::class;

    protected string $column = 'bot';

    protected array $with = [];

    protected bool $simplePaginate = true;

    public function getTitle(): string
    {
        return 'Боты';
    }

    protected function pages(): array
    {
        return [
            BotIndexPage::class,
            BotFormPage::class,
            BotDetailPage::class
        ];
    }

    protected function search(): array
    {
        return [
            'id',
        ];
    }

    #[AsyncMethod]
    public function setWebhook(CrudRequestContract $request): JsonResponse
    {
        try {
            /** @var ?Bot $bot */
            $bot = $request->getResource()?->getItem();

            if (is_null($bot)) {
                return new JsonResponse([
                    'message' => 'Not found',
                ], Response::HTTP_NOT_FOUND);
            }

            $service = AbstractWebhookService::make(bot: $bot);

            $service->setWebhook();

            return new JsonResponse([
                'message' => 'ok',
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return new JsonResponse([
                'message' => $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[AsyncMethod]
    public function getWebhook(CrudRequestContract $request): JsonResponse
    {
        try {
            /** @var ?Bot $bot */
            $bot = $request->getResource()?->getItem();

            if (is_null($bot)) {
                return new JsonResponse([
                    'message' => 'Not found',
                ], Response::HTTP_NOT_FOUND);
            }

            $service = AbstractWebhookService::make(bot: $bot);

            $result = $service->getWebhookInfo();

            return new JsonResponse([
                'message' => 'ok',
                'data' => $result
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return new JsonResponse([
                'message' => $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[AsyncMethod]
    public function deleteWebhook(CrudRequestContract $request): JsonResponse
    {
        try {
            /** @var ?Bot $bot */
            $bot = $request->getResource()?->getItem();

            if (is_null($bot)) {
                return new JsonResponse([
                    'message' => 'Not found',
                ], Response::HTTP_NOT_FOUND);
            }

            $service = AbstractWebhookService::make(bot: $bot);

            $service->deleteWebhook();

            return new JsonResponse([
                'message' => 'ok',
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return new JsonResponse([
                'message' => $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
