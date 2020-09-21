@extends('templates.admin.adminLTE.layout')

@push('title')
Form Purchase
@endpush

@push('page-name')
Form Purchase
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
          <h4>Data Purchase</h4>
          <div class="row">


            <!-- No Purchase Order -->
            <div class="form-group col-md-12">
              <label for="no_purchase_order">No Purchase Order <span class="text-danger">*</span></label>
              <input autocomplete="off" name="no_purchase_order" type="text" class="form-control" id="no_purchase_order" placeholder="" value="{{isset($data) ? $data->no_purchase_order:''}}">
            </div>
            
            <!-- Nama Project -->
            <div class="form-group col-md-12">
              <label for="nama_project">Nama Project <span class="text-danger">*</span></label>
              <input autocomplete="off" name="nama_project" type="text" class="form-control" id="nama_project" placeholder="" value="{{isset($data) ? $data->nama_project:''}}">
            </div>
            
            <!-- Customer -->
            <div class="form-group col-md-12">
              <label for="customer">Customer <span class="text-danger">*</span></label>
              <input autocomplete="off" name="customer" type="text" class="form-control" id="customer" placeholder="" value="{{isset($data) ? $data->customer:''}}">
            </div>
            
            <!-- Nominal Purchase Order -->
            <div class="form-group col-md-12">
              <label for="nominal_purchase_order">Nominal Purchase Order <span class="text-danger">*</span></label>
              <input autocomplete="off" name="nominal_purchase_order" type="number" class="form-control" id="nominal_purchase_order" placeholder="" value="{{isset($data) ? $data->nominal_purchase_order:''}}">
            </div>
            
            <!-- Status Delivery -->
            <div class="form-group col-md-12">
              <label for="status_delivery">Status Delivery <span class="text-danger">*</span></label>
              <input autocomplete="off" name="status_delivery" type="number" class="form-control" id="status_delivery" placeholder="" value="{{isset($data) ? $data->status_delivery:''}}">
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
