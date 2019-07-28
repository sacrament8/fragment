@extends('layouts.app')
@section('title', '質問投稿ページ')
@section('css')
  <link rel="stylesheet" href="/css/form.css">
@endsection
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-10 offset-1">
        @include('layouts.errors')
        <form class="mt-5" action="/posts/store" method="POST">
          @csrf
          <div class="form-group">
            <label for="title-arae">タイトル</label>
            <input type="text" name="title" id="title-area" class="form-control" value="{{ old('title') }}">
          </div>
          <div class="form-group">
            <label for="source-area">ソースコード</label><br>
            <textarea class="src-area form-control" name="src" id="source-area" rows="8">{{ old('src') }}</textarea>
          </div>
          <div class="form-group">
            <label for="content-area">質問内容</label>
            <textarea name="content" id="content-area" class="form-control" rows="6">{{ old('content') }}</textarea>
          </div>
          <div>
            <input class="btn btn-primary col-4 offset-4" type="submit" value="投稿">
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
