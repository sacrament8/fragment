@extends('layouts.app')

@section('title', '質問詳細')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-10 offset-1">
      <div class="card mt-5">
        <h5 class="card-header">{{ $post->title }}</h5>
        <div class="card-body">
          @unless ($post->src == null)
            <pre><code>{{ $post->src }}</code></pre><br>
          @endunless
          <h5 class="text-center font-weight-bold">質問内容</h5>
          <div class="content">{!! nl2br(e($post->content)) !!}</div>
        </div>
        <div class="card-footer text-right">投稿者: 
          <a href="{{ route('users.show', ['id' => $post->user_id]) }}">
            {{ App\User::find($post->user_id)->name }}
          </a>
        </div>
      </div>
      {{--削除、編集ボタン--}}
      @if ($post->user_id == Auth::id())
        <div class="float-right my-3">
          <form action="{{ route('posts.remove', ['id'=>$post->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger ml-1" type="submit" value="質問を取り下げる" onclick='return confirm("本当に取り下げますか？");'>
          </form>
        </div>
        <div class="float-right mt-3">
          <a class="btn btn-primary" href="{{ route('posts.edit', ['id'=>$post->id]) }}">投稿内容を修正する</a>
        </div>
        <br>
        <br>
      @endif
      {{--answer index--}}
      @unless ($post->answers->isEmpty())
        @foreach ($post->answers as $answer)
          <div class="card mt-5">
            <div class="card-body">
              @unless ($answer->src == null)
                <pre><code>{{ $answer->src }}</code></pre><br>
              @endunless
              <h5 class="text-center font-weight-bold">回答内容</h5>
              <div>
                {!! nl2br(e($answer->content)) !!}
              </div>
            </div>
            <div class="card-footer text-right">
                回答者: 
                <a href="{{ route('users.show', ['id' => $answer->user_id]) }}">
                  {{ App\User::find($answer->user_id)->name }}
                </a>
            </div>
          </div>
          {{--削除、編集ボタン--}}
          @if ($answer->user_id == Auth::id())
            <div class="float-right my-3">
              <form action="{{ route('answers.remove', ['post_id'=>$post->id, 'answer_id'=>$answer->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <input class="btn btn-danger ml-1" type="submit" value="回答を取り下げる" onclick='return confirm("本当に取り下げますか？");'>
              </form>
            </div>
            <div class="float-right mt-3">
              <a class="btn btn-primary" href="{{ route('answers.edit', ['post_id'=>$post->id, 'answer_id'=>$answer->id]) }}">回答内容を修正する</a>
            </div>
            <br>
            <br>
          @endif
        @endforeach
      @endunless
      {{--answer form--}}
      @include('layouts.errors')
      <form class="mt-5" action="{{ route('answers.store', ['id'=>$post->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="form-group">
          <label for="content-area">ソースコード</label>
          <textarea class="src-area form-control" name="src" id="content-area" rows="5">{{ old('src') }}</textarea>
        </div>
        <div class="form-group">
            <label for="content-area">回答内容(必須)</label>
          <textarea class="content-area form-control" name="content" id="content-area" rows="5">{{ old('content') }}</textarea>
        </div>
        <div>
          <input class="btn btn-primary col-4 offset-4 mb-3" type="submit" value="回答する">
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('script')
  @include('scripts.source_hilight')
@endsection