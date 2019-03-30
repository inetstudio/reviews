<?php

namespace InetStudio\Reviews\Messages\Models\Traits;

use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * Trait HasReviews.
 */
trait HasReviews
{
    /**
     * Get Review class name.
     *
     * @return string
     *
     * @throws BindingResolutionException
     */
    public static function getReviewClassName(): string
    {
        $model = app()->make('InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract');

        return get_class($model);
    }

    /**
     * Set the polymorphic relation.
     *
     * @return mixed
     *
     * @throws BindingResolutionException
     */
    public function reviews()
    {
        return $this->morphMany(static::getReviewClassName(), 'reviewable');
    }
}
