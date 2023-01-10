<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use GemaDigital\Framework\app\Http\Controllers\Admin\APICrudController as DefaultAPICrudController;

class APICrudController extends DefaultAPICrudController
{
    /*
    |--------------------------------------------------------------------------
    | Article
    |--------------------------------------------------------------------------
    */
    public function articleSearch()
    {
        return $this->entitySearch(Article::class, ['title', 'content']);
    }

    public function articleFilter()
    {
        return $this->articleSearch()->pluck('title', 'id');
    }
}
