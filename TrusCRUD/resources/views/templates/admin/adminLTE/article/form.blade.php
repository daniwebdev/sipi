@extends('templates.admin.adminLTE.layout')

@push('title')
Form Article
@endpush

@push('page-name')
Form Article
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
          <h4>New Article</h4>
          <div class="row">


            <!-- Title -->
            <div class="form-group col-md-12">
              <label for="title">Title <span class="text-danger">*</span></label>
              <input autocomplete="off" name="title" type="text" class="form-control" id="title" placeholder="" value="{{isset($data) ? $data->title:''}}">
              <small>Permalink : /<span class="text-permalink"></span> <i style="display: none" id="permalink-loading" class="fa fa-spinner fa-spin text-success" aria-hidden="true"></i></small>
            </div>

            <!-- Permalink -->
            <div hidden class="form-group col-md-6">
              <label for="permalink">Permalink <span class="text-danger">*</span></label>
              <input autocomplete="off" name="permalink" type="text" class="form-control" id="permalink" placeholder="" value="{{isset($data) ? $data->permalink:''}}">
            </div>
            
            <!-- Cover -->
            <div class="form-group col-md-6">
                <label for="cover">Cover</label>
                <div class="input-group">
                    <div class="custom-file">
                    <input type="file" class="custom-file-input" id="cover" name="cover">
                    <label class="custom-file-label" for="cover">Choose file</label>
                    </div>
                </div>
            </div>

                        
            <!-- Category Id -->
            <div class="form-group col-md-6">
              <label for="category_id">Category <span class="text-danger">*</span></label>
              {{-- <input autocomplete="off" name="category_id" type="text" class="form-control" id="category_id" placeholder="" value="{{isset($data) ? $data->category_id:''}}"> --}}
              <select data-live-search="true" name="category_id" id="category_id" class="form-control">
                <option value="">- Pilih -</option>
                @foreach ($categories as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
              </select>
            </div>
            

            <!-- Content -->
            <div class="form-group col-md-12">
              <label for="content">Content <span class="text-danger">*</span></label>
              <textarea summernote name="content" class="form-control" id="content" placeholder="">{{isset($data) ? $data->content:''}}</textarea>
            </div>
            
            <!-- Description -->
            <div class="form-group col-md-12">
              <label for="description">Description</label>
              <input autocomplete="off" name="description" type="text" class="form-control" id="description" placeholder="" value="{{isset($data) ? $data->description:''}}">
            </div>
            
            <!-- Tags -->
            <div class="form-group col-md-12">
              <label for="tags">Tags</label>
              <input autocomplete="off" name="tags" type="text" class="form-control" id="tags" placeholder="" value="{{isset($data) ? $data->tags:''}}">
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
<script src='{{url('theme/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}'></script>
<script src='{{url('theme/plugins/summernote/summernote.min.js')}}'></script>
<script src='{{url('theme/plugins/summernote/summernote-bs4.min.js')}}'></script>
<script src="{{url('theme/plugins/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js')}}"></script>

<script>
  bsCustomFileInput.init();
  $('select').selectpicker()


//Summernote
$(function () {
  // Summernote
  $('[summernote]').summernote({
    height: 200,
    toolbar: [
      // [groupName, [list of button]]
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['font', ['strikethrough', 'superscript', 'subscript']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['height', ['height']]
    ]
  })

})
function permalink(str) {
    var re = /[^a-z0-9]+/gi; // global and case insensitive matching of non-char/non-numeric
    var re2 = /^-*|-*$/g; // get rid of any leading/trailing dashes
    str = str.replace(re, '-'); // perform the 1st regexp
    return str.replace(re2, '').toLowerCase(); // ..aaand the second + return lowercased result
}

$('#title').keyup(function() {
  let _permalink = permalink($(this).val());
  $('#permalink').val(_permalink)
  $('.text-permalink').text(_permalink)

  $('#permalink-loading').show();
  setTimeout(function() {
    $('#permalink-loading').hide();
  }, 2000)
});
</script>
@endpush

@push('styles')
<link rel='stylesheet' href='{{url('theme/plugins/summernote/summernote.css')}}' />
<link rel='stylesheet' href='{{url('theme/plugins/summernote/summernote-bs4.css')}}' />
<link rel='stylesheet' href='{{url('theme/plugins/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css')}}' />

@endpush
