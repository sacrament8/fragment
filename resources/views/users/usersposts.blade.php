@extends('layouts.app')
@section('content')
@section('css')
  <link rel="stylesheet" href="/css/users_show.css">
  <link rel="stylesheet" href="/css/posts-index.css">
@endsection
@section('content')
<div class="container mt-5">
  <div class="row">
    <div class="col-10 offset-1 my-2">
      @foreach ($posts as $post)
        <a href="{{ route('posts.show', ['id'=>$post->id]) }}">
          <div class="card mt-3">
          <div class="card-body">
            <div class="float-left">
              <span class="head-icon">●  </span>
              {{ $post->title }}
            </div>
            <div class="float-right">
              スレッド作成日時: {{ $post->getCreatedDate() }}
            </div>
          </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</div>
@endsection