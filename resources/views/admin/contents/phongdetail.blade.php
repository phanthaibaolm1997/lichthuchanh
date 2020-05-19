@extends('admin.master')
@section('content')
<div class="container-fluid" style="background: #f5f6f7; margin-top: 10px; min-height: 100vh; padding-top: 30px">
	<div class="d-flex card-title1" style="display: flex">
		<div style="width: 93%; margin: auto">
			<h3  style="color: #de470f; font-weight: bold; padding: 10px;"><i class="fa fa-home" aria-hidden="true" style="font-size: 2em; color: #de470f;"></i> - {{$getDetailPhong->phong_ten}}</h3>
		</div>
	</div>
	<br/>
	<div class="container-fluid">
		<div style="width: 100%; margin: auto">
			<div class="row">
				<div class="col-md-6">
					<div style="background-color: #fff; padding: 10px; border-radius: 5px; box-shadow: -4px -2px 4px 0 #fff, 4px 2px 6px 0 #dfe4ea, inset 0 0 1px 0 #c4c4c4, 3px 3px 5px -3px #c4c4c4; min-height: 50vh">
						<h3  style="color: #de470f; font-weight: bold; padding: 10px;">Thông tin phòng</h3>
						<hr>
						<div style="padding: 10px;  box-shadow: -4px -2px 4px 0 #fff, 4px 2px 6px 0 #dfe4ea, inset 0 0 1px 0 #c4c4c4, 3px 3px 5px -3px #c4c4c4; border-radius: 4px;  font-weight: bold;">
							<i class="fa fa-television" aria-hidden="true"></i> {{$getDetailPhong->phong_ten}} 
						</div>
						<br/>
						<div style="padding: 10px;  box-shadow: -4px -2px 4px 0 #fff, 4px 2px 6px 0 #dfe4ea, inset 0 0 1px 0 #c4c4c4, 3px 3px 5px -3px #c4c4c4; border-radius: 4px;  font-weight: bold;">
							<i class="fa fa-television" aria-hidden="true"></i> Tổng số {{$getDetailPhong->phong_slmay}} máy tính
						</div>
						<br/>
						<div style="padding: 10px;  box-shadow: -4px -2px 4px 0 #fff, 4px 2px 6px 0 #dfe4ea, inset 0 0 1px 0 #c4c4c4, 3px 3px 5px -3px #c4c4c4; border-radius: 4px; font-weight: bold;">
							<i class="fa fa-television" aria-hidden="true"></i> Tổng số <span style="color: blue">{{$getDetailPhong->phong_slmay}}</span> phần mềm
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div style="background-color: #fff; padding: 10px; border-radius: 5px; box-shadow: -4px -2px 4px 0 #fff, 4px 2px 6px 0 #dfe4ea, inset 0 0 1px 0 #c4c4c4, 3px 3px 5px -3px #c4c4c4; min-height: 50vh">
						<div style="display: flex">
							<h3  style="color: #de470f; font-weight: bold; padding: 10px; flex-grow: 1">Phần mềm</h3>
							<button class="btn btn-primary" data-toggle="modal" data-target="#addPM" style="flex-basis: auto;"><i class="fa fa-plus" aria-hidden="true"></i> Thêm phần mềm</button>
						</div>
						
						<hr>
						@foreach($getDetailPhong->phanmemphong as $pmp)
							<div style="padding: 10px;  box-shadow: -4px -2px 4px 0 #fff, 4px 2px 6px 0 #dfe4ea, inset 0 0 1px 0 #c4c4c4, 3px 3px 5px -3px #c4c4c4; border-radius: 4px;  font-weight: bold; display: flex;">
								<p style="flex-grow: 1; margin-bottom: 0px"><i class="fa fa-television" aria-hidden="true"></i> {{$pmp->phanmem->pm_ten}}- phiên bản <button class="btn btn-primary">{{$pmp->phanmem->version_software[0]->version}}</button> </p>
								<div style="flex-basis: auto;">
									<a href="{{ url('admin/phong/delete-software') }}/{{ Request()->id }}/{{$pmp->phanmem->version_software[0]->ver_ma}}/{{$pmp->phanmem->version_software[0]->pm_id}}"><button class="btn" style=" box-shadow: -4px -2px 4px 0 #fff, 4px 2px 6px 0 #dfe4ea, inset 0 0 1px 0 #c4c4c4, 3px 3px 5px -3px #c4c4c4; border-radius: 4px;  border: unset;"><i class="fa fa-trash" aria-hidden="true" style="color: red"></i></button>
										</a> 
								</div>
							</div>
							<br/>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal Phòng -->
<div id="addPM" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #de470f; color: #fff;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Thêm phần mềm vào phòng</h4>
			</div>
			<form method="POST" action="{{ route('admin.phongdetail.add')}}">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-8">
								<label>
									Chọn phần mềm:
								</label>
								<select name="pm_id" class="form-control" id="pmid">
									@foreach($getAllPM as $pm)
										<option value="{{ $pm->pm_id }}">{{ $pm->pm_ten }}</option>
									@endforeach
								</select>
	
								</div>
								<div class="col-md-4">
								<label>
									Chọn phiên bản:
								</label>
								<input type="hidden" name="phong_stt" value="{{ Request()->id }}">
								
								<div id="ajaxResult">
									<select name="pm_id" class="form-control" disabled>
										<option value=""></option>
									</select>
								</div>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#pmid').change(function(event) {
			let id = $(this).val();
			$.ajax({
		        type: "GET",
		        url: `{{ url('admin/ajax/get-version') }}`,
		        data: {
		            id: id,
		        },
		        success: function(result) {
		            let data = result.data;
		            let code = '<select name="ver_ma" class="form-control">';
		            data.forEach(e =>(
		            	code += '<option value="'+e.ver_ma+'">'+e.version+'</option>'
		            ));
		            code += '</select>';
		            $("#ajaxResult").html(code);
		        }
		    });
		});
	});
</script>
@endsection