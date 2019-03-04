<?php

namespace InetStudio\Reviews\Messages\Models\Traits;

/**
 * Trait HasReviews.
 */
trait HasReviews
{
    /**
     * Get Review class name.
     *
     * @return string
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
     */
    public function reviews()
    {
        return $this->morphMany(static::getReviewClassName(), 'reviewable');
    }
}
