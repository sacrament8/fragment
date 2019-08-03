@extends('layouts.app')
@section('title', '回答編集ページ')
@section('css')
  <link rel="stylesheet" href="/css/form.css">
@endsection
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-10 offset-1">
        @include('layouts.errors')
      <form class="mt-5" action="{{ route('answers.update', ['post_id' => $post->id, 'answer_id'=>$answer->id]) }}" method="POST">
          @csrf
          @method('PATCH')
          <div class="form-group">
            <label for="source-area">ソースコード</label><br>
            <textarea class="src-area form-control" name="src" id="source-area" rows="8">{{ old('src', $answer->src) }}</textarea>
          </div>
          <div class="form-group">
            <label for="content-area">回答内容</label>
            <textarea name="content" id="content-area" class="form-control" rows="6">{{ old('content', $answer->content) }}</textarea>
          </div>
          <div>
            <input class="btn btn-primary col-4 offset-4" type="submit" value="修正">
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
