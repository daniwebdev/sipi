@extends('templates.admin.adminLTE.layout')
@push('title')
    Dashboard
@endpush
@section('content')
      <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
          <div class="info-box">
            <a href="{{route('contract.index')}}" class="info-box-icon bg-primary"><i class="fas fa-boxes    "></i></a>

            <div class="info-box-content">
              <span class="info-box-text">Total Contract</span>
              <span class="info-box-number">{{number_format($total_contract)}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-6 col-12">
          <div class="info-box">

            <a href="{{route('invoice.index')}}?status=UNPAID" class="info-box-icon bg-danger"><i class="fas fa-money-bill    "></i></a>

            <div class="info-box-content">
              <span class="info-box-text">Unpaid Invoice</span>
              <span class="info-box-number">{{number_format($total_contract_unpaid)}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-6 col-12">
          <div class="info-box">
            <a href="{{route('invoice.index')}}?status=PAID" class="info-box-icon bg-success"><i class="fas fa-money-check-alt    "></i></a>

            <div class="info-box-content">
              <span class="info-box-text">Paid Invoice</span>
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
                <h3 class="card-title">Invoice This Year</h3>
              </div>
            </div>
            <div class="card-body">

              <div class="position-relative mb-4">
                <canvas id="invoice-paid-chart" height="200"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                  <i class="fas fa-square text-success"></i> Paid
                </span>

                <span>
                  <i class="fas fa-square text-danger"></i> Unpaid
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
          backgroundColor: '#41A846',
          borderColor    : '#41A846',
          data           : {!! $total_invoice_paid !!}
        },
        {
          backgroundColor: '#DC3D45',
          borderColor    : '#DC3D45',
          data           : {!! $total_invoice_unpaid !!}
        }
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
