@extends('templates.admin.adminLTE.layout')

@push('page-name')
Files
@endpush

@push('title')
Files
@endpush

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">

        @if (Role::isAllow("create"))
        <div class="btn-group">
            <button class="btn btn-primary btn-sm float-left" data-toggle="modal" data-target="#upload-modal">
                <i class="fa fa-upload"></i> Upload
            </button>
            <button class="btn btn-primary btn-sm float-left" data-toggle="modal" data-target="#create-folder">
                <i class="fa fa-plus"></i> Create Folder
            </button>
        </div>
        @endif

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3 float-right" action="{{route($resource.'.index')}}">
            <div class="input-group input-group-sm">
                <input style="background-color: #f2f4f6; border: none" class="form-control form-control-navbar"
                    type="search" placeholder="Search" aria-label="Search" name="search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" style="background-color: #f2f4f6" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
    </div>

    <div class="card-body" id="file-list-container">
        <div class="row">
            @foreach ($results as $item)
            <div class="col-md-3 col-sm-4 col-6">
                <div class="card card-body file-item">
                    <div class="toolbar">
                        <div class="btn-group">
                            <a class="btn btn-primary btn-sm" href="{{url($item->url)}}" target="_blank" rel=""><i
                                    class="fa fa-download" aria-hidden="true"></i> </a>
                            <button data-toggle="modal" data-target="#file-detail" class="btn btn-default btn-sm"><i
                                    class="fa fa-info-circle" aria-hidden="true"></i> </button>
                        </div>
                    </div>
                    <div class="cover"
                        style="background: url('{{url($item->url)}}') center no-repeat; background-size: cover;"></div>
                    <div class="file-info">
                        {{$item->original_name}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <div class="float-left">
            Total Result : {{$results->count()}}
        </div>
        <div class="float-right">
            {{$results->links()}}
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- /.card-footer -->
</div>

<!-- Modal -->
<div class="modal fade" id="upload-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Files</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="upload-files" class="dropzone"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="create-folder" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Folder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input autocomplete="off" type="text" class="form-control" name="name" id="name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('general.back')</button>
                <button type="button" class="btn btn-primary">@lang('general.save')</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="file-detail" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table
                    style="width: 100%; font-family:'Courier New', Courier, monospace; font-weight: normal; font-size: 12px">
                    <tr>
                        <td width="100">File Name</td>
                        <td>: ini-nama-file.jpg</td>
                    </tr>
                    <tr>
                        <td width="100">Size</td>
                        <td>: 100KB</td>
                    </tr>
                    <tr>
                        <td width="100">Location</td>
                        <td>: ini-nama-file.jpg</td>
                    </tr>
                    <tr>
                        <td width="100">Uploaded</td>
                        <td>: 2020-08-09 08:23:09</td>
                    </tr>
                    <tr>
                        <td width="100">Owner</td>
                        <td>: Nama User</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<template hidden>
    <div id="template" class="file-row">
        <!-- This is used as the file preview template -->
        <div style="width: 80px; float: left; max-height: 100px; overflow:hidden">
            <span class="preview"><img style="width: 100%" data-dz-thumbnail /></span>
        </div>
        <div style="width:220px; float: left">
            <div class="pl-3">
                <p class="name" data-dz-name></p>
                <strong class="error text-danger" data-dz-errormessage></strong>
                <p class="size" data-dz-size></p>
                <div class="btn-group dz-btn-group">
                    {{-- <button data-dz-remove class="btn btn-warning btn-sm cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel</span>
                    </button> --}}
                    <button data-dz-remove class="btn btn-danger btn-sm delete">
                        <i class="glyphicon glyphicon-trash"></i>
                        <span><i class="fa fa-trash"></i></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"
            aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
        </div>
    </div>
</template>
@endsection



@push('styles')
<!-- Toastr -->
<link rel="stylesheet" href="/theme/plugins/toastr/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/basic.min.css">
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.10.3/css/OverlayScrollbars.min.css" integrity="sha256-pkJRL+LZNw26HU21yhQ7dq3WvhAWdOD1tildYMve+kI=" crossorigin="anonymous" /> --}}
<style>
    #preview-container {
        position: fixed;
        z-index: 10000;
        bottom: 10px;
        right: 10px;
        width: 330px;
        overflow-y: scroll;
        max-height: 500px;
    }

    .dz-btn-group {
        position: absolute;
        top: 5px;
        right: 5px;
    }

    .file-row {
        margin-bottom: 10px;
        background: white;
        border: 1px solid #EEE;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress {
        height: 5px;
    }

    #file-list-container .file-item .toolbar {
        position: absolute;
        top: 10px;
        left: 10px;
        opacity: 0;
    }

    #file-list-container .file-item .file-info {
        padding: 10px;
        width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    #file-list-container .file-item:hover .toolbar {
        opacity: 1;
    }

    #file-list-container .file-item {
        position: relative;
        padding: 0px;
    }

    #file-list-container .file-item .cover {
        min-height: 200px;
        border-radius: 5px 5px 0px 0px;
    }

    .os-padding {
        /* position: relative !important; */
    }
</style>
@endpush

@push('scripts')
<!-- Toastr -->
<script src="/theme/plugins/toastr/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.10.3/js/jquery.overlayScrollbars.min.js" integrity="sha256-tuiqRu0+T8St8iILGYhLhgMs2iCLPG0HVJCIPm4uduE=" crossorigin="anonymous"></script> --}}
@if (session('status'))
<script>
    toastr.{{session('status')}}('{{session('message')}}')
</script>
@endif

<script>
    $(".delete").click(function() {
    let id = $(this).data('id');

      Swal.fire({
          title: '<strong>Are you sure?</strong>',
          type: 'question',
          html: 'Delete this data from database.',
          showCloseButton: true,
          showCancelButton: true,
          focusConfirm: false,
          confirmButtonText:
            '<i class="fa fa-check"></i> Yes',
          confirmButtonAriaLabel: 'Thumbs up, great!',
          cancelButtonText:
            '<i class="fa fa-times"></i> No',
          cancelButtonAriaLabel: 'Thumbs down'
        }).then(btn => {
          if(btn.value) {
            axios.delete(`{{route($resource.'.index')}}/${id}`).then(res => {
              if(res.data.status) {
                toastr.success(`${res.data.message}`)
                setTimeout(() => {
                  location.reload()
                }, 2000);
              }
            })
          }
        })
    });
    $('body').append('<div id="preview-container"></div>');

    Dropzone.autoDiscover = false;

    var myDropzone = new Dropzone("body", {
        url: '{{route("files.store")}}',
        previewsContainer: '#preview-container',
        previewTemplate: $('template').html()
    });

    myDropzone.on('sending', (file, xhr, formData) => {
        console.log(file)
        formData.append("filename", file.name);  
        formData.append("filesize", file.size);  
        formData.append("_token", "{{csrf_token()}}");  
        $("#preview-container").overlayScrollbars({
                  sizeAutoCapable: true,
                  scrollbars: {
                    autoHide: 'l',
                    clickScrolling: true
                  }
                });
    })
</script>
@endpush