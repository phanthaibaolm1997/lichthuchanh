<!DOCTYPE html>
<html>
<head>
  <title>Lịch thực hành</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

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
              <li><a href="{{ route('backhome') }}">Trang Quản lý</a></li>
              <li><small>{{Session::get('session_canbo_email')}}</small></a></li>
          @else
              <li><a href="{{ route('login') }}">Đăng nhập</a></li>
          @endif
        </ul>
      </nav>
    </div>
  </header>

  <section id="boxes">
    <div  style="background: #f4f5f6; margin-top: 10px; width: 95%; margin: auto; padding: 10px;">
      @yield('content')
    </div>
  </section>

  <footer>
    <p>Acme Web Design, Copyright &#169; 2017</p>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
  </script>
</body>
</html>