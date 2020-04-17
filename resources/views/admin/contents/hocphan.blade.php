@extends('admin.master')
@section('content')
<div class="container-fluid" style="background: #fff; margin-top: 10px; min-height: 100vh; padding-top: 30px">
	<div class="row">
		<div class="col-md-8">
			<h3  style="color: #de470f;
			font-weight: bold;">DANH SÁCH HỌC PHẦN</h3>
			<BR/>
			<div class="panel-group" role="tablist">
				@foreach($getAllHP as $hp)
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="collapseListGroupHeading{{ $hp->hp_id }}" style="background-color: #e0470f; color: #fff;">
						<h4 class="panel-title">
							<a class="collapsed" data-toggle="collapse" href="#collapseListGroup{{ $hp->hp_id }}" aria-expanded="false" aria-controls="collapseListGroup{{ $hp->hp_id }}">
								<i class="fa fa-book" aria-hidden="true"></i> {{$hp->hp_ten}}
							</a>
						</h4>
					</div>
					<div id="collapseListGroup{{ $hp->hp_id }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapseListGroupHeading{{ $hp->hp_id }}">
						<ul class="list-group">
							<li class="list-group-item">{{ $hp->hp_id }} - {{$hp->hp_ten}} ({{$hp->lophocphan[0]->canbo->cb_ten}})</li>
						</ul>
					</div>
				</div>
				@endforeach
			</div>
			
		</div>
	</div>
</div>

@endsection