@extends('admin.master')
@section('content')

<div class="container-fluid" style=" margin-top: 10px; min-height: 100vh; padding-top: 10px">
	<div class="card-title">
		<h3  style="color: #de470f; font-weight: bold; flex-grow: 1; margin-bottom: 0px;">QUẢN LÝ HỌC PHẦN</h3>
	</div>
	<div class="row">
		<div class="col-md-8 ">
			<div class="flash-message" style="width: 50%; margin: auto;" >
				@if(session('success'))
				  <p class="alert alert-success" id="boxMes">{{session('success')}}</p>
				@endif
			</div>
			<div class="cardMaster" style="min-height: 700px">
				<br/>
				<h4 style="color: #de470f; font-weight: bold; margin-left: 15px;"><i class="fa fa-list" aria-hidden="true"></i> Danh Sách Học Phần </h4>
				<br/>
					@foreach($getAllHP as $hp)
						<div class="card-title1 mt-2" style="display: flex;">
							<div style="flex: 1"> 
								<span style="font-size: 1.3em; line-height: 40px; color: #333;">
									<i class="fa fa-cube" aria-hidden="true"></i> {{$hp->hp_id}} - {{$hp->hp_ten}}
								</span>
							</div>
							<div style="flex-basis: auto;">
								<button class="btn-custom btn-secondary btn mr-2" data-toggle="modal" data-target="#infoHP{{ $loop->iteration }}"><i class="fa fa-info-circle" aria-hidden="true"></i></button>
								<button class="btn-custom btn-primary btn mr-2" data-toggle="modal" data-target="#EditHP{{ $loop->iteration }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
								<a href="{{ route('admin.delete.hocphan', $hp->hp_id)}}" onclick="return confirm('Bạn có chắc muốn xóa học phần?')"><button class="btn-custom btn-danger btn mr-2"><i class="fa fa-times" aria-hidden="true"></i></button></a>
							</div>
						</div>
						<div id="infoHP{{ $loop->iteration }}" class="modal fade" role="dialog" style="padding-right: 0px !important;">
							<div class="modal-dialog" style="width: 70%;  margin: auto; padding-right: 0px;">
								<div class="modal-content" style="height: 100vh;">
									<div class="modal-header" style="background: #f5f6f7; color: #7e7d7d; ">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">HỌC PHẦN : {{$hp->hp_ten}}</h4>
									</div>
									<div class="container-fluid mt-2">
										<div class="row">
											<div class="col-md-9">
												<h4>Nhóm học phần</h4>
												@foreach($hp->lophocphan as $lhp)
													<?php $umaru = 0; $i = 0; ?>
													<div class="card-title1">
														<div style="display: flex;">
															<div style="flex: 1;">
																<span style="line-height: 42px"> {{ $lhp->hp_id }} - Nhóm {{$lhp->lhp_ten}}</span>
															</div>
															<div style="flex-basis: auto; margin-right: 5px;">
																<span style="line-height: 42px"><strong>{{$lhp->lhp_soluongdk}}</strong> Sinh viên</span>
															</div>
															<div style="flex-basis: auto; ">
																@foreach($hp->nhomthuchanh as $nth)
																	@if($lhp->sttl == $nth->sttl && $lhp->hp_id == $nth->hp_id && $lhp->namhoc == $nth->namhoc && $lhp->hocky == $nth->hocky)
																	<?php $umaru = 1; ?>
																	@endif
																@endforeach
																@if($umaru == 1)
																	<button class="btn btn-custom btn-success" disabled="true">Đã đăng ký</button>
																@else
																	<a href="{{ route('admin.dangkythuchanh',[$lhp->cb_id,$lhp->hp_id,$lhp->namhoc,$lhp->hocky,$lhp->sttl,$lhp->lhp_soluongdk])}}">
																		<button class="btn btn-custom btn-primary">Đăng ký thực hành</button>
																	</a>
																@endif
																
																<button class="btn btn-custom btn-primary" data-toggle="modal" data-target="#EditLHP{{ $loop->iteration }}_{{ $lhp->sttl }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
																<a href="{{ route('admin.delete.lophocphan',[$lhp->cb_id,$lhp->hp_id,$lhp->namhoc,$lhp->hocky,$lhp->sttl])}}" onclick="return confirm('Bạn có chắc muốn xóa lớp học phần này?')" >
																	<button class="btn btn-custom btn-danger"><i class="fa fa-remove" aria-hidden="true"></i></button>
																</a>
															</div>
															
														</div>
														<hr/>
														<span><strong>Cán bộ quản lý:</strong> {{$lhp->canbo->cb_ten}}</span>
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
													<h5>PHÂN CÔNG GIẢNG DẠY</h5>
													<br/>
													<p >
														<button class="btn btn-success btn-custom"  data-toggle="modal" data-target="#dangKyHP{{ $loop->iteration }}" style="width: 200px">
															<i class="fa fa-plus-circle" aria-hidden="true"></i>
														</button>
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="EditHP{{ $loop->iteration }}" class="modal fade" role="dialog" style="padding-right: 0px !important;">
							<div class="modal-dialog" >
								<div class="modal-content">
									<div class="modal-header" style="background: #f5f6f7; color: #7e7d7d; ">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">CHỈNH SỬA HỌC PHẦN: {{$hp->hp_ten}}</h4>
									</div>
									<form action="{{ route('admin.edit.hocphan')}}" method="POST" accept-charset="utf-8">
										<div class="container-fluid mt-2" style="margin-top: 50px">
											<div class="card-title1">
												<input type="hidden" name="hp_id" value="{{ $hp->hp_id }}">
												<label>Tên học phần</label>
												<input type="text" name="hp_ten" placeholder="Nhập tên học phần..." required="true" class="form-control" value="{{ $hp->hp_ten }}">
												@csrf
											</div>
											<br/>
											<p><i class="fa fa-info-circle" aria-hidden="true"></i><i> Bạn đang đăng ký học phần cho học kỳ này!</i></p>
											<p class="text-right"><button type="submit" class="btn btn-primary btn-custom"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Chỉnh sửa </button></p>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div id="dangKyHP{{ $loop->iteration }}" class="modal fade" role="dialog" style="padding-right: 0px !important;">
							<div class="modal-dialog" style="width: 70%;  margin: auto; padding-right: 0px;">
								<div class="modal-content" style="height: 100vh;">
									<div class="modal-header" style="background: #f5f6f7; color: #7e7d7d; ">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">PHÂN CÔNG GIẢNG DẠY: {{$hp->hp_ten}}</h4>
									</div>
									<form action="{{ route('admin.post.dangkylophocphan')}}" method="POST" accept-charset="utf-8">
										<div class="container-fluid mt-2" style="margin-top: 50px">
											<div class="card-title1">
												<div class="row">
													<input type="hidden" name="hp_id" value="{{ $hp->hp_id }}">
													<div class="col-md-4">
														<label>Chọn giảng viên</label>
														<select name="cb_id" class="form-control" required="true">
															@foreach($getGV as $gv)
																<option value="{{$gv->cb_id}}">{{$gv->cb_ten}}</option>
															@endforeach
														</select>
													</div>
													<div class="col-md-4">
														<label>Tên lớp</label>
														<input type="text" name="ten_lhp" placeholder="Nhập tên lớp học phần..." required="true" class="form-control">
													</div>
													<div class="col-md-4">
														<label>Số lượng đăng ký</label>
														<input type="number" name="soluong_lhp" placeholder="Nhập số lượng đăng ký..." required="true" class="form-control">
													</div>
												</div>
												@csrf
											</div>
											<br/>
											<p><i class="fa fa-info-circle" aria-hidden="true"></i><i> Bạn đang đăng ký học phần cho học kỳ này!</i></p>
											<p class="text-right"><button type="submit" class="btn btn-primary btn-custom"><i class="fa fa-plus-circle" aria-hidden="true"></i> Đăng ký lớp </button></p>
										</div>
									</form>
								</div>
							</div>
						</div>
					@endforeach
			</div>
		</div>
		<div class="col-md-4 ">
			<div class="cardMaster">
				<br/>
				<h4  style="color: #de470f; font-weight: bold; margin-left: 15px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm Học Phần</h4>
				<br/>
				<form method="POST" action="{{ route('admin.post.hocphan') }}">
					<label>Mã học phần</label>
					<input type="text" name="code" placeholder="Mã học phần.." class="form-control" required="true">
					<br/>
					<label>Tên học phần</label>
					<input type="text" name="name" placeholder="Tên học phần.." class="form-control" required="true">
					<br/>
					<button type="submit" class="btn btn-primary btn-custom">Thêm mới</button>
					@csrf
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
<script type="text/javascript">
	setTimeout(function(){
	  if ($('#boxMes').length > 0) {
	    $('#boxMes').remove();
	  }
	}, 3000)
</script>