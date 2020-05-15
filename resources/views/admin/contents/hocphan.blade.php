@extends('admin.master')
@section('content')

<div class="container-fluid" style=" margin-top: 10px; min-height: 100vh; padding-top: 10px">
	<div class="card-title">
		<h3  style="color: #333; font-weight: bold; flex-grow: 1">QUẢN LÝ HỌC PHẦN</h3>
	</div>
	<div class="row">
		<div class="col-md-8 ">
			<div class="cardMaster" style="min-height: 600px">
				<h3  class="card-title1" style="color: #ababab; font-weight: bold;">DANH SÁCH </h3>
				<BR/>
					@foreach($getAllHP as $hp)
						<div class="card-title1" style="display: flex;">
							<div style="flex: 1"> 
								<span style="font-size: 1.3em; line-height: 40px; color: #333;">
									<i class="fa fa-cube" aria-hidden="true"></i> {{$hp->hp_ten}}
								</span>
							</div>
							<div style="flex-basis: auto;">
								<button class="btn-custom btn mr-2" data-toggle="modal" data-target="#infoHP{{ $loop->iteration }}"><i class="fa fa-info-circle" aria-hidden="true"></i></button>
								<button class="btn-custom btn mr-2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
								<button class="btn-custom btn mr-2"><i class="fa fa-times" aria-hidden="true"></i></button>
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
													<?php $umaru = 0; ?>
													<div class="card-title1">
														<div style="display: flex;">
															<div style="flex: 1;">
																<span style="line-height: 42px"> {{ $lhp->hp_id }} - Nhóm {{$lhp->sttl}}</span>
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
																	<button class="btn btn-danger">Hủy đăng ký</button>
																@else
																	<button class="btn btn-primary">Đăng ký thực hành</button>
																@endif
																
																<button class="btn btn-custom"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
																<button class="btn btn-custom"><i class="fa fa-remove" aria-hidden="true"></i></button>
															</div>
														</div>
														<hr/>
														<span><strong>Cán bộ quản lý:</strong> {{$lhp->canbo->cb_ten}}</span>
													</div>
												@endforeach
											</div>
											<div class="col-md-3">
												<div class="card-title1 text-center">
													<h5>ĐĂNG KÝ LỚP HỌC PHẦN MỚI</h5>
													<br/>
													<p >
														<button class="btn btn-custom"  data-toggle="modal" data-target="#dangKyHP" style="width: 200px"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="dangKyHP" class="modal fade" role="dialog" style="padding-right: 0px !important;">
							<div class="modal-dialog" style="width: 70%;  margin: auto; padding-right: 0px;">
								<div class="modal-content" style="height: 100vh;">
									<div class="modal-header" style="background: #f5f6f7; color: #7e7d7d; ">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">HỌC PHẦN : {{$hp->hp_ten}}</h4>
									</div>
									<div class="container-fluid mt-2">
									
									</div>
								</div>
							</div>
						</div>
					@endforeach
			</div>
		</div>
		<div class="col-md-4 ">
			<div class="cardMaster">
				<h3 class="card-title1" style="color: #ababab; font-weight: bold;">THÊM MỚI</h3>
				<br/>
				<form method="POST">
					<label>Mã học phần</label>
					<input type="text" name="code" placeholder="Mã học phần.." class="form-control">
					<br/>
					<label>Tên học phần</label>
					<input type="text" name="name" placeholder="Tên học phần.." class="form-control">
					<br/>
					<button type="" class="btn btn-custom">Thêm mới</button>

				</form>
			</div>
		</div>
	</div>
</div>

@endsection