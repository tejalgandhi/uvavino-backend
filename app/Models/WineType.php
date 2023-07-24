<?php

namespace App\Models;

use App\Enums\WineTypeStatus;
use App\Enums\WineTypeApproveStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WineType extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    protected $table = 'wine_types';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $casts = [
        'status' => WineTypeStatus::class,
        'is_approved' => WineTypeApproveStatus::class
    ];

}
