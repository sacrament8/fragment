@extends('layouts.app')
@section('content')
@section('css')
  <link rel="stylesheet" href="/css/users_show.css">
@endsection
<div class="container mt-5">
  <div class="row">
    
    <!-- side menu -->
    <div class="col-3 mt-3">
      <div class="card">
        <div class="card-header bg-dark text-light text-center">
          User Infomation
        </div>
        @if (false)  <!--user_infoインスタンスのavaterカラムが空なら-->
          hoge
        @else
          <img class="card-img-top" src="/images/no-image.jpg" alt="アバター画像">
        @endif
        <div class="card-body side">
          <div class="text-center mb-3 mt-2">
            <a href="#" class="btn btn-primary">アバター変更</a>
          </div>
          <div class="info">
            ユーザー名: {{ Auth::user()->name }}
          </div>
          <div class="info">
          質問回数: {{ $selfPostsCount }}
          </div>
          <div class="info">
          回答回数: {{ $selfAnswersCount }}
          </div>
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
                  <th>投稿日時</th>
                </tr>
                @foreach ($posts as $post)
                  <tr class="change-opacity">
                    <td>
                      <a class="table_link col-12 text-dark" href="{{ route('posts.show', ["id"=>$post->id]) }}">
                        {{ $post->title }}
                      </a>
                    </td>
                    <td  style="max-width: 260px; max-height: 80px;">{{ $post->content }}</td>
                    <td>{{ $post->getCreatedDate() }}</td>
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
                <tr class="change-opacity">
                  <th scope="row">まだあたなの回答はありません</th>
                </tr>
              </tbody>
            @else
            <!-- 個人の回答が存在する -->
              <tbody>
                <tr>
                  <th scope="row">投稿タイトル</th>
                  <th scope="row">回答内容</th>
                  <th scope="row">回答日時</th>
                </tr>
                @foreach ($answers as $answer)
                  <tr class="change-opacity">
                    <td>
                      <a class="table_link text-dark" href="{{ route('posts.show', ["id"=>$post->id]) }}">
                        {{ $answer->post->title }}
                      </a>
                    </td>
                    <td style="max-width: 260px; max-height: 80px;">{{ $answer->content}}</td>
                    <td>{{ $answer->getCreatedDate() }}</td>
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