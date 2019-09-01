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
      @foreach ($answers as $answer)
        <a href="{{ route('posts.show', ['id'=>$answer->post_id]) }}">
          <div class="card mt-3">
          <div class="card-body">
            <div class="float-left over-flow-hidden truncate">
              <span class="head-icon">●  </span>
                {{ $answer->content }}
            </div>
            <div class="float-right">
              スレッド作成日時: {{ $answer->getCreatedDate() }}
            </div>
          </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</div>
@endsection