@extends('layouts.app')
@section('title', 'スレッド一覧')

@section('css')
  <link rel="stylesheet" href="css/board-index.css">
@endsection

@section('content')
  <div class="container">
    <div class="row">
      @if ($boards->isEmpty())
        <div class="col-10 offset-1 mt-5">
          <div class="card">
            <p class="text-center py-5 h4">スレッドが存在しません</p>
          </div>
          <div class="text-right mt-2">
            <a class="btn btn-primary" href="{{ route('boards.create') }}">スレッドを新規作成</a>
          </div>
        </div>
      @else
        <div class="col-10 offset-1 my-2">
          @foreach ($boards as $board)
            <a href="{{ route('boards.show', ['id'=>$board->id]) }}">
              <div class="card mt-3">
              <div class="card-body">
                <div class="float-left">
                {{ $board->title }}
                </div>
                <div class="float-right">
                  スレッド作成日時: {{ $board->getCreatedDate() }}
                </div>
              </div>
              </div>
            </a>
          @endforeach
          <div class="mt-5">
            <a class="btn btn-primary col-12" href="{{ route('boards.create') }}">スレッドを新規作成</a>
          </div>
        </div>
      @endif
    </div>
  </div>
@endsection