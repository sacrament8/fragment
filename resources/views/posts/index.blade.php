@extends('layouts.app')
@section('title', '質問一覧')
@section('css')
  <link rel="stylesheet" href="/css/posts-index.css">
@endsection
@section('content')
  <div class="container">
    <div class="row">
      <!-- 投稿検索フォーム -->
      <div class="col-10 offset-1 my-1">
          <form action="{{ route('posts.index') }}" method="GET">
            <div class="row mt-4">
              <div class="form-group offset-2 col-5">
                <input type="text" value="" class="form-control" name="search" placeholder="質問投稿のタイトルを入力してください">
              </div>
              <div class="form-group col-3">
                <input type="submit" class="btn-primary btn form-control" value="質問投稿を探す">
              </div>
            </div>
          </form>
        </div>
        <!-- 投稿一覧 -->
      @if ($posts->isEmpty())
        <div class="col-10 offset-1 mt-5">
          <div class="card">
            <p class="text-center py-5 h4">質問が存在しません</p>
          </div>
        </div>
      @else
        @foreach ($posts as $post)
          <div class="col-10 offset-1 my-2">
            <a href="{{ route('posts.show', ['id'=>$post->id]) }}">
              <div class="card">
                <div class="card-body">
                  <div class="float-left"><span class="head-icon">●  </span>{{ $post->title }}</div>
                  <div class="float-right"> [回答数: {{ $post->getHasAnswerCount($post->id) }}]</div>
                  <div class="float-right">投稿日時: {{ $post->getCreatedDate() }}</div>
                </div>
              </div>
            </a>
          </div>
        @endforeach
        <div class="my-4 mx-auto">
          {{ $posts->appends(request()->query())->links() }}
        </div>
      @endif
    </div>
  </div>
@endsection