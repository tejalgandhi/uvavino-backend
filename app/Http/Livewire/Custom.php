<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;

class Custom extends Component
{
    public $articles;
    public $search = '';

    public function render()
    {
        return view('livewire.custom');
    }

    public function mount()
    {
        $this->updatedSearch();
    }

    public function updatedSearch()
    {
        $this->articles = Article::where('title', 'LIKE', "%$this->search%")->limit(10)->get();
    }
}
