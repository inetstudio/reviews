<?php

namespace InetStudio\Reviews\Messages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;

/**
 * Class MessageModel.
 */
class MessageModel extends Model implements MessageModelContract
{
    use SoftDeletes;

    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'reviews_messages';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'site_id', 'title', 'user_id', 'user_name', 'user_link' , 'link', 'rating', 'message', 'is_active',
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strip_tags($value);
    }

    public function setUserNameAttribute($value)
    {
        $this->attributes['user_name'] = strip_tags($value);
    }

    public function setMessageAttribute($value)
    {
        $this->attributes['message'] = trim(str_replace("&nbsp;", '', strip_tags($value['text'])));
    }

    /**
     * Обратное отношение "один ко многим" с моделью сайта.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo(
            app()->make('InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract'),
            'site_id'
        );
    }

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
