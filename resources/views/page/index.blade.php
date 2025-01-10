@extends('layout.main')

@section('title')
Dashboard
@endsection

@section('m1')
active
@endsection

@section('content')
<div class="container">
  <div class="page-inner">

    {{-- section 1 --}}
    <div class="row">
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-primary bubble-shadow-small">
                  <i class="fas fa-users"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Peserta Event</p>
                  <h4 class="card-title">{{ number_format($cpe) }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-info bubble-shadow-small">
                  <i class="fas fa-user-check"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Peserta Qris</p>
                  <h4 class="card-title">{{ number_format($pqr) }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-success bubble-shadow-small">
                  <i class="fas fa-luggage-cart"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Total Transaksi</p>
                  <h5 class="">Rp.{{ number_format($qtr) }}</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                  <i class="far fa-check-circle"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Jumlah Event</p>
                  <h4 class="card-title">{{ number_format($rfe) }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- section 2 --}}
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Tren Transaksi Bulanan</div>
          </div>
          <div class="card-body">
            <div class="chart-container">
              <canvas id="lineChart"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Top 5 Event</div>
          </div>
          <div class="card-body">
            <div class="chart-container">
              <canvas id="barChart" style="width: 100%"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Nama Usaha</div>
          </div>
          <div class="card-body">
            <div class="chart-container">
              <canvas id="pieChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>


    {{-- section 3 --}}

  </div>
</div>
@endsection

@section('style')
@endsection

@section('script')
<!-- Chart JS -->
<script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>
<script>
  var lineChart = document.getElementById("lineChart").getContext("2d"),
            barChart = document.getElementById("barChart").getContext("2d"),
            pieChart = document.getElementById("pieChart").getContext("2d");
    
            // data line chart

            $.ajax({
                  url:"http://localhost:8000/api/chart/transaksibulanan",
                  type:'GET',
                  cache:false,
                  }).done(function(json){
                  var seriesln = [];
                  var categoriesln = [];
                  // console.log(data);
                  $.each(json.respon,function(i,data){
                  seriesln.push(data.jml);
                  categoriesln.push(data.nama_event);
                  });

           var myLineChart = new Chart(lineChart, {
            type: "line",
            data: {
              labels: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
              ],
              datasets: [
                {
                  label: "Tren Transaksi",
                  borderColor: "#1d7af3",
                  pointBorderColor: "#FFF",
                  pointBackgroundColor: "#1d7af3",
                  pointBorderWidth: 2,
                  pointHoverRadius: 4,
                  pointHoverBorderWidth: 1,
                  pointRadius: 4,
                  backgroundColor: "transparent",
                  fill: true,
                  borderWidth: 2,
                  data: seriesln,
                },
              ],
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              legend: {
                position: "bottom",
                labels: {
                  padding: 10,
                  fontColor: "#1d7af3",
                },
              },
              tooltips: {
                bodySpacing: 4,
                mode: "nearest",
                intersect: 0,
                position: "nearest",
                xPadding: 10,
                yPadding: 10,
                caretPadding: 10,
              },
              layout: {
                padding: { left: 15, right: 15, top: 15, bottom: 15 },
              },
            },
           });
        });
          // data bar chart
    
          $.ajax({
              url:"http://localhost:8000/api/chart/top_event",
              type:'GET',
              cache:false,
              }).done(function(json){
                var seriesbar = [];
                var categoriesbar = [];
              // console.log(data);
              $.each(json.respon,function(i,data){
              seriesbar.push(data.jml);
              categoriesbar.push(data.nama_event);
              });


              // console.log(categoriesbar);
          
              
           var myBarChart = new Chart(barChart, {
            
            type: "bar",
            data: {
              labels: 
                categoriesbar
              ,
              datasets: [
                {
                  label: "Visitors",
                  backgroundColor: "rgb(23, 125, 255)",
                  borderColor: "rgb(23, 125, 255)",
                  data: seriesbar,
                },
              ],
            },
            options: {
              
              tooltips: {
              callbacks: {
              title: function(t, d) {
              return d.labels[t[0].index];
              }
              }
              },
              responsive: false,
              maintainAspectRatio: true,
              scales: {
                yAxes: [
                  {
                    ticks: {
                      beginAtZero: true,
                    },
                  },
                ],
               xAxes: [{
                display:false
              }]
              },
              plugins: {
              datalabels: {
              anchor: 'end',
              align: 'top',
              formatter: Math.round,
              font: {
              weight: 'bold'
              }
              }
              }
            },
            });
          });

          // data pie chart
          $.ajax({
                    url:"http://localhost:8000/api/chart/jmlnamausaha",
                    type:'GET',
                    cache:false,
                    }).done(function(json){
                    var seriespie = [];
                    var categoriespie = [];
                    // console.log(data);
                    $.each(json.respon,function(i,data){
                    seriespie.push(data.jml);
                    categoriespie.push(data.nama_usaha);
                    });
            var myPieChart = new Chart(pieChart, {
            type: "pie",
            data: {
              datasets: [
                {
                  data: seriespie,
                  backgroundColor: ["#1d7af3", "#f3545d", "#fdaf4b","#1d7af3", "#f3545d", "#fdaf4b","#1d7af3", "#f3545d", "#fdaf4b","#1d7af3", "#f3545d", "#fdaf4b","#1d7af3", "#f3545d", "#fdaf4b","#1d7af3", "#f3545d", "#fdaf4b","#1d7af3", "#f3545d", "#fdaf4b","#1d7af3", "#f3545d", "#fdaf4b"],
                  borderWidth: 0,
                },
              ],
              labels: categoriespie,
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              legend: {
                display: false,
                position: "bottom",
          
              },
              pieceLabel: {
                render: "percentage",
                fontColor: "white",
                fontSize: 14,
              },
              tooltips: {
                events: ['click']
              },
              layout: {
                padding: {
                  left: 20,
                  right: 20,
                  top: 20,
                  bottom: 20,
                },
              },
            },
            });
          });


</script>
@endsection