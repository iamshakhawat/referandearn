@extends('layouts.dashboardlayout')
@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title">Dashboard</h4>
            <h4 class="card-title">Points: {{ ($network * 100) + (count($mynetworks) * 50) }}</h4>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Refer Details</h5>
        <hr>
        <canvas id="myChart"></canvas>
    </div>
</div>
@endsection 
@push('custom_js')
<script type="text/javascript">
    var canvas = document.getElementById('myChart');
    var datalabels = JSON.parse(@json($datelabel));
    var datedata = JSON.parse(@json($datedata));
    var data = {
        labels: datalabels,
        datasets: [
            {
                label: "Referral User",
                fill: true,
                lineTension: 0.1,
                backgroundColor: "rgba(75,192,192,0.4)",
                borderColor: "rgba(75,192,192,1)",
                pointBorderColor: "rgba(75,192,192,1)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(75,192,192,1)",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 5,
                pointHitRadius: 10,
                data: datedata,
            }
        ]
    };
    
    var option = {
      showLines: true
    };
    var myLineChart = Chart.Line(canvas,{
      data:data,
      options:option
    });
    
    </script>
@endpush