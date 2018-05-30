<?php

namespace InetStudio\Reviews\Sites\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\Uploads\Models\Traits\HasImages;
use InetStudio\Reviews\Sites\Contracts\Models\SiteModelContract;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

/**
 * Class SiteModel.
 */
class SiteModel extends Model implements SiteModelContract, HasMediaConversions
{
    use HasImages;
    use SoftDeletes;

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

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strip_tags($value);
    }

    public function setAliasAttribute($value)
    {
        $this->attributes['alias'] = strtolower(strip_tags($value));
    }

    public function setLinkAttribute($value)
    {
        $this->attributes['link'] = strip_tags($value);
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
            'site_id', 'id'
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
