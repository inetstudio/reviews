<?php

namespace InetStudio\Reviews\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use InetStudio\Reviews\Models\ReviewsSiteModel;
use InetStudio\Reviews\Requests\SaveReviewsSiteRequest;

/**
 * Контроллер для управления сайтами с отзывами.
 *
 * Class ContestByTagStatusesController
 */
class ReviewsSitesController extends Controller
{
    /**
     * Список сайтов с отзывами.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.module.reviews::pages.sites.index', [
            'items' => ReviewsSiteModel::get(),
        ]);
    }

    /**
     * Добавление сайта с отзывами.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.module.reviews::pages.sites.form', [
            'item' => new ReviewsSiteModel(),
        ]);
    }

    /**
     * Создание сайта с отзывами.
     *
     * @param SaveReviewsSiteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveReviewsSiteRequest $request)
    {
        return $this->save($request);
    }

    /**
     * Редактирование сайта с отзывами.
     *
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id = null)
    {
        if (! is_null($id) && $id > 0) {
            $item = ReviewsSiteModel::where('id', '=', $id)->first();
        } else {
            abort(404);
        }

        if (empty($item)) {
            abort(404);
        }

        return view('admin.module.reviews::pages.sites.form', [
            'item' => $item,
        ]);
    }

    /**
     * Обновление сайта с отзывами.
     *
     * @param SaveReviewsSiteRequest $request
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SaveReviewsSiteRequest $request, $id = null)
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение сайта с отзывами.
     *
     * @param $request
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse
     */
    private function save($request, $id = null)
    {
        if (! is_null($id) && $id > 0) {
            $edit = true;
            $item = ReviewsSiteModel::where('id', '=', $id)->first();

            if (empty($item)) {
                abort(404);
            }
        } else {
            $edit = false;
            $item = new ReviewsSiteModel();
        }

        $params = [
            'name' => trim(strip_tags($request->get('name'))),
            'alias' => trim(strip_tags($request->get('alias'))),
            'link' => trim(strip_tags($request->get('link'))),
        ];

        if ($edit) {
            $params['last_editor_id'] = Auth::id();
        } else {
            $params['author_id'] = Auth::id();
            $params['last_editor_id'] = $params['author_id'];
        }

        $item->fill($params);
        $item->save();

        $item->clearMediaCollection('images');
        $item->addMediaFromRequest('logo')->toMediaCollection('images', 'reviews_sites');

        $action = ($edit) ? 'отредактирован' : 'создан';
        Session::flash('success', 'Сайт с отзывами «'.$item->name.'» успешно '.$action);

        return redirect()->to(route('back.reviews.sites.edit', $item->fresh()->id));
    }

    /**
     * Удаление сайта с отзывами.
     *
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id = null)
    {
        if (! is_null($id) && $id > 0) {
            $item = ReviewsSiteModel::where('id', '=', $id)->first();
        } else {
            return response()->json([
                'success' => false,
            ]);
        }

        if (empty($item)) {
            return response()->json([
                'success' => false,
            ]);
        }

        $item->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
