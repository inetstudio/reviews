<?php

namespace InetStudio\Reviews\Messages\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\Reviews\Messages\Contracts\Services\Back\ModerateServiceContract;
use InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back\ModerateControllerContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Moderate\ReadResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Moderate\DestroyResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Moderate\ActivityResponseContract;

/**
 * Class ModerateController.
 */
class ModerateController extends Controller implements ModerateControllerContract
{
    /**
     * Изменение активности.
     *
     * @param Request $request
     * @param ModerateServiceContract $moderateService
     *
     * @return ActivityResponseContract
     */
    public function activity(Request $request,
                             ModerateServiceContract $moderateService): ActivityResponseContract
    {
        $ids = $request->get('messages') ?? [];

        $result = $moderateService->updateActivity($ids);

        return $this->app->make(ActivityResponseContract::class, compact('result'));
    }

    /**
     * Пометка "прочитано".
     *
     * @param Request $request
     * @param ModerateServiceContract $moderateService
     *
     * @return ReadResponseContract
     */
    public function read(Request $request,
                         ModerateServiceContract $moderateService): ReadResponseContract
    {
        $ids = $request->get('messages') ?? [];

        $result = $moderateService->updateRead($ids);

        return $this->app->make(ReadResponseContract::class, compact('result'));
    }

    /**
     * Удаление комментариев.
     *
     * @param Request $request
     * @param ModerateServiceContract $moderateService
     *
     * @return DestroyResponseContract
     */
    public function destroy(Request $request,
                            ModerateServiceContract $moderateService): DestroyResponseContract
    {
        $ids = $request->get('messages') ?? [];

        $result = $moderateService->destroy($ids);

        return $this->app->make(DestroyResponseContract::class, compact('result'));
    }
}
