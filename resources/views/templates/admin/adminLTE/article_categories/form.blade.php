@extends('templates.admin.adminLTE.layout')

@push('title')
Form Article Categories
@endpush

@push('page-name')
Form Article Categories
@endpush

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <!-- form start -->
      <form role="form" method="POST" action="{{ route($resource.'.store') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="id" value="{{isset($data) ? $data->id:''}}" />
        
        <div class="card-body">
          <h4>Data Article Categories</h4>
          <div class="row">


            <!-- Name -->
            <div class="form-group col-md-12">
              <label for="name">Name <span class="text-danger">*</span></label>
              <input autocomplete="off" name="name" type="text" class="form-control" id="name" placeholder="" value="{{isset($data) ? $data->name:''}}">
            </div>
            
            <!-- Description -->
            <div class="form-group col-md-12">
              <label for="description">Description <span class="text-danger">*</span></label>
              <input autocomplete="off" name="description" type="text" class="form-control" id="description" placeholder="" value="{{isset($data) ? $data->description:''}}">
            </div>
            <!-- Cover -->
            <div class="form-group col-md-12">
                <label for="cover">Cover</label>
                <div class="cover-preview mb-3">Category Article</div>
                <div class="input-group">
                    <div class="custom-file">
                    <input type="file" class="custom-file-input" id="cover" name="cover">
                    <label class="custom-file-label" for="cover">Choose file</label>
                    </div>
                </div>
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
<script src='/theme/plugins/bs-custom-file-input/bs-custom-file-input.min.js'></script>

<script>
  bsCustomFileInput.init();

  $('#cover').change(function() {
    let file = $(this)[0].files;

    let reader = new FileReader();
    reader.onload = (e) => {
      $('.cover-preview').attr('style', `background: url(${e.target.result}); background-position: center; background-size: 100%;`);
    }

    reader.readAsDataURL(file[0]);
  })
</script>
@endpush

@push('styles')
<style>
  .cover-preview {
    font-size: 20px;
    width: 100%;
    text-align: center;
    padding: 50px 0px;
    background: #eee;
    border-radius: 5px;

    box-shadow: 1px 1px 5px #aaa;
  }
</style>
@endpush
