<?php

namespace InetStudio\Reviews\Messages\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InetStudio\Reviews\Messages\Contracts\Services\Back\MessagesModerateServiceContract;
use InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\MessagesControllerContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Moderate\ReadResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Moderate\DestroyResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Moderate\ActivityResponseContract;

/**
 * Class MessagesModerateController.
 */
class MessagesModerateController extends Controller implements MessagesControllerContract
{
    /**
     * Изменение активности.
     *
     * @param Request $request
     * @param MessagesModerateServiceContract $moderateService
     *
     * @return ActivityResponseContract
     */
    public function activity(Request $request, MessagesModerateServiceContract $moderateService): ActivityResponseContract
    {
        $ids = $request->get('messages') ?? [];

        $result = $moderateService->updateActivity($ids);

        return app()->makeWith(ActivityResponseContract::class, compact('result'));
    }

    /**
     * Пометка "прочитано".
     *
     * @param Request $request
     * @param MessagesModerateServiceContract $moderateService
     *
     * @return ReadResponseContract
     */
    public function read(Request $request, MessagesModerateServiceContract $moderateService): ReadResponseContract
    {
        $ids = $request->get('messages') ?? [];

        $result = $moderateService->updateRead($ids);

        return app()->makeWith(ReadResponseContract::class, compact('result'));
    }

    /**
     * Удаление комментариев.
     *
     * @param Request $request
     * @param MessagesModerateServiceContract $moderateService
     *
     * @return DestroyResponseContract
     */
    public function destroy(Request $request, MessagesModerateServiceContract $moderateService): DestroyResponseContract
    {
        $ids = $request->get('messages') ?? [];

        $result = $moderateService->destroy($ids);

        return app()->makeWith(DestroyResponseContract::class, compact('result'));
    }
}
