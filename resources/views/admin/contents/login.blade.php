<!DOCTYPE html>
<html>
<head>
	<title>Đăng nhập Admin</title>
	<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/login.css')}}">
</head>
<body>
	<div id="container">
		<div class="login">
			<h1>Đăng nhập <small style="font-size: 16px">"ADMIN"</small></h1>
			<form method="POST" action="{{ route('admin.login.post') }}">
				<input placeholder="Nhập email..." name="email" type="email" required>
				<input placeholder="Nhập mật khẩu..." name="password" type="password" required>
				@csrf
				<button type="submit">Đăng nhập</button>
			</form>
			@if (Session::has('success'))
				<div class="alert alert-success">                   
					 {!! Session::get('success') !!}
				</div>
			@endif
		</div>
	</div>
</body>
</html>