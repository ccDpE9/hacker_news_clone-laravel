@extends('main')

@section('content')

    <a href="{{ $link->url }}"><p>{{ $link->title }}</p></a>
    <p>{{ $link->description }}</p>
    <p>{{ $link->created_at }}</p>
    @include('comments.create', ['link_id' => $link->id])

    @foreach ($comments as $comment)
        <div class="thread">
            <div class="thread__comment comment">
                <span class="thread__comment__author">
                    <a href="#">{{ $comment->user->name }}</a>
                </span>
                <span class="thread__comment__date">
                    {{ $comment->created_at }}
                </span>
                <p class="thread__comment__body">{{ $comment->body }}</p>
                <p class="btn--reply">reply</p>
            </div>
            @include ('comments.show', ['comments' => $comment->replies])
        </div>
    @endforeach

@endsection
    
