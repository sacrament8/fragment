@extends('layouts.app')
@section('title', '質問一覧')
@section('css')
  <link rel="stylesheet" href="/css/posts-index.css">
@endsection
@section('content')
  <div class="container">
    <div class="row">
      @foreach ($posts as $post)
      <div class="col-10 offset-1 my-2">
        <a href="{{ route('posts.show', ['id'=>$post->id]) }}">
          <div class="card">
            <div class="card-body"><div class="float-left">{{ $post->title }}</div><div class="float-right">投稿日時: {{ $post->getPostDate() }}</div></div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
@endsection