<?php

namespace InetStudio\Reviews\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use InetStudio\Reviews\Models\ReviewsFeedbackModel;
use InetStudio\Reviews\Requests\SaveReviewsFeedbackRequest;

/**
 * Контроллер для управления отзывами.
 *
 * Class ContestByTagStatusesController
 */
class ReviewsFeedbacksController extends Controller
{
    /**
     * Список отзывов.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.module.reviews::pages.feedbacks.index', [
            'items' => ReviewsFeedbackModel::with('site')->get(),
        ]);
    }

    /**
     * Добавление отзыва.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.module.reviews::pages.feedbacks.form', [
            'item' => new ReviewsFeedbackModel(),
        ]);
    }

    /**
     * Создание отзыва.
     *
     * @param SaveReviewsFeedbackRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveReviewsFeedbackRequest $request)
    {
        return $this->save($request);
    }

    /**
     * Редактирование отзыва.
     *
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id = null)
    {
        if (! is_null($id) && $id > 0) {
            $item = ReviewsFeedbackModel::where('id', '=', $id)->first();
        } else {
            abort(404);
        }

        if (empty($item)) {
            abort(404);
        }

        return view('admin.module.reviews::pages.feedbacks.form', [
            'item' => $item,
        ]);
    }

    /**
     * Обновление отзыва.
     *
     * @param SaveReviewsFeedbackRequest $request
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SaveReviewsFeedbackRequest $request, $id = null)
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение отзыва.
     *
     * @param $request
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse
     */
    private function save($request, $id = null)
    {
        if (! is_null($id) && $id > 0) {
            $edit = true;
            $item = ReviewsFeedbackModel::where('id', '=', $id)->first();

            if (empty($item)) {
                abort(404);
            }
        } else {
            $edit = false;
            $item = new ReviewsFeedbackModel();
        }

        $params = [
            'site_id' => trim(strip_tags($request->get('site_id'))),
            'title' => trim(strip_tags($request->get('title'))),
            'user' => trim(strip_tags($request->get('user'))),
            'feedback' => trim($request->get('feedback')),
            'link' => trim(strip_tags($request->get('link'))),
            'rating' => trim(strip_tags($request->get('rating'))),
        ];

        if ($edit) {
            $params['last_editor_id'] = Auth::id();
        } else {
            $params['author_id'] = Auth::id();
            $params['last_editor_id'] = $params['author_id'];
        }

        $item->fill($params);
        $item->save();

        $action = ($edit) ? 'отредактирован' : 'создан';
        Session::flash('success', 'Отзыв успешно '.$action);

        return redirect()->to(route('back.reviews.feedbacks.edit', $item->fresh()->id));
    }

    /**
     * Удаление отзыва.
     *
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id = null)
    {
        if (! is_null($id) && $id > 0) {
            $item = ReviewsFeedbackModel::where('id', '=', $id)->first();
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

    /**
     * Возвращаем отзывы для вывода на сайт.
     *
     * @param string $alias
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFeedbacks($alias = '')
    {
        $result = \Cache::remember('reviews_'.$alias, 60, function () use ($alias) {
            $items = ($alias) ? ReviewsFeedbackModel::with('site')->whereHas('site', function ($query) use ($alias) {
                $query->where('alias', $alias);
            })->get() : ReviewsFeedbackModel::get();

            $items = $items->map(function ($item) {
                return [
                    'siteName' => $item->site->alias,
                    'id' => $item->id,
                    'stars' => $item->rating,
                    'body' => $item->feedback,
                    'title' => $item->title,
                    'authorName' => $item->user,
                    'url' => $item->link,
                ];
            });

            $result = [];

            if (! $alias) {
                foreach ($items as $item) {
                    $result[$item['siteName']][] = $item;
                }
            } else {
                $result = $items;
            }

            return $result;
        });

        return response()->json($result, 200);
    }
}
