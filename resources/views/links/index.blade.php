@extends('main')

@section('content')

    @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section>
        <!-- $links->count() -->
        @foreach($links as $link)
            <div class="link" data-linkid="{{ $link->id }}">
                <div class="link__info">
                    <a class="link__btn link__title" href="{{ $link->url }}" target="_blank"><span class="num">{{ $loop->iteration }}. {{ $link->title }}</a>
                    <div class="link__meta">
                        <span>
                            <img src="/img/like.svg" class="icon" />
                        </span>
                        <span>
                            <img src="/img/avatar.svg" class="icon"/>
                            <a class="link__btn link__author" 
                               href="{{ route('profile.show', $link->user()->first()->name) }}" 
                               target="_blank">
                               {{ $link->user()->first()->name }}
                            </a>
                        </span>
                        <span>
                            <img src="/img/time.svg" class="icon" />
                            {{ $link->date() }}
                        </span>
                        <span>
                            <a class="link__btn link__url" href="{{ $link->url }}" target="_blank">{{ $link->baseUrl() }}</a>
                        </span>
                    </div>
                </div>
                <div class="link__social">
                    <a class="link__btn link__comments" href="{{ route('links.show', $link->id) }}">Comments</a>
                    <a href="#"><img src="/img/network.svg" class="icon--social" /></a>
                    @if (auth()->user())
                        <a class="link__btn link__upvote" href="#" class="link__upvote--btn"><img src="/img/star.svg" class="icon--social" /></a>
                    @else
                        <a class="link__btn link__upvote" href="{{ route('login') }}"><img src="/img/star.svg" class="icon--social" /></a>
                    @endif
                </div>
            </div>
        @endforeach
    </section>

    <script>
        var url = '{{ route('upvotes.store') }}';
    </script>

@endsection
