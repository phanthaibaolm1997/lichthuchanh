@extends('admin.master')
@section('content')
<div class="container-fluid" style="background: #f5f6f7; margin-top: 10px; min-height: 100vh; padding-top: 30px">
	<div class="d-flex" style="display: flex">
		<h3  style="color: #de470f; font-weight: bold; flex-grow: 1">Quản lý cán bộ</h3>
		<button class="btn btn-primary" style="flex-basis: auto;" data-toggle="modal" data-target="#addCB"><i class="fa fa-plus" aria-hidden="true"></i> cán bộ</button>
	</div>
	<br/>
	<div class="container-fluid">
		<table class=" table border-table">
			<thead>
				<tr>
					<th>Mã cán bộ</th>
					<th>Tên cán bộ</th>
					<th>Địa chỉ</th>
					<th>Số điện thoại</th>
					<th>Vai trò</th>
					<th>Thay đổi</th>
				</tr>
			</thead>
			<tbody>
				@foreach($getAllCanBo as $cb)
				<tr>
					<td>{{ $cb->cb_id }}</td>
					<td>{{ $cb->cb_ten }}</td>
					<td>{{ $cb->cb_diachi }}</td>
					<td>{{ $cb->cb_sdt }}</td>
					<td><button class="btn" style="background-color: #de470f; color: #fff; ">{{ $cb->quyen->q_ten }}</button></td>
					<td>
						<button class="btn btn-success" data-toggle="modal" data-target="#addVerPM{{ $loop->iteration }}"><i class="fa fa-eye" aria-hidden="true"></i></button>
						<button class="btn btn-primary"  data-toggle="modal" data-target="#EditCB{{ $loop->iteration }}"><i class="fa fa-pencil" aria-hidden="true"></i></button>
						<button class="btn btn-primary"  data-toggle="modal" data-target="#PWD{{ $loop->iteration }}"><i class="fa fa-unlock-alt" aria-hidden="true"></i></button>
						<a href="{{ url('admin/can-bo/delete-cb') }}/{{ $cb->cb_id }}"> <button class="btn btn-danger"><i class="fa fa-remove" aria-hidden="true"></i></button></a>
					</td>
				</tr>
				<!-- Modal pass -->
				<div id="PWD{{ $loop->iteration }}" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header" style="background: #de470f; color: #fff;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Thay đổi mật khẩu</h4>
							</div>
							<form method="POST" action="{{ route('admin.canbo.changepwd')}}">
								<div class="modal-body">
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-12">
												<label>
													Người dùng:
												</label>
												<input type="text"  class="form-control" value="{{ $cb->cb_ten }}" disabled="true">
												<input type="hidden"  class="form-control" name="cb_id" value="{{ $cb->cb_id }}">
												<br/>
												<label>
													Mật khẩu mới:
												</label>
												<input type="text" name="password"  class="form-control" placeholder="Nhập mật khẩu mới">
											</div>
										</div>
										@csrf
									</div>
									<br/>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary">Thay đổi</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Modal pass -->
				<div id="EditCB{{ $loop->iteration }}" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header" style="background: #de470f; color: #fff;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Thay thông tin cán bộ</h4>
							</div>
							<form method="POST" action="{{ route('admin.canbo.edit')}}">
								<div class="modal-body">
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-12">
												<label>
													Tên Cán Bộ:
												</label>
												<input type="hidden" name="id" value="{{ $cb->cb_id }}" >
												<input type="text" name="ten" value="{{ $cb->cb_ten }}"  class="form-control" placeholder="Tên cán bộ...">
												<br/>
												<label>
													Địa chỉ
												</label>
												<input type="text" name="diachi" value="{{ $cb->cb_diachi }}" class="form-control" placeholder="Địa chỉ...">
												<br/>
												<label>
													Số điện thoại
												</label>
												<input type="text" name="sdt" value="{{ $cb->cb_sdt }}" class="form-control" placeholder="Số điện thoại...">
												<br/>
											</div>
										</div>
										@csrf
									</div>
									<br/>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary">Cập nhật</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<!-- Modal addCB -->
<div id="addCB" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #de470f; color: #fff;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Thêm cán bộ</h4>
			</div>
			<form method="POST" action="{{ route('admin.canbo.add')}}">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<label>
									Tên Cán Bộ:
								</label>
								<input type="text" name="ten"  class="form-control" placeholder="Tên cán bộ...">
								<br/>
								<label>
									Địa chỉ
								</label>
								<input type="text" name="diachi"  class="form-control" placeholder="Địa chỉ...">
								<br/>
								<label>
									Số điện thoại
								</label>
								<input type="text" name="sdt"  class="form-control" placeholder="Số điện thoại...">
								<br/>
								<label>
									Email
								</label>
								<input type="email" name="email"  class="form-control" placeholder="Email...">
								<br/>
								<label>
									Password
								</label>
								<input type="password" name="password"  class="form-control" placeholder="Password...">
							</div>
						</div>
						@csrf
					</div>
					<br/>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Thêm mới</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection