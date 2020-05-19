@extends('admin.master')
@section('content')
<div class="container-fluid">
	<br/>
	<div class="card-title">
		<div class="d-flex" style="display: flex;">
			<h3  style="color: #de470f; font-weight: bold; flex-grow: 1">QUẢN LÝ PHÒNG</h3>
			<button class="btn btn-primary" style="flex-basis: auto;" data-toggle="modal" data-target="#addPhong"><i class="fa fa-plus" aria-hidden="true"></i> Room</button>
		</div>
	</div>
	<div class="container-fluid" style="background: #f5f6f7; margin-top: 10px; min-height: 100vh; padding-top: 30px">
		<div class="row">
			
			@foreach($getAllPhong as $phong)
			<div class="col-md-3">
				<div style="background-color: #fff; border-radius: 5px;  padding: 10px 0px; box-shadow: -4px -2px 4px 0 #fff, 4px 2px 6px 0 #dfe4ea, inset 0 0 1px 0 #c4c4c4, 3px 3px 5px -3px #c4c4c4;">
					<div class="row">
						<div class="col-md-5 text-center">
							<i class="fa fa-home" aria-hidden="true" style="font-size: 8em; color: #de470f;"></i>
						</div>
						<div class="col-md-7" >
							<div style="margin-top: 1.5em">
								<h4> <strong> {{$phong->phong_ten}}</strong></h4>
								<div style="padding: 5px;  box-shadow: -4px -2px 4px 0 #fff, 4px 2px 6px 0 #dfe4ea, inset 0 0 1px 0 #c4c4c4, 3px 3px 5px -3px #c4c4c4;">
									<i class="fa fa-television" aria-hidden="true"></i> {{$phong->phong_slmay}} máy tính
								</div>
								<a href="{{ url('admin/phong/')}}/{{$phong->phong_stt}}" title=""><i class="fa fa-cog" aria-hidden="true" style="font-size: 1.5em; margin: 5px; color: #de470f; cursor: pointer;"></i></a>
								<i class="fa fa-pencil-square" aria-hidden="true" data-toggle="modal" data-target="#editPhong{{ $loop->iteration }}" style="font-size: 1.5em; margin: 5px; color: #de470f; cursor: pointer;"></i>

							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal edit Phòng -->
			<div id="editPhong{{ $loop->iteration }}" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header" style="background: #de470f; color: #fff;">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Thêm phòng</h4>
						</div>
						<form method="POST" action="{{ route('admin.phong.edit')}}">
							<div class="modal-body">
								<div class="container-fluid">
									<div class="row">
										<div class="col-md-12">
											<label>
												Tên phòng:
											</label>
											<input type="text" name="name" value="{{$phong->phong_ten}}"  class="form-control" placeholder="Tên phầm mềm...">
											<br/>
											<label>
												Số lượng máy:
											</label>
											<input type="number" name="soluong" value="{{$phong->phong_slmay}}"  class="form-control" placeholder="Số lượng máy">
											<input type="hidden" name="id" value="{{$phong->phong_stt}}"  class="form-control" placeholder="Số lượng máy">
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
			@endforeach
		</div>
	</div>
</div>
<!-- Modal Phòng -->
<div id="addPhong" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #de470f; color: #fff;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Thêm phòng</h4>
			</div>
			<form method="POST" action="{{ route('admin.phong.add')}}">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<label>
									Tên phòng:
								</label>
								<input type="text" name="name"  class="form-control" placeholder="Tên phầm mềm...">
								<br/>
								<label>
									Số lượng máy:
								</label>
								<input type="number" name="soluong"  class="form-control" placeholder="Số lượng máy">
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