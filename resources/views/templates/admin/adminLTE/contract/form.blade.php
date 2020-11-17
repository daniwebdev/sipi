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
            <div class="form-group col-md-12">
              <label for="no_contract">No Contract Order <span class="text-danger">*</span></label>
              <input autocomplete="off" name="no_contract" type="text" class="form-control" id="no_contract" placeholder="" value="{{isset($data) ? $data->no_contract:''}}">
            </div>
            
            <!-- Nama Project -->
            <div class="form-group col-md-12">
              <label for="project_name">Nama Project <span class="text-danger">*</span></label>
              <input autocomplete="off" name="project_name" type="text" class="form-control" id="project_name" placeholder="" value="{{isset($data) ? $data->project_name:''}}">
            </div>
            
            <!-- Customer -->
            <div class="form-group col-md-12">
              <label for="customer">Customer <span class="text-danger">*</span></label>
              <input autocomplete="off" name="customer" type="text" class="form-control" id="customer" placeholder="" value="{{isset($data) ? $data->customer:''}}">
            </div>
            
            <!-- Nominal Contract Order -->
            <div class="form-group col-md-12">
              <label for="total_contract">Nominal Contract Order <span class="text-danger">*</span></label>
              <input autocomplete="off" name="total_contract" type="number" class="form-control" id="total_contract" placeholder="" value="{{isset($data) ? $data->total_contract:''}}">
            </div>
            
            <!-- Status Delivery -->
            <div class="form-group col-md-12">
              <label for="status_contract">Status Delivery <span class="text-danger">*</span></label>
              <input autocomplete="off" name="status_contract" type="number" class="form-control" id="status_contract" placeholder="" value="{{isset($data) ? $data->status_contract:''}}">
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

<script>

</script>
@endpush

@push('styles')

@endpush
