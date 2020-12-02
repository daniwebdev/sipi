@extends('templates.admin.adminLTE.layout')

@push('title')
Form Invoice
@endpush

@push('page-name')
Form Invoice
@endpush

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <!-- form start -->
      <form role="form" method="POST" action="{{ route($resource.'.store') }}" >
        @csrf

        <input type="hidden" name="id" value="{{isset($data) ? $data->id:''}}" />
        
        <div class="card-body">
          <h4>Data Invoice</h4>
          <div class="row">

            <!-- Contract Id -->
            <div class="form-group col-md-6">
              <label for="contract_id">Contract <span class="text-danger">*</span></label>
              <select name="contract_id" id="contract_id" selectpicker class="form-control">
                <option value="">- Chosee -</option>
                @foreach (\App\Models\Contract::get() as $Contract)
                    <option {{(isset($data) && $data->contract_id == $Contract->id ? 'selected':'')}} data-json='{!! $Contract !!}' value="{{$Contract->id}}" data-subtext="{{$Contract->customer}} | {{$Contract->end_customer}}">{{$Contract->no_contract}}</option>
                @endforeach
              </select>
            </div>

            <!-- No Invoice -->
            <div class="form-group col-md-6">
              <label for="no_invoice">No Invoice <span class="text-danger">*</span></label>
              <input autocomplete="off" name="no_invoice" type="text" class="form-control" id="no_invoice" placeholder="" value="{{isset($data) ? $data->no_invoice:''}}">
            </div>

            <!-- Date Invoice -->
            <div class="form-group col-md-6">
              <label for="date_invoice">Date of Invoice <span class="text-danger">*</span></label>
              <input value="{{isset($data) ? $data->periode_invoice[0]:''}}" tgl autocomplete="off" name="date_invoice" type="text" class="form-control" id="date_invoice" placeholder="" value="{{isset($data) ? $data->date_invoice:''}}">
            </div>

            <!-- Date Invoice -->
            <div class="form-group col-md-3">
              <label for="start_bill">Start Bill <span class="text-danger">*</span></label>
              <input value="{{isset($data) ? $data->periode_invoice[1]:''}}" tgl autocomplete="off" name="bill[]" type="text" class="form-control" id="start_bill" placeholder="" value="{{isset($data) ? $data->date_invoice:''}}">
            </div>

            <!-- Date Invoice -->
            <div class="form-group col-md-3">
              <label for="end_bill">End Bill <span class="text-danger">*</span></label>
              <input tgl autocomplete="off" name="bill[]" type="text" class="form-control" id="end_bill" placeholder="" value="{{isset($data) ? $data->date_invoice:''}}">
            </div>

            <!-- Date Invoice -->
            <div class="form-group col-md-3">
              <label for="total_invoice">Total Bill <span class="text-danger">*</span></label>
              <input autocomplete="off" name="total_invoice" type="text" class="form-control" id="total_invoice" placeholder="" value="{{isset($data) ? $data->total_invoice:''}}">
            </div>

            <!-- Date Invoice -->
            <div class="form-group col-md-3">
              <label for="total_bayar">Total Bayar <span class="text-danger">*</span></label>
              <input autocomplete="off" name="total_bayar" type="text" class="form-control" id="total_bayar" placeholder="" value="{{isset($data) ? $data->total_bayar:''}}">
            </div>

            <!-- Date Invoice -->
            <div class="form-group col-md-3">
              <label for="total_sisa">Total Sisa <span class="text-danger">*</span></label>
              <input readonly autocomplete="off" name="total_sisa" type="text" class="form-control" id="total_sisa" placeholder="" value="{{isset($data) ? $data->total_sisa:''}}">
            </div>

            <!-- Date Invoice -->
            <div class="form-group col-md-3">
              <label for="status">Status <span class="text-danger">*</span></label>
              <select class="form-control" selectpicker name="status" id="status">
                <option {{isset($data) && $data->status == 'UNPAID' ? 'selected':''}} value="UNPAID">Unpaid</option>
                <option {{isset($data) && $data->status == 'PAID' ? 'selected':''}} value="PAID">Paid</option>
                <option {{isset($data) && $data->status == 'KREDIT' ? 'selected':''}} value="KREDIT">Kredit</option>
                <option {{isset($data) && $data->status == 'SUSPEND' ? 'selected':''}} value="SUSPEND">Suspend</option>
              </select>
            </div>

            <!-- Keterangan -->
            <div class="form-group col-md-12">
              <label for="status">Keterangan</label>
              <textarea name="keterangan" id="keterangan"  rows="4" class="form-control"></textarea>
            </div>
            
          </div>

          <hr />
          <div class="row">
            <h4 class="col-md-12">Data Contract</h4>
            <div class="form-group col-md-6">
              <label for="" style="font-size: 18px">No Contract</label>
              <p id="no_contract" style="font-size: 15px; margin: 0px">-</p>
            </div>
            <div class="form-group col-md-6">
              <label for="" style="font-size: 18px">Customer</label>
              <p style="font-size: 15px; margin: 0px">
                <div class="mb-2"><i class="fa fa-building" aria-hidden="true"></i> <span id="customer">-</span> </div>
                <i class="fa fa-user-circle" aria-hidden="true"></i> <span id="end_customer">-</span>
              </p>
            </div>
            
            <div class="form-group col-md-12">
              <label for="" style="font-size: 18px">Project</label>
              <p id="project_name" style="font-size: 15px; margin: 0px">-</p>
            </div>

            <div class="form-group col-md-4">
              <label for="" style="font-size: 18px">Mulai Proyek</label>
              <p id="start_contract" style="font-size: 15px; margin: 0px">-</p>
            </div>
            
            <div class="form-group col-md-4">
              <label for="" style="font-size: 18px">Akhir Proyek</label>
              <p id="end_contract" style="font-size: 15px; margin: 0px">-</p>
            </div>

            <div class="form-group col-md-4">
              <label for="" style="font-size: 18px">Masa Proyek</label>
              <p id="periode_contract" style="font-size: 15px; margin: 0px">-</p>
            </div>

            <div class="form-group col-md-4">
              <label for="" style="font-size: 18px">Total Nilai Proyek</label>
              <p id="total_contract_value" style="font-size: 15px; margin: 0px">-</p>
            </div>

            <div class="form-group col-md-4">
              <label for="" style="font-size: 18px">Sisa Pembyaran</label>
              <p id="balance" style="font-size: 15px; margin: 0px">-</p>
            </div>

          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <div class="btn-group">
            <a class="btn btn-secondary" href="{{ route($resource.'.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="/theme/plugins/moment/moment-with-locales.min.js"></script>
