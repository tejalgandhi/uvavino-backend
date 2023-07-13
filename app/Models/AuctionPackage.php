<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use GemaDigital\Framework\app\Models\Traits\SaveMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AuctionPackage extends Model
{
    use CrudTrait;
    use SaveMedia;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'auction_packages';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    const MAX_DEPTH = 1;

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($obj) {
            \Storage::disk('uploads')->delete($obj->image);
        });
    }
    public function setSlugAttribute($value)
    {
        $name = $this->attributes['name'] ?? '';
        $slug = Str::slug($name, '-');
        if (isset($this->attributes['id'])) {
            $count = $this->whereSlug($slug)->where('id', '!=', $this->attributes['id'])->count();
            if ($count > 0) {
                $count++;
                $slug = $slug . '-' . $count;
            }
        }
        $this->attributes['slug'] = $slug;
    }
    public function setImageAttribute($value)
    {
        $filename = uniqid();
        $this->saveImage($this, $value, 'uvavino/img/', $filename, [], 100, 'image');
    }
}
