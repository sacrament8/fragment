@extends('layouts.app')

@section('title', 'Fragment')

@section('css')
<link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/home.css">
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <h2 class="title text-center col-12">Fragment</h2>
      <div class="col-12 text-center mt-3">
        <a href="#" id="appear">About</a><span class="spacer"> | </span>
      <a href="{{ route('login') }}">SignIn</a><span class="spacer"> | </span>
      <a href="{{ route('register') }}">SignUp</a><span class="spacer"> | </span>
        <a href="https://github.com/sacrament8/fragment">GitHub</a>
      </div>
      <div class="about col-12">
      <p class="about-text text-center">Fragmentはエンジニア向けの会員制ノウハウ共有サイトです</p>
      <p class="about-text text-center">実装に困っているユーザーが、経験豊富なユーザーへの質問投稿</p>
      <p class="about-text text-center">どの本やサイトを元に学習すれば現在抱えている問題を解決できるかの情報交換</p>
      <p class="about-text text-center">学習時に利用できるwifiを備えた飲食店の情報を提供するアプリケーションです</p>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    var exit_count = 0;
    var elems_count = 0;
    function repeat_show(elems$) {
     elems_count = elems$.length;
     elems$.eq(exit_count).show('slow', function() {
        exit_count ++;
       if(exit_count < elems_count) {
          repeat_show(elems$);
        } 
     });  
    }
 
    $("#appear").click(function() {
       repeat_show($(".about"));
    });
  </script>
@endsection