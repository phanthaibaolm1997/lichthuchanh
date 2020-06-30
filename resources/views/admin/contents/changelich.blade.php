@extends('admin.master')
@section('content')
<?php $date = 1; ?>
<div class="container-fluid" style="background: #fff; margin-top: 10px; min-height: 100vh; padding-top: 30px">
	<div class="row">
		<div class="col-md-12">
			<h3 class="text-center" style="    color: #de470f;
			font-weight: bold;"> CẬP NHẬT LỊCH THỰC HÀNH</h3>
			<ul class="nav nav-tabs">
				@foreach($getAllTuan as $tuan)
				<li @if($loop->iteration == 1) class="active" @endif><a data-toggle="tab" href="#tuan_{{$tuan->tuan}}">Tuần {{$tuan->tuan}}</a></li>
				@endforeach
			</ul>
			<div class="tab-content">
				@foreach($getAllTuan as $tuan)
				<?php 
					$register = 0;
					$wait =0;
				?>
				@foreach($getLichThucHanh as $lth)
					@if($lth->tuan == $tuan->tuan)
						@if($lth->tt_id == 0)
							<?php $register = $register + 1; ?>
						@else
							<?php $wait = $wait + 1; ?>
						@endif
					@endif
				@endforeach
				<div id="tuan_{{$tuan->tuan}}" class="tab-pane fade in @if($loop->iteration == 1) active @endif">
					<h4 class="text-center" id="date_{{ $date }}"></h4>
					<script type="text/javascript">

						var curr = new Date;
						var first = curr.getDate() - curr.getDay() + 6*{{$date}}; 
						var last = first + 6; 
						console.log(1);
						var firstday = new Date(curr.setDate(first)).toLocaleDateString('en-US');
						var lastday = new Date(curr.setDate(last)).toLocaleDateString('en-US');
						var block = document.getElementById("date_{{ $date }}");
						block.innerHTML = firstday+" - "+lastday;


					</script>
					<?php $date++;  ?>
					<table class="table table-bordered text-center table_lth" align="center">
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
								<th rowspan="{{count($getAllPhong)}}" >{{$buoi->buoi}}</th>
								@endif
								<th>{{ $phong->phong_ten }}</th>
								@foreach($getAllThu as $thu)
								<td style="width: 200px; height: 60px;">
									@foreach($getLichThucHanh as $lth)
									@if($tuan->tuan == $lth->tuan AND $buoi->buoi == $lth->buoi AND $phong->phong_stt == $lth->phong_stt AND $thu->thu == $lth->thu  )
									<div class="registered">
										<strong>Nhóm {{$lth->sttnhom}}</strong>
										<p style="margin: 0px;">{{$lth->nhomthuchanh->hp_id}}: {{$lth->nhomthuchanh->hocphan->hp_ten}}</p>
										<p style="margin: 0px;">GV: {{$lth->nhomthuchanh->lophocphan->canbo->cb_ten}}</p>
										<div style="display: flex; padding: 8px 0px;">
											<div style="flex-grow: 1">
												<i class="fa fa-info" aria-hidden="true" style="font-size: 1.2em; color: #3e73ea;" ></i>
											</div>
											<div style="flex-grow: 1">
												<i class="fa fa-cogs iconChange" aria-hidden="true" style="font-size: 1.2em; color: #000;"></i>
											</div>
											<div style="flex-grow: 1">
												<i class="fa fa-trash" aria-hidden="true" style="font-size: 1.2em; color: #ec6363;"></i>
											</div>
										</div>
										<div style="display: none" class="formChange">
											<form method="POST" style="display: flex;" action="{{ route('admin.changelich') }}">
												<select class="form-control" style="flex-grow: 1" name="formPhong">
													@foreach($getAllPhong as $phong)
														@if($lth->phong_stt != $phong->phong_stt)
															<option value="{{$phong->phong_stt}}"> Phòng {{$phong->phong_stt}}</option>
														@endif
													@endforeach
												</select>
												<input type="hidden" name="formThu" value="{{$lth->thu}}" id="formThu"/>
												<input type="hidden" name="formBuoi" value="{{$lth->buoi}}" id="formBuoi"/>
												<input type="hidden" name="formTuan" value="{{$lth->tuan}}" id="formTuan"/>
												<input type="hidden" name="formNhom" value="{{$lth->sttnhom}}" id="formNHom"/>
												@csrf
												<button type="submit" style="flex-basis: auto; margin-left: 4px" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></button>
											</form>
										</div>
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
</div>
{{-- INFO --}}
<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-xl" style="width: 50%">
		<div class="modal-content" >
			<div class="modal-header" style="background: #de470f; color: #fff;">
				<h4 class="modal-title"><i class="fa fa-cogs" aria-hidden="true"></i>  Đổi lịch giảng dạy</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				
				
			</div>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.iconChange').click(function(event) {
			$(this).parent().parent().siblings('.formChange').toggle();
		});
	});
</script>
@endsection
