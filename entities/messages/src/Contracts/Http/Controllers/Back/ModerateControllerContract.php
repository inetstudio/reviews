<?php

namespace InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\Reviews\Messages\Contracts\Services\Back\ModerateServiceContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Moderate\ReadResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Moderate\DestroyResponseContract;
use InetStudio\Reviews\Messages\Contracts\Http\Responses\Back\Moderate\ActivityResponseContract;

/**
 * Interface ModerateControllerContract.
 */
interface ModerateControllerContract
{
    /**
     * Изменение активности.
     *
     * @param  Request  $request
     * @param  ModerateServiceContract  $moderateService
     *
     * @return ActivityResponseContract
     */
    public function activity(
        Request $request,
        ModerateServiceContract $moderateService
    ): ActivityResponseContract;

    /**
     * Пометка "прочитано".
     *
     * @param  Request  $request
     * @param  ModerateServiceContract  $moderateService
     *
     * @return ReadResponseContract
     */
    public function read(
        Request $request,
        ModerateServiceContract $moderateService
    ): ReadResponseContract;

    /**
     * Удаление комментариев.
     *
     * @param  Request  $request
     * @param  ModerateServiceContract  $moderateService
     *
     * @return DestroyResponseContract
     */
    public function destroy(
        Request $request,
        ModerateServiceContract $moderateService
    ): DestroyResponseContract;
}
