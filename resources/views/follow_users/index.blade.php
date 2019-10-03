@extends('layouts.app')
@section('css')
  <link rel="stylesheet" href="/css/users_show.css">
  <link rel="stylesheet" href="/css/marquee.css">
@endsection
@section('content')
<div class="container">
  <div class="col-12 h3 text-center pt-4 mb-3">フォロー管理</div>
  <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">UserName</th>
          <th scope="col">FollowStatus</th>
          <th scope="col">ChatRoom</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($followers as $user)
      <tr>
        <td  style="width:45%">{{ $user->name }}</td>
        <!--follow-->
        <td  style="width:25%" class="col-12">
          @if (Auth::user()->isEachFollow($user))
            <form name="follow" action="/follow/{{$user->id}}" method="POST">
              @method('DELETE')
              @csrf
              <input class="btn btn-primary col-8" type="submit" value="相互フォロー中">
            </form>
          @elseif (Auth::user()->isFollow($user))
            <form name="follow" action="/follow/{{$user->id}}" method="POST">
              @method('DELETE')
              @csrf
              <input class="btn btn-primary col-8" type="submit" value="フォロー解除">
            </form>
          @elseif ($user->isFollowed())
            <form name="follow" action="/follow/{{$user->id}}" method="POST">
              @csrf
              <input class="btn btn-primary col-8" type="submit" value="相互フォローする">
            </form>
          @else
            <form name="follow" action="/follow/{{$user->id}}" method="POST">
              @csrf
              <input class="btn btn-primary col-8" type="submit" value="フォローする">
            </form>
          @endif
        </td>
        <!--chat-->
        <td  style="width:25%">
            @if (Auth::user()->isEachFollow($user))
              入室
            @elseif (Auth::user()->isFollow($user))
              相互フォロー時のみ使用可
            @elseif ($user->isFollowed())
              相互フォロー時のみ使用可
            @else
              相互フォロー時のみ使用可
            @endif
        </td>
      @endforeach
    </tr>
    </tbody>
  </table>
  </div>
</div>
@endsection