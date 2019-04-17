<?php

namespace InetStudio\Reviews\Sites\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\Uploads\Models\Traits\HasImages;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract;
use InetStudio\AdminPanel\Base\Models\Traits\Scopes\BuildQueryScopeTrait;

/**
 * Class SiteModel.
 */
class SiteModel extends Model implements SiteModelContract
{
    use HasImages;
    use SoftDeletes;
    use BuildQueryScopeTrait;

    /**
     * @var array
     */
    protected $images = [
        'config' => 'reviews_sites',
        'model' => 'site',
    ];

    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'reviews_sites';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'alias',
        'link',
        'is_active',
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
     */
    protected static function boot()
    {
        parent::boot();

        self::$buildQueryScopeDefaults['columns'] = [
            'id',
            'name',
            'alias',
            'link',
            'is_active',
        ];

        self::$buildQueryScopeDefaults['relations'] = [
            'messages' => function ($query) {
                $query->select(['id', 'site_id', 'link', 'user_name', 'message', 'is_active']);
            },
        ];
    }

    /**
     * Сеттер атрибута name.
     *
     * @param $value
     */
    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута alias.
     *
     * @param $value
     */
    public function setAliasAttribute($value): void
    {
        $this->attributes['alias'] = trim(strtolower(strip_tags($value)));
    }

    /**
     * Сеттер атрибута link.
     *
     * @param $value
     */
    public function setLinkAttribute($value): void
    {
        $this->attributes['link'] = trim(strip_tags($value));
    }

    /**
     * Отношение "один ко многим" с моделью отзывов.
     *
     * @return HasMany
     *
     * @throws BindingResolutionException
     */
    public function messages(): HasMany
    {
        $messageModel = app()->make('InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract');

        return $this->hasMany(
            get_class($messageModel),
            'site_id',
            'id'
        );
    }
}
