@extends('templates.admin.adminLTE.layout')

@push('title')
Form User Api Key
@endpush

@push('page-name')
Form User Api Key
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
          <h4>Data User Api Key</h4>
          <div class="row">

            <!-- Label -->
            <div class="form-group col-md-12">
              <label for="label">Label <span class="text-danger">*</span></label>
              <input autocomplete="off" name="label" type="text" class="form-control" id="label" placeholder="" value="{{isset($data) ? $data->label:''}}">
            </div>
            
            {{-- <!-- Key -->
            <div class="form-group col-md-12">
              <label for="key">Key <span class="text-danger">*</span></label>
              <input autocomplete="off" name="key" type="text" class="form-control" id="key" placeholder="" value="{{isset($data) ? $data->key:''}}">
            </div>
             --}}

            @if (auth()->user()->isSuper())
              <!-- User Id -->
              <div class="form-group col-md-12">
                <label for="user_id">User <span class="text-danger">*</span></label>
                <select name="user_id" id="user_id" selectpicker class="form-control">
                  <option value="">- Chosee -</option>
                  @foreach ((new App\User)->get() as $user)
                      <option value="{{$user->id}}">{{$user->name}}</option>
                  @endforeach
                </select>
              </div>                
            @endif


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
