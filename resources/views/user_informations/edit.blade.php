@extends('layouts.app')

@section('title', 'アバター変更')

@section('css')
  <link rel="stylesheet" href="/css/user_information_edit.css">
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="card mt-5 mx-auto">
      <h4 class="card-header bg-dark text-light">User Information</h4>
      <!--$userに紐づく$user_infoが存在し、nullでなければavatarカラムに保存した画像を表示、なければno-image.jpgを表示-->
      @if(!empty($user->userInformation->avatar))
        <div class="img-thumbnail mx-auto">
          <img class="card-img-top" id="avatar_img" src="{{ asset('/storage/avatar_images/'.$user->userInformation->avatar) }}">
        </div>
      @else
        <div class="img-thumbnail mx-auto">
          <img class="card-img-top" id="avatar_img" src="/images/no-image.jpg">
        </div>
      @endif
      <!--画像upload用form-->
      <div class="card-body">
        @include('layouts.errors')
        <form enctype="multipart/form-data" action="/userinfo" method="POST">
          @csrf
          <input class="form-control btn btn-dark my-3" id="avatar_file" type="file" name="avatar">
          <select name="pref" class='form-control my-2'>
            <option value="">---お住まいの県---</option>
            @foreach (Config::get('pref') as $id => $pref)
              <option value="{{$pref}}" @if($pref==$user_info->pref) selected  @endif>
                {{$pref}}
              </option>
            @endforeach
          </select>
          <input class="form-control btn btn-primary" type="submit" value="ユーザー情報を更新">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
  <script src="/js/user_info_edit.js"></script>
@endsection