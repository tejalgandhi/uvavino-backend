<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use GemaDigital\Framework\app\Models\Traits\SaveMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class Article extends Model
{
    use CrudTrait;
    use Sluggable, SluggableScopeHelpers;
    use HasTranslations;
    use SaveMedia;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'articles';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['slug', 'title', 'content', 'image', 'images', 'videos', 'category_id', 'documents', 'related', 'link', 'featured', 'date', 'status'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $translatable = ['title', 'content'];
    protected $casts = [
        'featured' => 'boolean',
        'date' => 'date',
        'images' => 'array',
        'videos' => 'array',
        'documents' => 'array',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug_or_title',
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function sync($operation)
    {
        Cache::forget('featured_articles');
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class, 'article_tag');
    }

    public function articles()
    {
        return $this->belongsToMany(\App\Models\Article::class, 'article_related', 'article_id', 'related_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopePublished($query)
    {
        return $query->where('status', 'publish')
            ->where('date', '<=', date('Y-m-d'))
            ->orderBy('date', 'DESC');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    // The slug is created automatically from the "title" field if no slug exists.
    public function getSlugOrTitleAttribute()
    {
        if ($this->slug !== '') {
            return $this->slug;
        }

        return $this->title;
    }

    public function getFormattedDateSimpleAttribute()
    {
        return $this->date->format('d').'/'.$this->date->format('m').'/'.$this->date->format('Y');
    }

    public function getFormattedDateAttribute()
    {
        return $this->date->format('d').' '.__($this->date->format('F')).' '.$this->date->format('Y');
    }

    public function getTitleTranslatedAttribute()
    {
        return $this->title;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setDocumentsAttribute($value)
    {
        $attribute_name = 'documents';
        $disk = 'uploads';
        $destination_path = 'articles/documents';

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }

    public function setImageAttribute($value)
    {
        $filename = $this->attributes['title'];
        $this->saveImage($this, $value, 'articles/', $filename, [1280, 384], 85);
    }

    public function toArray()
    {
        $data = parent::toArray();

        $data['title_translated'] = $this->title;

        return $data;
    }
}
