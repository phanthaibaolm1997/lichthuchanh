<!DOCTYPE html>
<html>
<head>
  <title>Lịch thực hành</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">

</head>
<body>
  <header>
    <div class="container">
      <div id="branding">
        <a href="{{ route('home') }}"><h1><span class="highlight">ECLIT</span> <small>CTU</small></h1>
          </a>
      </div>
      <nav>
        <ul>
          @if(Session::has('session_canbo_id'))
              <li><a href="{{ route('canbo.dangkylich') }}">Đăng ký lịch</a></li>
              <li><a href="{{ route('canbo.quanlydk') }}">Lịch của bạn</a></li>
              <li><a href="{{ route('logout') }}">Thoát</a></li>
          @else
              <li><a href="{{ route('login') }}">ĐĂNG NHẬP</a></li>
          @endif
        </ul>
      </nav>
    </div>
  </header>

  <section id="showcase">
    <div class="container" style="  position: relative; width: 100%;height: 300px;">
      <div style="display: flex;position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%);">
        <div style="flex-basis: auto; ">
          <img src="{{asset('assets/logo.png')}}" width="200px">
        </div>
        <div style="flex-grow: 1">
          <h2 style="margin-top: 0px;
          line-height: 200px;
          color: #e8491d;
          font-weight: bold;
          text-transform: uppercase;">Hệ thống quản lý đăng ký lịch thực hành</h2>
        </div>
      </div>
    </div>
  </section>
  <section id="boxes">
    <div  style="background: #fff; margin-top: 10px; width: 95%; margin: auto; padding: 10px;">
      @yield('content')
    </div>
  </section>

  <footer>
    <p>Acme Web Design, Copyright &#169; 2017</p>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>