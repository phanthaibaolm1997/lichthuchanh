@extends('admin.master')
@section('content')
<div class="container-fluid" style="background: #fff; margin-top: 10px; min-height: 100vh; padding-top: 30px">
	<div class="row">
		<div class="col-md-8">
			<div class="d-flex" style="display: flex">
				<h3  style="color: #de470f; font-weight: bold; flex-grow: 1">Phần Mềm</h3>
				<button class="btn btn-primary" style="flex-basis: auto;" data-toggle="modal" data-target="#addPM"><i class="fa fa-plus" aria-hidden="true"></i> Phầm mềm</button>
			</div>
			<br/>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Số thứ tự</th>
						<th>Tên phần mềm</th>
						<th>Phiên bản phần mềm</th>
						<th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($getAllPM as $pm)
					<tr>
						<th> {{ $loop->iteration }}</th>
						<td> {{ $pm->pm_ten }}</td>
						<td> 
							@foreach($pm->version_software as $ver)
							<button class="btn btn-primary">{{ $ver->version }}</button>
							@endforeach
						</td>
						<td>
							<button class="btn btn-success" data-toggle="modal" data-target="#addVerPM{{ $loop->iteration }}"><i class="fa fa-plus" aria-hidden="true"></i></button>
							<button class="btn btn-primary"  data-toggle="modal" data-target="#editPM{{ $loop->iteration }}"><i class="fa fa-pencil" aria-hidden="true"></i></button>
							<a href="{{ url('admin/phan-mem/delete/') }}/{{$pm->pm_id}}"> <button class="btn btn-danger"><i class="fa fa-remove" aria-hidden="true"></i></button></a>
						</td>
					</tr>
					<!-- Modal add version -->
					<div id="addVerPM{{ $loop->iteration }}" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background: #de470f; color: #fff;">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Add Version</h4>
								</div>
								<form method="POST" action="{{ route('admin.phanmemversion.add')}}">
									<div class="modal-body">
										<div class="container-fluid">
											<div class="row">
												<div class="col-md-12">
													<input type="text" name="name"  value="{{ $pm->pm_ten }}" class="form-control" placeholder="Tên phầm mềm..." disabled>
													<input type="hidden" name="pm_id"  value="{{ $pm->pm_id }}">
												</div>
											</div>
											@csrf
											<br/>
											<div class="d-flex" style="display: flex">
												<input type="text" name="version"  class="form-control" placeholder="Version phầm mềm..." >
												<button type="submit" class="btn btn-primary ml-2" style="flex-basis: auto; margin-left: 5px;" ><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- Modal add version -->
					<div id="editPM{{ $loop->iteration }}" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background: #de470f; color: #fff;">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Chỉnh sửa phần mềm</h4>
								</div>
								<form method="POST" action="{{ route('admin.phanmem.edit')}}">
									<div class="modal-body">
										<div class="container-fluid">
											<input type="hidden" name="pm_id"  value="{{ $pm->pm_id }}">
											@csrf
											<br/>
											<div class="d-flex" style="display: flex">

												<input type="text" name="name" value="{{ $pm->pm_ten }}"  class="form-control" placeholder="Tên phầm mềm..." >
												<button type="submit" class="btn btn-primary ml-2" style="flex-basis: auto; margin-left: 5px;" ><i class="fa fa-edit" aria-hidden="true"></i> Sửa</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-4">
			<h3  style="color: #de470f; font-weight: bold">Phiên bản</h3>
			<br/>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Số thứ tự</th>
						<th>Phần mềm</th>
						<th>Version</th>
						<th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					@foreach($getAllVersion as $version)
					<tr>
						<th> {{ $loop->iteration }}</th>
						<th> {{ $version->phanmem->pm_ten }}</th>
						<td> 
							<button class="btn btn-primary">{{ $version->version }}</button>
						</td>
						<td>
							<a href="{{ url('admin/phan-mem/delete-version/') }}/{{$version->pm_id}}/{{$version->ver_ma}}"><button class="btn btn-danger"><i class="fa fa-remove" aria-hidden="true"></i></button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- Modal Phần mềm -->
<div id="addPM" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #de470f; color: #fff;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Thêm mới phần mềm</h4>
			</div>
			<form method="POST" action="{{ route('admin.phanmem.add')}}">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<label>
									Tên phần mềm:
								</label>
								<input type="text" name="name"  class="form-control" placeholder="Tên phầm mềm...">
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