<?php

namespace App\Models;

use App\Enums\WineTypeStatus;
use App\Enums\WineTypeApproveStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WineType extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => WineTypeStatus::class,
        'is_approved' => WineTypeApproveStatus::class
    ];

}
