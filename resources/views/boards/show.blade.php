@extends('layouts.app')
@section('title', "スレッド詳細")

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-10 offset-1 mt-5">
        <div class="card">
          <div class="card-header text-left font-weight-bold">
             {{ $board->title }}
          </div>
          <div class="card-body">
            {!! nl2br(e($board->content)) !!}
          </div>
          <div class="card-footer text-right">
            スレッド主: 
            <a href="{{ route('users.show', ['id' => $board->user_id]) }}">
              {{ App\User::find($board->user_id)->name }}
            </a>
          </div>
        </div>
        {{--comment index--}}
        @unless ($comments)
          @foreach ($comments as $comment)
            <div class="card">
              {{ $comment->content }}
            </div>
          @endforeach
        @endunless
        {{--comment form--}}
        @include('layouts.errors')
        <form class="mt-5" action="{{ route('boards.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <textarea class="content-area form-control" name="content" id="content-area" rows="5">{{ old('content') }}</textarea>
          </div>
          <div>
            <input class="btn btn-primary col-4 offset-4" type="submit" value="コメントする">
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection