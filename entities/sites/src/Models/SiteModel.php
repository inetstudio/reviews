<?php

namespace InetStudio\Reviews\Sites\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\Uploads\Models\Traits\HasImages;
use InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract;
use InetStudio\AdminPanel\Base\Models\Traits\Scopes\BuildQueryScopeTrait;

/**
 * Class SiteModel.
 */
class SiteModel extends Model implements SiteModelContract, HasMedia
{
    use HasImages;
    use SoftDeletes;
    use BuildQueryScopeTrait;

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
        'name', 'alias', 'link', 'is_active',
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
            'id', 'name', 'alias', 'link', 'is_active',
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
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута alias.
     *
     * @param $value
     */
    public function setAliasAttribute($value)
    {
        $this->attributes['alias'] = trim(strtolower(strip_tags($value)));
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
     * Отношение "один ко многим" с моделью отзывов.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(
            app()->make('InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract'),
            'site_id',
            'id'
        );
    }
}
