@extends('templates.admin.adminLTE.layout')

@push('title')
Form People
@endpush

@push('page-name')
Form People
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
          <h4>Data People</h4>
          <div class="row">


            <!-- Fullname -->
            <div class="form-group col-md-12">
              <label for="fullname">Fullname <span class="text-danger">*</span></label>
              <input autocomplete="off" name="fullname" type="text" class="form-control" id="fullname" placeholder="" value="{{isset($data) ? $data->fullname:''}}">
            </div>
            
            <!-- Birthday -->
            <div class="form-group col-md-12">
              <label for="birthday">Birthday <span class="text-danger">*</span></label>
              <input datepicker autocomplete="off" name="birthday" type="text" class="form-control" id="birthday" placeholder="" value="{{isset($data) ? $data->birthday:''}}">
            </div>
            <!-- Gender -->
            <div class="form-group col-md-12">
              <label for="gender">Gender <span class="text-danger">*</span></label>
              <input autocomplete="off" name="gender" type="text" class="form-control" id="gender" placeholder="" value="{{isset($data) ? $data->gender:''}}">
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
<script src='/theme/plugins/jquery-ui/jquery-ui.min.js'></script>

<script>
//Datepicker
$('[datepicker]').datepicker({dateFormat: 'yy-mm-dd'});


</script>
@endpush

@push('styles')
<link rel='stylesheet' href='/theme/plugins/jquery-ui/jquery-ui.min.css' />
<link rel='stylesheet' href='/theme/plugins/jquery-ui/jquery-ui.theme.min.css' />

@endpush
