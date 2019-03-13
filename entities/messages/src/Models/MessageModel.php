<?php

namespace InetStudio\Reviews\Messages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\ACL\Users\Models\Traits\HasUser;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\AdminPanel\Base\Models\Traits\Scopes\BuildQueryScopeTrait;

/**
 * Class MessageModel.
 */
class MessageModel extends Model implements MessageModelContract
{
    use HasUser;
    use Notifiable;
    use SoftDeletes;
    use BuildQueryScopeTrait;

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
        'site_id', 'title', 'user_id', 'name', 'email', 'user_link',
        'link', 'rating', 'message', 'is_active', 'is_read', 'reviewable_id', 'reviewable_type',
    ];

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

    /**
     * Загрузка модели.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::$buildQueryScopeDefaults['columns'] = [
            'id', 'site_id', 'link', 'name', 'email', 'message', 'is_active', 'is_read',
            'reviewable_id', 'reviewable_type',
        ];

        self::$buildQueryScopeDefaults['relations'] = [
            'site' => function ($query) {
                $query->select(['id', 'name', 'alias', 'link', 'is_active']);
            },
        ];
    }

    /**
     * Сеттер атрибута title.
     *
     * @param $value
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута user_id.
     *
     * @param $value
     */
    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = (int) trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута user_name.
     *
     * @param $value
     */
    public function setUserNameAttribute($value)
    {
        $this->attributes['user_name'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута user_link.
     *
     * @param $value
     */
    public function setUserLinkAttribute($value)
    {
        $this->attributes['user_link'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута link.
     *
     * @param $value
     */
    public function setLinkAttribute($value)
    {
        $this->attributes['link'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута rating.
     *
     * @param $value
     */
    public function setRatingAttribute($value)
    {
        $this->attributes['rating'] = (int) trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута message.
     *
     * @param $value
     */
    public function setMessageAttribute($value)
    {
        $this->attributes['message'] = trim(str_replace("&nbsp;", ' ', strip_tags((isset($value['text'])) ? $value['text'] : (! is_array($value) ? $value : ''))));
    }

    /**
     * Сеттер атрибута is_active.
     *
     * @param $value
     */
    public function setIsActiveAttribute($value)
    {
        $this->attributes['is_active'] = (bool) trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута reviewable_type.
     *
     * @param $value
     */
    public function setReviewableTypeAttribute($value)
    {
        $this->attributes['reviewable_type'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута reviewable_id.
     *
     * @param $value
     */
    public function setReviewableIdAttribute($value)
    {
        $this->attributes['reviewable_id'] = (int) trim(strip_tags($value));
    }

    /**
     * Заготовка запроса "Непрочитанные комментарии".
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', 0);
    }

    /**
     * Заготовка запроса "Активные комментарии".
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * Заготовка запроса "Неактивные комментарии".
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeInactive($query)
    {
        return $query->where('is_active', 0);
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
     * Полиморфное отношение с остальными моделями.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reviewable()
    {
        return $this->morphTo();
    }
}
