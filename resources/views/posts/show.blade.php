@extends('layouts.app')
@section('title', '質問詳細')
@section('css')
  <link rel="stylesheet" href="/css/posts-show.css">
@endsection
@section('content')
<div class="container">
   <div class="row">
    <div class="col-10 offset-1">
      <div class="card mt-5">
        <h5 class="card-header">タイトル: {{ $post->title }}</h5>
        <div class="card-body">
          @unless ($post->src == null)
            <h5 class="text-center">ソースコード</h5>
            <pre><code>{{ $post->src }}</code></pre><br>
          @endunless
          <h5 class="text-center">質問内容</h5>
          <div class="content">{{ $post->content }}</div>
        </div>
        <div class="card-footer text-right">投稿者: 
          <a href="{{ route('users.show', ['id' => $post->user_id]) }}">
            {{ Auth::user()->name }}
          </a>
        </div>
      </div>
      <div class="float-right mt-3">
        <form action="{{ route('posts.remove', ['id'=>$post->id]) }}" method="POST">
          @csrf
          @method('DELETE')
          <input class="btn btn-danger ml-1" type="submit" value="質問を取り下げる" onclick='return confirm("本当に取り下げますか？");'>
        </form>
      </div>
      <div class="float-right mt-3">
        <a class="btn btn-primary" href="{{ route('posts.edit', ['id'=>$post->id]) }}">投稿内容を修正する</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
  @include('scripts.source_hilight')
@endsection