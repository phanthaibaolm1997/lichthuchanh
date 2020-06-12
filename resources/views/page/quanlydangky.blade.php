@extends('page.master')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card-title">
			<h3 class="text-center" style="color: #de470f; font-weight: bold;">LỊCH ĐÃ ĐĂNG KÝ</h3>
		</div>
		<br />
		<br />
		<ul class="nav nav-tabs">
			@foreach($getAllTuan as $tuan)
			<li @if($loop->iteration == 1) class="active" @endif><a data-toggle="tab" href="#tuan_{{$tuan->tuan}}">Tuần
					{{$tuan->tuan}}</a></li>
			@endforeach

		</ul>

		<div class="tab-content">
			@foreach($getAllTuan as $tuan)
			<div id="tuan_{{$tuan->tuan}}" class="tab-pane fade in @if($loop->iteration == 1) active @endif">
				<table class="table table-bordered text-center table_lth">
					<tbody>
						<tr style="height: 50px; background: #de470f; color: #fff;">
							<th style="line-height: 50px; text-align: center;">Buổi</th>
							<th style="line-height: 50px; text-align: center;">Phòng</th>
							@foreach($getAllThu as $thu)
							<th style="line-height: 50px; text-align: center;">{{$thu->thu}}</th>
							@endforeach
						</tr>
						@foreach($getAllBuoi as $buoi)
						@foreach($getAllPhong as $phong)
						<tr>
							@if($loop->iteration == 1)
							<th rowspan="{{count($getAllPhong)}}">{{$buoi->buoi}}</th>
							@endif
							<th>{{ $phong->phong_ten }}</th>
							<?php  ?>
							@foreach($getAllThu as $thu)
							<td style="width: 200px; height: 60px;">
								<?php $flag = 0; ?>
								@foreach($getLichThucHanh as $lth)
								@if($tuan->tuan === $lth->tuan AND $buoi->buoi === $lth->buoi AND $phong->phong_stt ===
								$lth->phong_stt AND $thu->thu === $lth->thu AND Session::get('session_canbo_id') ==
								$lth->nhomthuchanh->lophocphan->cb_id)
								{{-- Update flag when has tkb --}}
								<?php $flag = 1; ?>
								<div class="registered-color">

									<small>Nhóm {{$lth->sttnhom}}</small><br />
									<small>Học phần : {{$lth->nhomthuchanh->hp_id}}</small>
									<p>
										@if($lth->tt_id == 2)
										<a href="{{ route('canbo.xacnhan',$lth->sttnhom) }}">
											<button class="btn btn-sm btn-default" type="button">Xác nhận
											</button>
										</a>
										<a href="{{ route('canbo.tuchoi',$lth->sttnhom) }}">
											<button class="btn btn-sm btn-danger" type="button">Từ chối

											</button>
										</a>
									</p>
									@else
									<div style="border-top: 1px solid #fff; margin-top: 5px">
										<div style="display: flex">
											<div style="flex-grow: 1" class="divHover">
												<i class="fa fa-commenting-o iconHover" aria-hidden="true"
													data-toggle="modal" data-target="#myModal"
													onClick="editNotify(`<?php echo $lth->tkb_ghichu;?>`,'<?php echo $thu->thu; ?>','<?php echo $buoi->buoi; ?>','<?php echo $tuan->tuan; ?>','<?php echo $phong->phong_stt; ?>')"></i>
											</div>
											<div style="flex-grow: 1" class="divHover">
												<i class="fa fa-trash iconHover" aria-hidden="true" data-toggle="modal"
													data-target="#myModalDel"
													onClick="deleteNotify('<?php echo $thu->thu; ?>','<?php echo $buoi->buoi; ?>','<?php echo $tuan->tuan; ?>','<?php echo $phong->phong_stt; ?>')"></i>
											</div>
										</div>
									</div>
									@endif
								</div>
								@endif
								@endforeach
							</td>
							@endforeach
						</tr>
						@endforeach
						@endforeach
					</tbody>
				</table>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="http://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-xl" style="width: 50%">
		<div class="modal-content">
			<div class="modal-header" style="background: #de470f; color: #fff;">
				<h4 class="modal-title"><i class="fa fa-bell" aria-hidden="true"></i> Thông báo của giảng viên</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h4>Cập nhật thông báo</h4>
				<form method="POST" action="{{ route('canbo.messenger') }}">
					<textarea name="notify" id="notify" rows="10" cols="80" class="notify1"></textarea>
					<input type="hidden" name="formThu" id="formThu" />
					<input type="hidden" name="formBuoi" id="formBuoi" />
					<input type="hidden" name="formTuan" id="formTuan" />
					<input type="hidden" name="formPhong" id="formPhong" />
					<hr>
					@csrf
					<button class="btn btn-primary" type="submit">Cập nhật</button>
				</form>
				<script>
					CKEDITOR.replace('notify');
				</script>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="myModalDel">
	<div class="modal-dialog modal-xl" style="width: 50%">
		<div class="modal-content">
			<div class="modal-header" style="background: #de470f; color: #fff;">
				<h4 class="modal-title"><i class="fa fa-bell" aria-hidden="true"></i> Thông báo của giảng viên</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form method="GET" action="{{ route('canbo.tkb.delete') }}">
					<p>Bạn có chắc chắn muốn xóa?</p>
					<input type="hidden" name="formThu" id="formThu1" />
					<input type="hidden" name="formBuoi" id="formBuoi1" />
					<input type="hidden" name="formTuan" id="formTuan1" />
					<input type="hidden" name="formPhong" id="formPhong1" />
					<hr>
					<button class="btn btn-primary" type="submit">Chấp nhận</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function editNotify(notify, thu, buoi, tuan, phong){
		CKEDITOR.instances['notify'].setData(notify);
		$('#formPhong').val(phong);
		$('#formThu').val(thu);
		$('#formBuoi').val(buoi);
		$('#formTuan').val(tuan);
	}
	function deleteNotify( thu, buoi, tuan, phong){
		$('#formPhong1').val(phong);
		$('#formThu1').val(thu);
		$('#formBuoi1').val(buoi);
		$('#formTuan1').val(tuan);
	}
</script>