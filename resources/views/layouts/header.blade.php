
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
              <a class="nav-link" href="{{ route('posts.index') }}">{{ __('質問一覧') }}</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('posts.create') }}">{{ __('質問投稿') }}</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('boards.index') }}">{{ __('掲示板') }}</a>
              </li>

              {{--  <li class="nav-item">
                <a class="nav-link" href="#">{{ __('お店を探す') }}</a>
              </li>  --}}
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('SignIn') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('SingUp') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">

                    </li>
                    <div class="dropdown">
                    <!-- 切替ボタンの設定 -->
                    <button type="button" class="btn btn-link dropdown-toggle text-dark" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      {{ Auth::user()->name }}
                    </button>
                    <!-- ドロップメニューの設定 -->
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/users/{{ Auth::id() }}">ユーザーページ</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            ログアウト
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        </div>
                    </div>
                @endguest
            </ul>
        </div>
    </div>
</nav>