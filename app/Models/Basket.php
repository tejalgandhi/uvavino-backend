<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'baskets';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

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
    public static function pluckedWithProductReference()
    {
        $products =  self::select('id','name')->with('products')->get();
        $pluckArray = [];
        foreach ($products as $key => $value) {
            foreach ($value->products as $childKey => $childValue ) {
                $pluckArray[$childValue->pivot->id] = "{$value->wine_name} - {$childValue->pivot->id}";
            }
        }
        return $pluckArray;
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'products', 'basket_id', 'id')->withPivot(['id']);
    }
    public function product()
    {
        return $this->hasMany( Product::class, 'basket_id', 'id');
    }
}
