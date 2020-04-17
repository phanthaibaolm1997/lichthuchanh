@extends('page.master')
@section('content')
<div class="row">
	<div class="col-md-10">
		<h3 class="text-center" style="    color: #de470f;
		font-weight: bold;">ĐĂNG KÝ LỊCH THỰC HÀNH</h3>
		<ul class="nav nav-tabs">
			@foreach($getAllTuan as $tuan)
			<li @if($loop->iteration == 1) class="active" @endif><a data-toggle="tab" href="#tuan_{{$tuan->tuan}}">Tuần {{$tuan->tuan}}</a></li>
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
							@foreach($getAllThu as $thu)
							<td style="width: 200px; height: 60px;">
								<?php $flag = 0; ?>
								@foreach($getLichThucHanh as $lth)
								@if($tuan->tuan === $lth->tuan AND $buoi->buoi === $lth->buoi AND $phong->phong_stt === $lth->phong_stt AND $thu->thu === $lth->thu  )
								{{-- Update flag when has tkb --}}
								<?php $flag = 1; ?>
								<div class="registered">
									Nhóm {{$lth->sttnhom}}
									<br/>
									Học phần : {{$lth->nhomthuchanh->hp_id}}
								</div>
								@endif
								@endforeach
								{{-- Check Flag --}}
								@if($flag === 0)
								<?php 
								$array_data = array($thu->thu,$buoi->buoi,$tuan->tuan,$phong->phong_stt);
								$json_data = json_encode($array_data); 
								?>
								<div class="register_lth">
									<div class="register_display">
										<i class="fa fa-calendar-plus-o register_icon" aria-hidden="true" data-toggle="modal" onClick="registerSchedule('<?php echo $thu->thu; ?>','<?php echo $buoi->buoi; ?>','<?php echo $tuan->tuan; ?>','<?php echo $phong->phong_stt; ?>')" data-target="#myModal"></i>
									</div>
								</div>
								@endif
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
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-xl" style="width: 50%">
		<div class="modal-content" >
			<div class="modal-header" style="background: #de470f; color: #fff;">
				<h4 class="modal-title"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Đăng ký lịch thực hành</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body" >
				<form method="POST" action="{{ route('dangkylich') }}">
					<h4>Thông tin đã chọn</h4>
					<div class="row">
						<div class="col-md-6">
							<label>Thứ</label>
							<input type="text" name="formThu" id="formThu" class="form-control">

						</div>
						<div class="col-md-6">
							<label>Buổi</label>
							<input type="text" name="formBuoi" id="formBuoi"  class="form-control">
						</div>
						<div class="col-md-12 mt-5">
							<label>Tuần</label>
							<input type="text" name="formTuan" id="formTuan"  class="form-control">
						</div>
						<div class="col-md-12 mt-5">
							<label>Phòng</label>
							<input type="text" name="formPhong" id="formPhong"  class="form-control">
						</div>
					</div>
					<h4>Thông tin bổ trợ</h4>
					<div class="row">
						<div class="col-md-6">
							<label>Học phần</label>
							<select id="formHocPhan" class="form-control" name="formHocPhan">
								<option value="" data-lhp="">--- select ----</option>
								@foreach($getHocPhanByCB as $hp)
								<option value="{{ $hp->hp_id }}" data-lhp="{{$hp->nhomthuchanh}}">{{$hp->hp_ten}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-6">
							<label>Nhóm quản lý</label>
							<div id="contentGroup">
								<select id="formNhom" class="form-control" disabled="true">
									<option value="">---Chọn nhóm --- </option>
								</select>
							</div>
						</div>
					</div>
				</div>
				@csrf
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Đăng ký</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Hủy bỏ</button>
				</div>
			</form>

		</div>
	</div>
</div>
<script type="text/javascript">
	function registerSchedule(thu,buoi,tuan,phong){
		$('#formPhong').val(phong);
		$('#formThu').val(thu);
		$('#formBuoi').val(buoi);
		$('#formTuan').val(tuan);
	}
	$('#formHocPhan').on('change', function() {
		let json_data = JSON.parse($(this).find(':selected').attr('data-lhp'));
		console.log(json_data);
		let code = "";
		code += '<select id="formNhom" name="formNhom" class="form-control">';
		json_data.forEach(data => {
			code += '<option value="'+data.sttnhom+'">Nhóm '+data.sttnhom+'</option>';
		});
		code += '</select>';
		$('#contentGroup').html(code);
	});
</script>