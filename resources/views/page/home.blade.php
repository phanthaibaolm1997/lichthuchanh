<!DOCTYPE html>
<html>
<head>
  <title>Lịch thực hành</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
</head>
<body>
<div class="container">
	<div class="card-title" style="min-height: 15vh">
		<div class="row">
			<div class="col-md-12">
				<h3 style="line-height: 70px; text-align: center;"><img src="{{ asset('assets/img/logo.png') }}" width="70px"  /> QUẢN LÝ THỰC HÀNH UI FOR GIẢNG VIÊN</h3>
			</div>
		</div>
	</div>
	<div class="card-title" style="min-height: 80vh; padding: 0px; overflow: hidden; padding-right: 20px !important;">
		<div class="row">
			<div class="col-md-6">
				<img src="{{ asset('assets/img/background-home.png') }}" width="100%"; style="max-height: 80vh; " />
			</div>
			<div class="col-md-6">
				<div style="position: relative; height: 80vh; width: 100%; ">
					<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); width: 100%;">
						<div class="row">
							<div class="col-md-6">
								<a href="{{ route('home') }}">
									<div class="card-title" style="height: 250px; position: : relative;">
										<div class="alignVertical">
											<i class="fa fa-calendar" style="font-size: 2.5em" aria-hidden="true"></i>
											<h4 class="text-center">Lịch thực hành</h4>
										</div>
									</div>
								</a>
							</div>
							<div class="col-md-6">
								<a href="{{ route('canbo.dangkylich') }}">
									<div class="card-title" style="height: 250px; position: : relative;">
										<div class="alignVertical">
											<i class="fa fa-gg-circle" style="font-size: 2.5em" aria-hidden="true"></i>
											<h4 class="text-center">Đăng ký lịch</h4>
										</div>
									</div>
								</a>
							</div>
							<div class="col-md-6">
								<a href="{{ route('canbo.quanlydk') }}">
									<div class="card-title" style="height: 250px; position: : relative;">
										<div class="alignVertical">
											<i class="fa fa-cog" style="font-size: 2.5em" aria-hidden="true"></i>
											<h4 class="text-center">Lịch của bạn</h4>
										</div>
									</div>
								</a>
							</div>
							<div class="col-md-6">
								<a href="{{ route('logout') }}">
									<div class="card-title" style="height: 250px; position: : relative;">
										<div class="alignVertical">
											<i class="fa fa-sign-out" style="font-size: 2.5em" aria-hidden="true"></i>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>