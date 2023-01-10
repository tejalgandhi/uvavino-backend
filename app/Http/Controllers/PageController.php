<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Cache;
use GemaDigital\Framework\app\Http\Controllers\Traits\PageTrait;

class PageController
{
    use PageTrait;

    public function common()
    {
        return [];
    }

    public function home()
    {
        $featured_articles = Cache::rememberForever('featured_articles', function () {
            return Article::select(['slug', 'title', 'content', 'image', 'date'])
                ->published()
                ->featured()
                ->orderBy('created_at', 'desc')
                ->limit(6)
                ->get();
        });

        return [
            'featured_articles' => $featured_articles,
        ];
    }
}
