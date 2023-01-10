<livewire-custom>
    <input wire:model="search" type="text" class="form-control" />

    <ul class="mt-3">
        @foreach($articles as $article)
        <li>{{ $article->title }}</li>
        @endforeach
    </ul>
</livewire-custom>
