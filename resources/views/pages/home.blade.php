@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ ucfirst(__("articles")) }}</h2>
    <ul>
        @foreach($featured_articles as $article)
        <li>{{ $article->title }}</li>
        @endforeach
    </ul>
</div>
@endsection
