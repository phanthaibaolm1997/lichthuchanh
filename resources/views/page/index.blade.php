<!DOCTYPE html>
<html>
<head>
	<title>Lịch thực hành</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">

</head>
<body style="width: 96%; margin: auto;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#home">Tuần 01</a></li>
					<li><a data-toggle="tab" href="#menu1">Tuần 02</a></li>
				</ul>

				<div class="tab-content">
					<div id="home" class="tab-pane fade in active">
						<h3 class="text-center">LỊCH THỰC HÀNH</h3>
				<p class="text-center"><i>Tuần 01 (20/12/2020 - 28/12/2020)</i></p>
				<br/>
				<br/>
				<table class="table table-bordered text-center">
					<tbody>
						<tr>
							<th>Buổi</th>
							<th>Phòng</th>
							<th>Thứ 2</th>
							<th>Thứ 3</th>
							<th>Thứ 4</th>
							<th>Thứ 5</th>
							<th>Thứ 6</th>
							<th>Thứ 7</th>
						</tr>
						<tr>
							<th rowspan="3">Sáng</th>
							<th>Phòng 01</th>
							<td>
								<p class="text-center" style="margin-bottom: 0px"><i class="fa fa-user" aria-hidden="true"></i> <strong>Phan Tấn Tài</strong></p>
								<i >CT152 - Mạng máy tính</i>
							</td>
							<th></th>
							<th></th>
							<th style="background-color: #95ffad">Khớp</th>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th>Phòng 02</th>
							<th></th>
							<th></th>
							<td style="background-color: #fbffad"> <p class="text-center" style="margin-bottom: 0px"><i class="fa fa-user" aria-hidden="true"></i> <strong>Phan Tấn Tài</strong></p>
								<i >CT152 - Mạng máy tính</i></td>
							<th></th>
							<td style="background-color: #fbffad"> <p class="text-center" style="margin-bottom: 0px"><i class="fa fa-user" aria-hidden="true"></i> <strong>Phan Tấn Tài</strong></p>
								<i >CT152 - Mạng máy tính</i></td>
							<th></th>
						</tr>
						<tr>
							<th>Phòng 03</th>
							<th></th>
							<td style="background-color: #fbffad"> <p class="text-center" style="margin-bottom: 0px"><i class="fa fa-user" aria-hidden="true"></i> <strong>Phan Tấn Tài</strong></p>
								<i >CT152 - Mạng máy tính</i></td>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th rowspan="3">Chiều</th>
							<th>Phòng 01</th>
							<th></th>
							<th></th>
							<td style="background-color: #fbffad"> <p class="text-center" style="margin-bottom: 0px"><i class="fa fa-user" aria-hidden="true"></i> <strong>Phan Tấn Tài</strong></p>
								<i >CT152 - Mạng máy tính</i></td>
							<td style="background-color: #fbffad"> <p class="text-center" style="margin-bottom: 0px"><i class="fa fa-user" aria-hidden="true"></i> <strong>Phan Tấn Tài</strong></p>
								<i >CT152 - Mạng máy tính</i></td>
							<th></th>

							<th></th>
						</tr>
						<tr>
							<th>Phòng 02</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>

							<td style="background-color: #fbffad"> <p class="text-center" style="margin-bottom: 0px"><i class="fa fa-user" aria-hidden="true"></i> <strong>Phan Tấn Tài</strong></p>
								<i >CT152 - Mạng máy tính</i></td>
							<th></th>
						</tr>
						<tr>
							<th>Phòng 03</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<td style="background-color: #fbffad"> <p class="text-center" style="margin-bottom: 0px"><i class="fa fa-user" aria-hidden="true"></i> <strong>Phan Tấn Tài</strong></p>
								<i >CT152 - Mạng máy tính</i></td>
						</tr>
					</tbody>
				</table>
					</div>
					<div id="menu1" class="tab-pane fade">
						<h3>Menu 1</h3>
						<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					</div>
				</div>
				
			</div>
			<div class="col-md-2">
				<h4 class="text-center" style="margin-top: 95px">Nâng cao</h4>
				<br>
				<label><i class="fa fa-qrcode" aria-hidden="true"></i> Chọn phần mềm</label>
				<select class="form-control">
					<option>Điện toán</option>
				</select>
				<br/>
				<label> <i class="fa fa-desktop" aria-hidden="true"></i> Chọn CPU</label>
				<select class="form-control">
					<option>Điện toán</option>
				</select>
				<br/>
				<label><i class="fa fa-microchip" aria-hidden="true"></i> Số lượng máy</label>
				<select class="form-control">
					<option>Điện toán</option>
				</select>
				<br>
				<button style="width: 100%" class="btn btn-primary"> Tìm</button>
				<br/>
			</div>
		</div>
	</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>