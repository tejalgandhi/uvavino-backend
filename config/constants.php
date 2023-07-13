<?php


return [
    'bottle_size'=>[
        '10ml'=>'10ml',
        '20ml'=>'20ml'
    ],
    'unit'=>[
        'ml'=>'ml',
        'liters'=>'liters',
    ],
    'front_app_url' => env('FRONT_END_URL')??'http://165.22.72.229/',
    'upload_url' => env('UPLOAD_URL') ?? 'http://165.22.72.229/uploads/',

];
