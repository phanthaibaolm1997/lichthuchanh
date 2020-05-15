@extends('page.master')
@section('content')

<div class="row">
	<div class="col-md-12">
		<h3 class="text-center" style="    color: #de470f;
		font-weight: bold;">LỊCH THỰC HÀNH</h3>
		<ul class="nav nav-tabs">
			@foreach($getAllTuan as $tuan)
			<li @if($loop->iteration == 1) class="active" @endif><a data-toggle="tab" href="#tuan_{{$tuan->tuan}}">Tuần {{$tuan->tuan}}</a></li>
			@endforeach
		</ul>
		<div class="tab-content">
			@foreach($getAllTuan as $tuan)
			<div id="tuan_{{$tuan->tuan}}" class="tab-pane fade in @if($loop->iteration == 1) active @endif">
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
								@if($tuan->tuan === $lth->tuan AND $buoi->buoi === $lth->buoi AND $phong->phong_stt === $lth->phong_stt AND $thu->thu === $lth->thu  )
								<div class="registered">
									<strong>Nhóm {{$lth->sttnhom}}</strong>
									 <p style="margin: 0px;">{{$lth->nhomthuchanh->hp_id}}: {{$lth->nhomthuchanh->hocphan->hp_ten}}</p>
									 <p style="margin: 0px;">GV: {{$lth->nhomthuchanh->lophocphan->canbo->cb_ten}}</p>
									<div style="background: #fff; color: #f5c5a3; padding: 5px; margin-top: 5px;">
									<i class="fa fa-envelope-o" style="cursor: pointer;" aria-hidden="true" data-toggle="modal" data-target="#myModal" onClick="Notify(`<?php echo $lth->tkb_ghichu;?>`)"></i>
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

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="http://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-xl" style="width: 50%">
		<div class="modal-content" >
			<div class="modal-header" style="background: #de470f; color: #fff;">
				<h4 class="modal-title"><i class="fa fa-bell" aria-hidden="true"></i> Thông báo của giảng viên</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				
				<textarea id="notify" rows="10" cols="80"></textarea>
				<script>
			      $(document).ready(function () {
			         CKEDITOR.replace('notify', {readOnly:true});
			      });
			</script>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function Notify(notify){
		let data = '';
		if(notify !== ""){
			data = notify;
		}
		CKEDITOR.instances['notify'].setData(data);
	}
</script>


