@extends(backpack_view('blank'))

@push('before_styles')
@livewireStyles
@endpush

@push('after_scripts')
@livewireScripts
@endpush

@section('content')
<div class="jumbotron">
    <h1 class="mb-4">{{ $title }}</h1>

    @livewire("custom")
</div>
@endsection
