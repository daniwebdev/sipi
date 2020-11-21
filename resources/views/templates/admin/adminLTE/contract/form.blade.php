@extends('templates.admin.adminLTE.layout')

@push('title')
Form Contract
@endpush

@push('page-name')
Form Contract
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
          <h4>Data Contract</h4>
          <div class="row">


            <!-- No Contract Order -->
            <div class="form-group col-md-6">
              <label for="no_contract">No Contract Order <span class="text-danger">*</span></label>
              <input autocomplete="off" name="no_contract" type="text" class="form-control" id="no_contract" placeholder="" value="{{isset($data) ? $data->no_contract:''}}">
            </div>
            
            <!-- Nama Project -->
            <div class="form-group col-md-6">
              <label for="project_name">Nama Project <span class="text-danger">*</span></label>
              <input autocomplete="off" name="project_name" type="text" class="form-control" id="project_name" placeholder="" value="{{isset($data) ? $data->project_name:''}}">
            </div>
            
            <!-- Customer -->
            <div class="form-group col-md-6">
              <label for="customer">Customer <span class="text-danger">*</span></label>
              <input autocomplete="off" name="customer" type="text" class="form-control" id="customer" placeholder="" value="{{isset($data) ? $data->customer:''}}">
            </div>
            
            <!-- Customer -->
            <div class="form-group col-md-6">
              <label for="end_customer">End Customer <span class="text-danger">*</span></label>
              <input autocomplete="off" name="end_customer" type="text" class="form-control" id="end_customer" placeholder="" value="{{isset($data) ? $data->end_customer:''}}">
            </div>
       
            <!-- Year -->
            <div class="form-group col-md-6">
              <label for="project_year">Tahun Proyek <span class="text-danger">*</span></label>
              <input year autocomplete="off" name="project_year" type="text" class="form-control" id="project_year" placeholder="" value="{{isset($data) ? $data->end_customer:''}}">
            </div>
            
            <!-- Total Contract Value -->
            <div class="form-group col-md-6">
              <label for="total_contract_value">Total Contract Value <span class="text-danger">*</span></label>
              <input autocomplete="off" name="total_contract_value" type="text" class="form-control" id="total_contract_value" placeholder="" value="{{isset($data) ? $data->total_contract:''}}">
            </div>
            
            <!-- Total Contract Value -->
            <div class="form-group col-md-6">
              <label for="start_contract">Start Contract <span class="text-danger">*</span></label>
              <input tgl autocomplete="off" name="start_contract" type="text" class="form-control" id="start_contract" placeholder="" value="{{isset($data) ? $data->total_contract:''}}">
            </div>
            
            <!-- Total Contract Value -->
            <div class="form-group col-md-6">
              <label for="end_contract">End Contract <span class="text-danger">*</span></label>
              <input tgl autocomplete="off" name="end_contract" type="text" class="form-control" id="end_contract" placeholder="" value="{{isset($data) ? $data->total_contract:''}}">
            </div>
            
            <!-- Status -->
            <div class="form-group col-md-12">
              <label for="status_contract">Status<span class="text-danger">*</span></label>
              <select name="status_contract" id="status_contract" class="form-control">
                <option value="">- Pilih -</option>
                <option value="1">Aktif</option>
                <option value="0">Habis</option>
              </select>
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
<script src="/theme/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script src="/theme/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $('[year]').inputmask({
    mask: '####'
  });

  $('[tgl]').inputmask({
    mask: '##/##/####'
  });

  $('#total_contract_value').inputmask({
    alias: 'currency',
    rightAlign: false,
    prefix: " Rp. ",
    digits: '0',
    groupSeparator: ',',
  });

  $('[tgl]').datepicker({
    'dateFormat': 'dd/mm/yy'
  });

</script>
@endpush

@push('styles')
  <link rel="stylesheet" href="/theme/plugins/jquery-ui/jquery-ui.min.css">
@endpush
