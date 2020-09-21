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


            <!-- Purchase Id -->
            <div class="form-group col-md-12">
              <label for="purchase_id">Purchase Id <span class="text-danger">*</span></label>
              <select name="purchase_id" id="purchase_id" selectpicker class="form-control">
                <option value="">- Chosee -</option>
                @foreach (\App\Models\Purchase::get() as $purchase)
                    <option value="{{$purchase->id}}">{{$purchase->name}}</option>
                @endforeach
              </select>
            </div>

            <!-- No Invoice -->
            <div class="form-group col-md-12">
              <label for="no_invoice">No Invoice <span class="text-danger">*</span></label>
              <input autocomplete="off" name="no_invoice" type="text" class="form-control" id="no_invoice" placeholder="" value="{{isset($data) ? $data->no_invoice:''}}">
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
<script src='/theme/plugins/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js'></script>

<script>
$('[selectpicker]').selectpicker();


</script>
@endpush

@push('styles')
<link rel='stylesheet' href='/theme/plugins/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css' />

@endpush
