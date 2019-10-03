@extends('layouts.app')
@section('css')
  <link rel="stylesheet" href="/css/users_show.css">
  <link rel="stylesheet" href="/css/marquee.css">
  <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

@if ($user->id == Auth::id())
  <div class=container-fruid>
    <div class="row">
      <div class="text-warning bg-dark py-1 col-12 marquee">
        <p class="text-right">{{ $today_weather }}</p>
      </div>
    </div>
  </div>
@endif
<div class="container mt-5">
  <div class="row">
    <!-- side menu -->
    <div class="col-3 mt-3">
      <div class="card side-height">
        <h4 class="card-header bg-dark text-light text-center">User Infomation</h4>
        @isset ($user->userInformation->avatar)  <!--userInformationインスタンスのavatarカラムに画像パスがあれば-->
          <img class="card-img-top" src="{{ asset('/storage/avatar_images/'.$user->userInformation->avatar) }}" alt="アバター画像">
        @else
          <img class="card-img-top" src="/images/no-image.jpg" alt="アバター画像">
        @endisset
        <div class="card-body side">
          <div class="text-center mb-1 mt-2">
            <a href="/userinfo/{{ Auth::id() }}/edit" class="btn btn-primary col-12">ユーザー情報登録</a>
          </div>
          <!--follow button-->
          @if (Auth::user()->id != $user->id)
            @if (Auth::user()->isEachFollow($user))
              <div class="text-center mb-3 mt-1">
                <form name="follow" action="/follow/{{$user->id}}" method="POST">
                  @method('DELETE')
                  @csrf
                  <a class="btn btn-primary col-12" href="javascript:follow.submit()">相互フォロー中</a>
                </form>
              </div>
            @elseif (Auth::user()->isFollow($user))
              <div class="text-center mb-3 mt-1">
                <form name="follow" action="/follow/{{$user->id}}" method="POST">
                  @method('DELETE')
                  @csrf
                  <a class="btn btn-primary col-12" href="javascript:follow.submit()">フォロー解除</a>
                </form>
              </div>
            @elseif ($user->isFollowed())
              <div class="text-center mb-3 mt-1">
                <form name="follow" action="/follow/{{$user->id}}" method="POST">
                  @csrf
                  <a class="btn btn-primary col-12" href="javascript:follow.submit()">相互フォローする</a>
                </form>
              </div>
            @else
              <div class="text-center mb-3 mt-1">
                <form name="follow" action="/follow/{{$user->id}}" method="POST">
                  @csrf
                  <a class="btn btn-primary col-12" href="javascript:follow.submit()">フォローする</a>
                </form>
              </div>
            @endif
          @else
            <a class="btn btn-primary col-12" href="/followers">フォロー管理</a>
          @endif
          <div class="info">
            ユーザー名: {{ Auth::user()->name }}
          </div>
          @if (!empty(Auth::user()->userInformation->pref))
            <div class="info">
              所在地: {{ Auth::user()->userInformation->pref }}
            </div>
          @endif
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
        <div class="card-header bg-primary text-light">
          <p class="h5 col-8 align-baseline inline-block">あなたの質問投稿 (最新の5件)</p>
          @if (!$selfPostsCount == 0)
            <a href="{{ route('users.posts', ['user'=>$user->id]) }}" class="col-3 btn btn-success text-light col-3 float-right">全ての質問投稿</a>
          @endif
        </div>
          <table class="table mb-0 text-nowrap overflow-hidden">
            <!-- 個人の質問投稿が存在しない -->
            @if ($selfPostsCount == 0)
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
          <div class="card-header bg-primary text-light">
            <p class="h5 col-8 align-baseline inline-block">あなたの回答 (最新の5件)</p>
            @if (!$selfAnswersCount == 0)
              <a href="{{ route('users.answers', ['user'=>$user->id]) }}" class="col-3 btn btn-success text-light col-3 float-right">全ての回答</a>
            @endif
          </div>
          <table class="table mb-0 text-nowrap overflow-hidden">
            <!-- 個人の回答が存在しない -->
            @if ($selfAnswersCount == 0)
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
                  <th scope="row">回答日時</th>
                </tr>
                @foreach ($answers as $answer)
                  <tr class="change-opacity">
                    <td>
                      <a class="table_link text-dark" href="{{ route('posts.show', ["id"=>$answer->post_id]) }}">
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
<script src="{{ mix('js/app.js') }}"></script>
@endsection