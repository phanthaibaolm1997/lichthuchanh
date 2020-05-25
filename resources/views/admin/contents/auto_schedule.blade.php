@extends('admin.master')
@section('content')
<div class="container-fluid" style="background: #f5f6f7; margin-top: 10px; min-height: 100vh; padding-top: 30px">
	<div class="card-title d-flex" style="display: flex">
		<h3  style="color: #de470f; font-weight: bold; flex-grow: 1">SẮP LỊCH TỰ ĐỘNG</h3>
	</div>
	<div class="card-title" style="padding: 5px;">
		<div class="row">
			<div class="col-md-8">
				<h5 style="color: #de470f; font-weight: bold; line-height: 40px; margin-bottom: 0px; ">DANH SÁCH HỌC PHẦN ĐĂNG KÝ</h5>
			</div>
			<div class="col-md-4">
				<p class="text-right" style="margin-bottom: 0px;">
					<a href="{{ route('sortcalender') }}" onclick="return confirm('Bạn muốn tự động sắp lịch?')"><button class="btn btn-success"><i class="fa fa-magic" aria-hidden="true"></i> Sắp lịch tự động</button></a>
					<a href="{{ route('admin.deltkb') }}" onclick="return confirm('[DEMO] Chức năng dùng để xóa dữ liệu lịch thực hành!')"><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Xóa mọi dữ liệu</button></a>
				</p>
			</div>
		</div>
	</div>
	<section>
		<div class="flash-message" style="width: 50%; margin: auto;" >
			@if(session('success'))
			  <p class="alert alert-success" id="boxMes">{{session('success')}}</p>
			@endif
		</div>
		<div class="row">
			@foreach($allGroup as $group)
			<div class="col-md-3">
				<div class="card-title">
					<p class="text-one-line"><strong>Học phần: </strong>{{$group->lophocphan->lhp_ten}}</p>
					<p><strong>Mã học phần: </strong>{{$group->lophocphan->hp_id}}</p>
					<p><strong>STT: </strong> #{{$group->sttnhom}}</p>
					<p style="margin-top: 10px; text-align: right;">
						@if($group->is_practice == 1)
							<span  style="border-radius: 4px;padding: 5px; color: #fff; background: #5cb85c;"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Đã sắp lịch</span>
						@else
							<span  style="border-radius: 4px;padding: 5px; color: #fff; background: #d9534f;"><i class="fa fa-ban" aria-hidden="true"></i> Chưa được sắp</span>
						@endif
						<span  style="border-radius: 4px;padding: 5px; color: #fff; background: #38a7da;">{{$group->nth_siso}} sinh viên</span>
					</p>
					<hr/>
					<h5 class="text-center">{{$group->lophocphan->canbo->cb_ten}}</h5>
				</div>
			</div>
			@endforeach
		</div>
	</section>
</div>
@endsection
<script type="text/javascript">
	setTimeout(function(){
	  if ($('#boxMes').length > 0) {
	    $('#boxMes').remove();
	  }
	}, 3000)
</script>