<script src='/theme/plugins/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js'></script>
<script src="/theme/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="/theme/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

<script>
$('[selectpicker]').selectpicker();

$(document).ready(function() {
  $('#contract_id').trigger('change');
})
$('#contract_id').change(function() {
  let data = $(this).find(':selected').data('json');
  
  data.total_contract_value = 'Rp. '+ data.total_contract_value.toLocaleString();
  data.balance = 'Rp. '+ data.balance.toLocaleString();
  
  for(let i in data) {
    $('#'+i).text(data[i]);
  }

  var starts   = moment(data.start_contract);
  var ends     = moment(data.end_contract);
  var duration = moment.duration(ends.diff(starts));

  $('#periode_contract').text('± '+Math.round(duration.asMonths())+" bulan")
});

$('[tgl]').inputmask({
    mask: '##/##/####'
  });

  $('#total_invoice, #total_bayar, #total_sisa').inputmask({
    alias: 'currency',
    rightAlign: false,
    prefix: " Rp. ",
    digits: '0',
    groupSeparator: ',',
  });

  $('[tgl]').datepicker({
    'dateFormat': 'dd/mm/yy'
  });

$('#total_bayar').keyup(function() {
  let value = $(this).val().replace(/\D/g, '');

  let total_invoice = $('#total_invoice').val().replace(/\D/g, '');

  let sisa = parseInt(total_invoice) - parseInt(value);
  console.log(sisa)
  $('#total_sisa').val(sisa);
});
</script>
@endpush

@push('styles')
<link rel='stylesheet' href='/theme/plugins/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css' />
<link rel="stylesheet" href="/theme/plugins/jquery-ui/jquery-ui.min.css">

@endpush
