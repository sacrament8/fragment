@extends('layouts.app')
@section('content')
@section('css')
  <link rel="stylesheet" href="users_show.css">
@endsection
<div class="container mt-5">
  <div class="row">
    
    <!-- side menu -->
    <div class="col-3 mt-3">
      <div class="card">
        <div class="card-body" style="height: 650px;">
          hoge
        </div>
      </div>
    </div>

    <!-- main menu -->
    <div class="col-9 mt-3">
      <!-- 個人の質問投稿一覧 -->
      <div class="card">
        <div class="card-header bg-primary text-light">あなたの質問投稿 (最新の5件)</div>
          <table class="table mb-0 text-nowrap overflow-hidden">
            <!-- 個人の質問投稿が存在しない -->
            @if (empty($posts))
              <tbody>
                <tr>
                  <th scope="row">まだあたなの投稿質問はありません</th>
                </tr>
              </tbody>
            @else
            <!-- 個人の質問投稿が存在する -->
              <tbody>
                <tr>
                  <th>投稿タイトル</th>
                  <th>質問内容</th>
                </tr>
                @foreach ($posts as $post)
                  <tr>
                    <td>
                      <a class="table_link" href="{{ route('posts.show', ["id"=>$post->id]) }}">
                        {{ $post->title }}
                      </a>
                    </td>
                    <td  style="max-width: 260px; max-height: 80px;">{{ $post->content }}</td>
                  </tr>
                @endforeach
              </tbody>
            @endif
          </table>
        </div>
        <!-- 個人の回答一覧 -->
        <div class="card mt-2">
          <div class="card-header bg-primary text-light">あなたの回答 (最新の5件)</div>
          <table class="table mb-0 text-nowrap overflow-hidden">
            <!-- 個人の回答が存在しない -->
            @if (empty($answers))
              <tbody>
                <tr>
                  <th scope="row">まだあたなの回答はありません</th>
                </tr>
              </tbody>
            @else
            <!-- 個人の回答が存在する -->
              <tbody>
                <tr>
                  <th scope="row">投稿タイトル</th>
                  <th scope="row">回答内容</th>
                </tr>
                @foreach ($answers as $answer)
                  <tr>
                    <td>
                      <a class="table_link" href="{{ route('posts.show', ["id"=>$post->id]) }}">
                        {{ $answer->post->title }}
                      </a>
                    </td>
                    <td style="max-width: 260px; max-height: 80px;">{{ $answer->content}}</td>
                  </tr>
                @endforeach
              </tbody>
            @endif
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection