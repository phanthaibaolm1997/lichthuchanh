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
				<table class="table table-bordered text-center table_lth">
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
								<div class="register_lth">
									<p class="text-center" style="margin-bottom: 0px"><i class="fa fa-user" aria-hidden="true"></i> <strong>Phan Tấn Tài</strong></p>
									<i >CT152 - Mạng máy tính</i>
								</div>
							</td>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<th>Phòng 02</th>
							<th></th>
							<th></th>
							<td>
								<div class="register_lth">
									<p class="text-center" style="margin-bottom: 0px"><i class="fa fa-user" aria-hidden="true"></i> <strong>Phan Tấn Tài</strong></p>
									<i >CT152 - Mạng máy tính</i>
								</div>
							</td>
							<th></th>
							<td>
								<div class="register_lth">
									<p class="text-center" style="margin-bottom: 0px"><i class="fa fa-user" aria-hidden="true"></i> <strong>Phan Tấn Tài</strong></p>
									<i >CT152 - Mạng máy tính</i>
								</div>
							</td>
							<th></th>
						</tr>
						<tr>
							<th>Phòng 03</th>
							<th></th>
							<td>
								<div class="register_lth">
									<p class="text-center" style="margin-bottom: 0px"><i class="fa fa-user" aria-hidden="true"></i> <strong>Phan Tấn Tài</strong></p>
									<i >CT152 - Mạng máy tính</i>
								</div>
							</td>
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
							<td>
								<div class="register_lth">
									<p class="text-center" style="margin-bottom: 0px"><i class="fa fa-user" aria-hidden="true"></i> <strong>Phan Tấn Tài</strong></p>
									<i >CT152 - Mạng máy tính</i>
								</div>
							</td>
							<td>
								<div class="register_lth">
									<p class="text-center" style="margin-bottom: 0px"><i class="fa fa-user" aria-hidden="true"></i> <strong>Phan Tấn Tài</strong></p>
									<i >CT152 - Mạng máy tính</i>
								</div>
							</td>
							<th></th>

							<th></th>
						</tr>
						<tr>
							<th>Phòng 02</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<td>
								<div class="register_lth">
									<p class="text-center" style="margin-bottom: 0px"><i class="fa fa-user" aria-hidden="true"></i> <strong>Phan Tấn Tài</strong></p>
									<i >CT152 - Mạng máy tính</i>
								</div>
							</td>
							<th></th>
						</tr>
						<tr>
							<th>Phòng 03</th>
							<th>
								<div class="register_lth">
									<div class="register_display">
										<i class="fa fa-sign-in register_icon" aria-hidden="true" data-toggle="modal" data-target="#myModal"></i>
									</div>
								</div>
							</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<td>
								<div class="register_lth">
									<p class="text-center" style="margin-bottom: 0px"><i class="fa fa-user" aria-hidden="true"></i> <strong>Phan Tấn Tài</strong></p>
									<i >CT152 - Mạng máy tính</i>
								</div>
							</td>
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
				<div class="filter_lth">
					<h4 class="text-center">Nâng cao</h4>
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
					<button style="width: 100%" class="btn btn-default"> Tìm kiếm</button>
					<br/>
				</div>
			</div>
		</div>
	</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl" style="width: 50%">
      <div class="modal-content" >
        <div class="modal-header" style="background: #de470f; color: #fff;">
         	<h4 class="modal-title"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Đăng ký lịch thực hành</h4>
          	<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="height: calc(100vh - 200px)">
         
        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-primary" data-dismiss="modal">Đăng ký</button>
          	<button type="button" class="btn btn-danger" data-dismiss="modal">Hủy bỏ</button>
        </div>
        
      </div>
    </div>
  </div>