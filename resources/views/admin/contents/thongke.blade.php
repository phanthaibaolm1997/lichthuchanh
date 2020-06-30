@extends('admin.master')
@section('content')

<div class="container-fluid" style=" margin-top: 10px; min-height: 100vh; padding-top: 10px">
	<div class="card-title">
		<h3 style="color: #de470f; font-weight: bold; flex-grow: 1; margin-bottom: 0px;">THỐNG KÊ</h3>
	</div>
	<div class="row">
		<div class="col-md-7">
			<div class="card-title">
				<canvas id="myChart"></canvas>
				<br/>
				<h5 class="text-center">Biểu đồ: Thống kê số lượt phòng sử dụng</h5>
			</div>
		</div>
		<div class="col-md-5">
			<div class="card-title">
				<canvas id="myChartPMYC"></canvas>
				<br/>
				<h5 class="text-center">Biểu đồ: Thống kê phần mềm được yêu cầu</h5>
			</div>
		</div>
	</div>
</div>

@endsection
	

	
@section('javascript')
<script type="text/javascript">
		let arrPhong = [];
		let arrSLPM = [];
		let arrPM = [];
		let arrPMNum = [];
	</script>
	@foreach($pmPhong as $phong)
		<script type="text/javascript">
			arrPhong.push(`{{$phong->phong_ten}}`);
			arrSLPM.push(`{{count($phong->phanmemphong)}}`);
		</script>
	@endforeach
	@foreach($pmYeuCau as $pm)
		<script type="text/javascript">
			arrPM.push(`{{$pm->pm_ten}}`);
			arrPMNum.push(`{{count($pm->yeucau)}}`);
		</script>
	@endforeach
	<script type="text/javascript">
		console.log(arrPhong);
		var ctx = document.getElementById('myChart').getContext('2d');
		var chart = new Chart(ctx, {
		    type: 'line',
		    data: {
		        labels: arrPhong,
		        datasets: [{
		            label: 'Lượt thực hành',
		            backgroundColor: 'rgb(255, 99, 132, 0)',
		            borderColor: 'rgb(255, 99, 132)',
		            data: arrSLPM
		        }]
		    },
		    options: {}
		});

		var ctxPMYC = document.getElementById('myChartPMYC').getContext('2d');
		var chart = new Chart(ctxPMYC, {
		    type: 'pie',
		    data: {
		        labels: arrPM,
		        datasets: [{
		            label: 'Lượt thực hành',
		            borderColor: 'rgb(255, 255, 255)',
		            data: arrPMNum,
		            backgroundColor: [
				        "#2ecc71",
				        "#3498db",
				        "#95a5a6",
				        "#9b59b6",
				        "#f1c40f",
				        "#e74c3c",
				        "#34495e"
				      ],
		        }]
		    },
		    options: {}
		});
	</script>
@endsection