@extends('admin.master')
@section('content')
<div class="container-fluid" style="background: unset; margin-top: 10px; min-height: 100vh; padding-top: 30px">
	<div class="row">
		<div class="col-md-12">
			<div class="card-title">
				<h3 class="text-center" style="color: #de470f; font-weight: bold;">LỊCH THỰC HÀNH</h3>
			</div>
			<?php $date = 1; ?>
			<ul class="nav nav-tabs">
				@foreach($getAllTuan as $tuan)
				<li @if($loop->iteration == 1) class="active" style="color: #000 !important"  @endif ><a data-toggle="tab" href="#tuan_{{$tuan->tuan}}" style="background-color: #de470f; color: #fff;">Tuần {{$tuan->tuan}}</a></li>
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
								<th rowspan="{{count($getAllPhong)}}" style="background-color: #de470f; color: #fff;">{{$buoi->buoi}}</th>
								@endif
								<th style="text-align: center; color: #de470f; background: #fff;">{{ $phong->phong_ten }}</th>
								@foreach($getAllThu as $thu)
								<td style="width: 200px; height: 60px;" class="card-title1">
									@foreach($getLichThucHanh as $lth)
									@if($tuan->tuan === $lth->tuan AND $buoi->buoi === $lth->buoi AND $phong->phong_stt === $lth->phong_stt AND $thu->thu === $lth->thu  )
									<div class="registered">
										<strong>Nhóm {{$lth->sttnhom}}</strong>
										<p style="margin: 0px;">{{$lth->nhomthuchanh->hp_id}}: {{$lth->nhomthuchanh->hocphan->hp_ten}}</p>
										<p style="margin: 0px;">GV: {{$lth->nhomthuchanh->lophocphan->canbo->cb_ten}}</p>
										
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
@endsection