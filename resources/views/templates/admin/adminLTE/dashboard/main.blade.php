@extends('templates.admin.adminLTE.layout')
@push('title')
    Dashboard
@endpush
@section('content')
      <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">User Active</span>
              <span class="info-box-number">{{$count['users']}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-ticket-alt    "></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Contract</span>
              <span class="info-box-number">{{number_format($total_contract)}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-ticket-alt    "></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Unpaid Inv.</span>
              <span class="info-box-number">{{number_format($total_contract_unpaid)}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-ticket-alt    "></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Paid Inv</span>
              <span class="info-box-number">{{number_format($total_contract_paid)}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>

      {{-- Chart --}}
      <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Paid Invoice</h3>
              </div>
            </div>
            <div class="card-body">

              <div class="position-relative mb-4">
                <canvas id="invoice-paid-chart" height="200"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                  <i class="fas fa-square text-primary"></i> This year
                </span>

                <span>
                  <i class="fas fa-square text-gray"></i> Last year
                </span>
              </div>
            </div>
          </div>
          <!-- /.card -->
      </div>
      <!-- /.row -->
@endsection


@push('scripts')
<script src="/theme/plugins/chart.js/Chart.min.js"></script>
<script src="/theme/adminlte/dist/js/pages/ .js"></script>

<script>
  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true
   var salesChart  = new Chart($('#invoice-paid-chart'), {
    type   : 'bar',
    data   : {
      labels  : ['JAN', 'FEB', 'MAR', 'APR', 'MEI','JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor    : '#007bff',
          data           : [1000, 2000000, 3000000, 2500000, 2700000, 2500000, 3000000]
        },
        // {
        //   backgroundColor: '#ced4da',
        //   borderColor    : '#ced4da',
        //   data           : [700, 1700000, 2700000, 2000000, 1800000, 1500000, 2000000]
        // }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value, index, values) {
              if (value >= 1000000) {
                value /= 1000000
                value += 'Jt'
              }
              return 'Rp.' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })

</script>
@endpush
