@extends('layouts.app')

@section('title', 'スレッド作成')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-10 offset-1">
        @include('layouts.errors')
      <form class="mt-5" action="{{ route('boards.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="title-arae">タイトル</label>
            <input type="text" name="title" id="title-area" class="form-control" value="{{ old('title') }}">
          </div>
          <div class="form-group">
            <label for="content-area">スレッド説明</label><br>
            <textarea class="content-area form-control" name="content" id="source-area" rows="8">{{ old('content') }}</textarea>
          </div>
          <div>
            <input class="btn btn-primary col-4 offset-4" type="submit" value="スレッドを作成する">
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
