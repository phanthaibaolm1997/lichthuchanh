@extends('admin.master')
@section('content')
<div class="container-fluid" style="background: #f5f6f7; margin-top: 10px; min-height: 100vh; padding-top: 30px">
	<div class="card-title d-flex" style="display: flex">
		<h3  style="color: #de470f; font-weight: bold; flex-grow: 1">Quản lý cán bộ</h3>
		<button class="btn btn-primary" style="flex-basis: auto;" data-toggle="modal" data-target="#addCB"><i class="fa fa-plus" aria-hidden="true"></i> Cán bộ</button>
	</div>
	<br/>
	<div class="container-fluid">
		<table class="table table-bordered text-center" id="bang1">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên cán bộ</th>
					<th>Địa chỉ</th>
					<th>Số điện thoại</th>
					<th>Vai trò</th>
					<th>Thay đổi</th>
					<th>Giảng dạy</th>
				</tr>
			</thead>
			<tbody>
				@foreach($getAllCanBo as $cb)
				<tr class="card-title1 pt-2">
					<td>{{ $loop->iteration }}</td>
					<td>{{ $cb->cb_ten }}</td>
					<td>{{ $cb->cb_diachi }}</td>
					<td>{{ $cb->cb_sdt }}</td>
					@if($cb->q_ma == 2)
					<th style="background-color: #337ab7; color: #fff; text-align: center; ">{{$cb->quyen->q_ten }}</th>
					@else
					<th style="background-color: #5cb85c; color: #fff; text-align: center; ">{{$cb->quyen->q_ten }}</th>
					@endif
					<td>
						@if($cb->q_ma == 2)
						<a href="{{ url('admin/can-bo/delete-cb') }}/{{ $cb->cb_id }}" onclick="return confirm('Bạn có chắc muốn xóa cán bộ này?')">
							<button class="btn btn-danger">
								<i class="fa fa-remove" aria-hidden="true"></i>
							</button>
						</a>
						@else
						<button class="btn btn-danger" disabled="true">
							<i class="fa fa-remove" aria-hidden="true"></i>
						</button>
						@endif
						<button class="btn btn-primary"  data-toggle="modal" data-target="#EditCB{{ $loop->iteration }}"><i class="fa fa-pencil" aria-hidden="true"></i></button>
						<button class="btn btn-primary"  data-toggle="modal" data-target="#PWD{{ $loop->iteration }}"><i class="fa fa-unlock-alt" aria-hidden="true"></i></button>
						
					</td>
					<td>
						@if($cb->q_ma == 2)
						<button class="btn btn-success" data-toggle="modal" data-target="#infoHP{{ $loop->iteration }}">
							<i class="fa fa-share-alt-square" aria-hidden="true"></i>
						</button>
						@else
						<button class="btn btn-danger">
							Not Avaliable
						</button>
						@endif
					</td>
					<!-- Modal pass -->
					<div id="PWD{{ $loop->iteration }}" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background: #f5f6f7; color: #7e7d7d; ">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Thay đổi mật khẩu</h4>
								</div>
								<form method="POST" action="{{ route('admin.canbo.changepwd')}}">
									<div class="modal-body">
										<div class="container-fluid">
											<div class="row">
												<div class="col-md-12 card-title1">
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

												<div class="col-md-12">
													<br/>
													<p class="text-right">
														<button type="submit" class="btn btn-custom btn-primary"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Thay đổi</button>
														<button type="button" class="btn btn-custom btn-default" data-dismiss="modal">Hủy bỏ</button>
													</p>
												</div>
											</div>
											@csrf
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div id="infoHP{{ $loop->iteration }}" class="modal fade" role="dialog" style="padding-right: 0px !important;">
						<div class="modal-dialog" style="width: 100%;  margin: auto; padding-right: 0px;">
							<div class="modal-content" style="height: 100vh;">
								<div class="modal-header" style="background: #f5f6f7; color: #7e7d7d; ">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">THÔNG TIN GIẢNG DẠY CÁN BỘ : {{$cb->cb_ten}}</h4>
								</div>
								<div class="container-fluid mt-2">
									<div class="row">
										<div class="col-md-9">
											<div class="card-title1">
												<h4>
													<button class="btn btn-custom"><i class="fa fa-user" aria-hidden="true"></i></button>Giảng viên: <strong>{{ $cb->cb_ten }}</strong>
												</h4>
												<div style="margin-left: 50px">
													<h5>
														<i class="fa fa-mobile" aria-hidden="true"></i> {{ $cb->cb_sdt }}
													</h5>
													<h5>
														<i class="fa fa-map-marker" aria-hidden="true"></i> {{ $cb->cb_diachi }}
													</h5>
												</div>
												<small>Cán bộ quản lý các lớp học phần..</small>
											</div>

											<br/>
											<?php $hocphan = 0; ?>
											@foreach($cb->lophocphan as $lhp)
											<?php $i = 0; ?>
											<div class="card-title1" style="margin-left: 50px;">
												<div style="display: flex;">
													<div style="flex: 1;">
														<i class="fa fa-caret-right" aria-hidden="true" style="font-size: 1.5em"></i> <span style="line-height: 42px"> {{ $lhp->hp_id }} - Nhóm {{$lhp->lhp_ten}}</span>
													</div>
													<div style="flex-basis: auto; margin-right: 5px;">
														<span style="line-height: 42px"><strong>{{$lhp->lhp_soluongdk}}</strong> Sinh viên</span>
													</div>
													<div style="flex-basis: auto; ">

														<button class="btn btn-custom btn-primary" data-toggle="modal" data-target="#EditLHP{{ $loop->iteration }}_{{ $lhp->sttl }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
														<a href="{{ route('admin.delete.lophocphan',[$lhp->cb_id,$lhp->hp_id,$lhp->namhoc,$lhp->hocky,$lhp->sttl])}}" onclick="return confirm('Bạn có chắc muốn xóa lớp học phần này?')" >
															<button class="btn btn-custom btn-danger"><i class="fa fa-remove" aria-hidden="true"></i></button>
														</a>
													</div>

												</div>
											</div>
											<br/>
											<div id="EditLHP{{ $loop->iteration }}_{{ $lhp->sttl }}" class="modal fade" role="dialog" style="padding-right: 0px !important; z-index: 2000 !important;">
												<div class="modal-dialog" >
													<div class="modal-content">
														<div class="modal-header" style="background: #f5f6f7; color: #7e7d7d; ">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">CHỈNH SỬA LỚP HỌC PHẦN: {{$lhp->lhp_ten}}</h4>
														</div>
														<form action="{{ route('admin.edit.lophocphan')}}" method="POST" accept-charset="utf-8">
															<div class="container-fluid mt-2" style="margin-top: 50px">
																<div class="card-title1">
																	<input type="hidden" name="sttl" value="{{ $lhp->sttl }}">
																	<input type="hidden" name="hocky" value="{{ $lhp->hocky }}">
																	<input type="hidden" name="namhoc" value="{{ $lhp->namhoc }}">
																	<input type="hidden" name="cb_id" value="{{ $lhp->cb_id }}">
																	<input type="hidden" name="hp_id" value="{{ $lhp->hp_id }}">
																	<div class="row">
																		<div class="col-md-8">
																			<label>Tên học phần</label>
																			<input type="text" name="lhp_ten" placeholder="Nhập tên lớp học phần..." required="true" class="form-control" value="{{ $lhp->lhp_ten }}">
																		</div>
																		<div class="col-md-4">
																			<label>Số lượng</label>
																			<input type="number" name="lhp_soluongdk" placeholder="Nhập tên học phần..." required="true" class="form-control" value="{{ $lhp->lhp_soluongdk }}">
																		</div>
																	</div>
																	@csrf
																</div>
																<br/>
																<p><i class="fa fa-info-circle" aria-hidden="true"></i><i> Bạn đang đthay đổi thông tin lớp học phần.</i></p>
																<p class="text-right"><button type="submit" class="btn btn-custom"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Chỉnh sửa </button></p>
															</div>
														</form>
													</div>
												</div>
											</div>
											<?php $i++; ?>
											@endforeach
										</div>
										<div class="col-md-3">
											<div class="card-title1 text-center">
												<h5>LỚP GIẢNG DẠY</h5>
												<br/>
												<p >
													<button class="btn btn-success btn-custom"  disabled="true" style="width: 200px" >
														<i class="fa fa-home" aria-hidden="true"></i> {{count($cb->lophocphan)}} Lớp
													</button>
												</p>
											</div>
											<br/>
											<div class="card-title1 text-center">
												<h5>HỌC PHẦN GIẢNG DẠY</h5>
												<br/>
												<p >
													<button class="btn btn-success btn-custom"  disabled="true" style="width: 200px" >
														<i class="fa fa-h-square" aria-hidden="true"></i> {{$hocphan}} Học phần
													</button>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Modal pass -->
					<div id="EditCB{{ $loop->iteration }}" class="modal fade" role="dialog" style="padding-right: 0px !important;">
						<div class="modal-dialog" style="width: 100%;  margin: auto; padding-right: 0px;">
							<div class="modal-content" style="height: 100vh;">
								<div class="modal-header" style="background: #f5f6f7; color: #7e7d7d; ">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">THAY ĐỔI THÔNG TIN: {{$cb->cb_ten}}</h4>
								</div>
								<form method="POST" action="{{ route('admin.canbo.edit')}}">
									<div class="modal-body">
										<div class="container" style="margin-top: 100px">
											<div class="row card-title1">
												<div class="col-md-4 mt-2">
													<label>
														Tên Cán Bộ:
													</label>
													<input type="hidden" name="id" value="{{ $cb->cb_id }}" >
													<input type="text" name="ten" value="{{ $cb->cb_ten }}"  class="form-control" placeholder="Tên cán bộ...">
												</div>
												<div class="col-md-4 mt-2">
													<label>
														Địa chỉ
													</label>
													<input type="text" name="diachi" value="{{ $cb->cb_diachi }}" class="form-control" placeholder="Địa chỉ...">
												</div>
												<div class="col-md-4 mt-2">
													<label>
														Số điện thoại
													</label>
													<input type="text" name="sdt" value="{{ $cb->cb_sdt }}" class="form-control" placeholder="Số điện thoại...">
												</div>

											</div>
											<br/>
											<div class="col-md-12 text-right">
												<button type="submit" class="btn btn-primary btn-custom"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Cập nhật</button>
												<button type="button" class="btn btn-default btn-custom" data-dismiss="modal">Hủy bỏ</button>
											</div>
										</div>

										@csrf
									</div>
									<br/>
								</div>
							</form>
						</div>
					</div>
				</tr>
				
				
				@endforeach
			</tbody>
		</table>
	</div>
	<!-- Modal addCB -->
	<div id="addCB" class="modal fade" role="dialog" style="padding-right: 0px !important;">
		<div class="modal-dialog" style="width: 100%;  margin: auto; padding-right: 0px;">
			<div class="modal-content" style="height: 100vh;">
				<div class="modal-header" style="background: #f5f6f7; color: #7e7d7d; ">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Thêm cán bộ</h4>
				</div>
				<form method="POST" action="{{ route('admin.canbo.add')}}">
					<div class="modal-body">
						<div class="container" style="margin-top: 100px">
							<h3>THÊM MỚI GIẢNG VIÊN</h3>
							<div class="row card-title1">
								<div class="col-md-6">
									<label>
										Tên Cán Bộ:
									</label>
									<input type="text" name="ten"  class="form-control" placeholder="Tên cán bộ...">
									<br/>
								</div>
								<div class="col-md-6">
									<label>
										Địa chỉ
									</label>
									<input type="text" name="diachi"  class="form-control" placeholder="Địa chỉ...">
									<br/>
								</div>
								<div class="col-md-6">
									<label>
										Số điện thoại
									</label>
									<input type="text" name="sdt"  class="form-control" placeholder="Số điện thoại...">
									<br/>
								</div>
								<div class="col-md-6">
									<label>
										Email
									</label>
									<input type="email" name="email"  class="form-control" placeholder="Email...">
									<br/>
								</div>
								<div class="col-md-12">
									<label>
										Password
									</label>
									<input type="password" name="password"  class="form-control" placeholder="Password...">
									<br/>
								</div>
							</div>
							@csrf
							<br/>
							<div class="text-right">
								<button type="submit" class="btn btn-primary btn-custom">Thêm mới</button>
								<button type="button" class="btn btn-default btn-custom" data-dismiss="modal">Hủy bỏ</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	@endsection
	@section('javascript')
	<script type="text/javascript">
		$(document).ready( function () {
			$('#bang1').DataTable();
		});
	</script>