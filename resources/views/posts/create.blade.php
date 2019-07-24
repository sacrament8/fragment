@extends('layouts.app')
@section('title', '質問投稿ページ')
@section('css')
  <link rel="stylesheet" href="/css/form.css">
@endsection
@section('content')
  <div class="container">
    <div class="row">
      <form class="mt-5" action="/posts/store" method="POST">
        @csrf
        <div class="form-group">
          <label>タイトル <input type="text" name="title"></label>
        </div>
        <div class="form-group">
          <label>ソースコード <textarea class="src-area" name="src"></textarea></label>
        </div>
        <div class="form-group">
          <label>質問内容 <textarea name="content"></textarea></label>
        </div>
        <div>
          <input class="btn btn-primary" type="submit" value="投稿">
        </div>
      </form>
    </div>
  </div>
@endsection