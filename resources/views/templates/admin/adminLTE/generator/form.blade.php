@extends('templates.admin.adminLTE.layout')
@push('page-name')
Form Builder
@endpush

@push('title')
Form Builder
@endpush

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card card-primary card-outline">
      <!-- form start -->
      <form role="form" method="POST" action="{{route('generator.store')}}">
        @csrf

        <input type="hidden" name="id" value="{{isset($data->id) ?? ''}}" />

        <div class="card-body">
          <div class="row">
            <div class="col-md-4">

              <div class="card card-body">
                <div class="row">
  
                  <div class="form-group col-md-12">
                    <label for="name">Module Name</label>
                    <input autocomplete="off" name="name" id="name" class="form-control"
                      value="{{isset($data) ? $data->name:''}}">
                    {{-- <small>Recomended: <i>CamelCase</i></small> --}}
                  </div>
      
                  <div class="form-group col-md-12">
                    <label for="name">Controller Name</label>
                    <input readonly name="" type="text" class="form-control" id="controller_name"
                      value="{{isset($data) ? $data->controller_name:''}}">
                  </div>
      
                  <div class="form-group col-md-12">
                    <label for="name">Model Name</label>
                    <input readonly name="" type="text" class="form-control" id="model_name"
                      value="{{isset($data) ? $data->model_name:''}}">
                  </div>
      
                  <div class="form-group col-md-12">
                    <label for="name">View Directory</label>
                    <input readonly name="" type="text" class="form-control" id="view_directory"
                      value="{{isset($data) ? $data->name:''}}">
                  </div>
      
                  <div class="form-group col-md-12">
                    <label for="name">Route Prefix</label>
                    <input readonly name="" type="text" class="form-control" id="route_prefix"
                      value="{{isset($data) ? $data->name:''}}">
                  </div>
      
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-input-properties">
                <i class="fas fa-plus"></i>
                {{__('Add')}}
              </button>
              <div class="card card-body">
                {{-- <button type="button" id="add-row" class="btn btn-primary btn-sm mt-2 mb-2">
                  <i class="fas fa-plus"></i>
                  Add Column
                </button> --}}
                <table hidden class="table table-bordered" id="table-column">
                  <thead>
                    <tr>
                      <th width="150px">Column Name</th>
                      <th width="100px">Type</th>
                      <th width="100px">Form As</th>
                      <th width="150px">Relation</th>
                      <th width="40px"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td scope="row">
                        <input type="text" class="form-control" name="columns[][name]">
                      </td>
                      
                      <td>
                        <select data-size=5 data-live-search=true name="columns[][type]">
                          <option value="">None</option>
                          <option value="foreignId">foreignId</option>
                          <option value="unsignedBigInteger">unsignedBigInteger</option>
                          <option value="bigIncrements">bigIncrements</option>
                          <option value="bigInteger">bigInteger</option>
                          <option value="binary">binary</option>
                          <option value="boolean">boolean</option>
                          <option value="char">char</option>
                          <option value="date">date</option>
                          <option value="dateTime">dateTime</option>
                          <option value="dateTimeTz">dateTimeTz</option>
                          <option value="decimal">decimal</option>
                          <option value="double">double</option>
                          <option value="enum">enum</option>
                          <option value="float">float</option>
                          <option value="geometry">geometry</option>
                          <option value="geometryCollection">geometryCollection</option>
                          <option value="increments">increments</option>
                          <option value="integer">integer</option>
                          <option value="ipAddress">ipAddress</option>
                          <option value="json">json</option>
                          <option value="jsonb">jsonb</option>
                          <option value="lineString">lineString</option>
                          <option value="longText">longText</option>
                          <option value="macAddress">macAddress</option>
                          <option value="mediumIncrements">mediumIncrements</option>
                          <option value="mediumInteger">mediumInteger</option>
                          <option value="mediumText">mediumText</option>
                          <option value="morphs">morphs</option>
                          <option value="uuidMorphs">uuidMorphs</option>
                          <option value="multiLineString">multiLineString</option>
                          <option value="multiPoint">multiPoint</option>
                          <option value="multiPolygon">multiPolygon</option>
                          <option value="nullableMorphs">nullableMorphs</option>
                          <option value="nullableUuidMorphs">nullableUuidMorphs</option>
                          <option value="nullableTimestamps">nullableTimestamps</option>
                          <option value="point">point</option>
                          <option value="polygon">polygon</option>
                          <option value="rememberToken">rememberToken</option>
                          <option value="set">set</option>
                          <option value="smallIncrements">smallIncrements</option>
                          <option value="smallInteger">smallInteger</option>
                          <option value="softDeletes">softDeletes</option>
                          <option value="softDeletesTz">softDeletesTz</option>
                          <option value="string">string</option>
                          <option value="text">text</option>
                          <option value="time">time</option>
                          <option value="timeTz">timeTz</option>
                          <option value="timestamp">timestamp</option>
                          <option value="timestampTz">timestampTz</option>
                          <option value="timestamps">timestamps</option>
                          <option value="timestampsTz">timestampsTz</option>
                          <option value="tinyIncrements">tinyIncrements</option>
                          <option value="tinyInteger">tinyInteger</option>
                          <option value="unsignedBigInteger">unsignedBigInteger</option>
                          <option value="unsignedDecimal">unsignedDecimal</option>
                          <option value="unsignedInteger">unsignedInteger</option>
                          <option value="unsignedMediumInteger">unsignedMediumInteger</option>
                          <option value="unsignedSmallInteger">unsignedSmallInteger</option>
                          <option value="unsignedTinyInteger">unsignedTinyInteger</option>
                          <option value="uuid">uuid</option>
                          <option value="year">year</option>
                        </select>
                      </td>

                      <td>
                        <select name="columns[][form_as]">
                          <option value="">None</option>
                          <option value="upload">Upload</option>
                        </select>
                      </td>
                      <td>
                        <input placeholder="ClassName" type="text" class="form-control" name="columns[][relation]">
                      </td>
                      <td>
                        <button type="button" class="btn btn-danger btn-sm del-row"><i class="fas fa-trash"></i></button>
                      </td>
                    </tr>
                  </tbody>
                </table>

                <div id="form-builder-container">
                  <span class="not-found">@lang('Not Found')</span>
                </div>

              </div>
              <div class="card card-body mt-3">
                <h5 class="p-0 mb-3">Option</h5>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input checked class="custom-control-input" type="checkbox" id="with-menu" value="option1">
                    <label for="with-menu" class="custom-control-label">With Page and Menu Persission <i style="font-size: 13px">(Not Checked: Only Model)</i></label>
                  </div>

                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="with-uuid">
                    <label for="with-uuid" class="custom-control-label">With UUID <i style="font-size: 13px">(Make uuid as primary key)</i></label>
                  </div>

                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="form-two-column">
                    <label for="form-two-column" class="custom-control-label">Form 2 Column</label>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <div class="btn-group">
            <a class="btn btn-secondary" href="{{ route('generator.index') }}"><i class="fa fa-arrow-left"></i>
              @lang('Back')</a>
            <button type="button" id="build-now-btn" class="btn btn-primary"><i class="fa fa-save"></i> @lang('Build Now')</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-input-properties" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Properties</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form action="" class="row" id="input-properties">

          <div class="form-group col-12">
            <label for="name">Input Label</label>
            <input autocomplete="off" type="text" class="form-control" name="input_label" id="input_label">
          </div>
          
          <div class="form-group col-12">
            <label for="name">Input Name</label>
            <input autocomplete="off" type="text" class="form-control" name="input_name" id="input_name">
          </div>

          <div class="form-group col-6">
            <label for="name">Data Type</label>
            <select class="form-group" selectpicker data-live-search="true" data-size="5" name="input_data_type" id="input_data_type">
              <option value="" data-subtitle="">- {{__('None')}} -</option>
              <option value="string" data-subtitle="">String</option>
              <option value="text" data-subtitle="">Text</option>
              <option value="longText" data-subtitle="">Long Text</option>
              <option value="integer" data-subtitle="">Integer</option>
              <option value="bigInteger" data-subtitle="">Big Integer</option>
              <option value="date" data-subtitle="">Date</option>
              <option value="dateTime" data-subtitle="">Date Time</option>
              <option value="timestamp" data-subtitle="">Timestamp</option>
            </select>
          </div>

          <div class="form-group col-6">
          </div>
          <div class="col-12">
            <hr/>
          </div>
          <div class="form-group col-6">
            <label for="name">Relation</label>
            <select class="form-group" selectpicker data-live-search="true" data-size="5" name="input_relation" id="input_relation">
              <option value="" data-subtitle="">- {{__('None')}} -</option>
              @php
                  $model = array_filter(scandir(app_path()), function($dir) {
                    return is_file(app_path($dir));
                  });
              @endphp
              @foreach ($model as $item)
                  <option value="{{str_replace('.php', '',$item)}}">{{str_replace('.php', '',$item)}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group col-6">
            <label for="">Fk</label>
            <input type="text" class="form-control" placeholder="Foreign Key" name="input_fk" id="input_fk">
          </div>

          <div class="col-12">
            <hr/>
          </div>

          <div class="form-group col-12">
            <label for="">Form Type</label>
            <select class="form-control" selectpicker data-live-search="true" data-size="5" name="input_form_type" id="input_form_type">
              <option value="default" data-subtitle="">Default</option>
              <option value="upload" data-subtitle="">Upload File</option>
              <option value="textarea" data-subtitle="">Textarea</option>
              <option value="enum" data-subtitle="">Enum (Choosen)</option>
            </select>
          </div>

        </form>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-form">Save</button>
      </div>

    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="process-dialog" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">CRUD Building...</h5>
      </div>
      <div class="modal-body">
        
        <div class="progress">
            <div id="build-progress-bar" class="progress-bar bg-primary" role="progressbar" style="width: 0%;"
                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>

        <pre style="font-size: 10px; font-weight: normal" class="p-0 m-0 mt-3" id="build-log"></pre>
      </div>
      <div class="modal-footer" style="justify-content:flex-start !important">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button> --}}
        <div id="progress-on" class="progress-status">
          <i class="fa fa-spinner fa-spin" aria-hidden="true"></i> <small> On Progress</small>
        </div>
        <div id="progress-success" class="text-success progress-status">
          <i class="fa fa-check" aria-hidden="true"></i> <small> Successful.</small>
        </div>
        <div id="progress-error" class="text-danger progress-status">
          <i class="fa fa-times" aria-hidden="true"></i> <small> Error..!</small>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Template Stub -->
<template class="form-builder-template" data-type="default">
  <div class="form-group input-item" style="display: none" id="input-{index}">
    <label for="" class="d-block">
      <span class="float-left">{label}</span>
      <span class="float-right editor-addon">
        <a href="#" class="fa fa-edit mr-2" style=""></a>
        <a href="#" class="fa fa-trash delete-input" style=""></a>
      </span>
      <div class="clearfix"></div>
    </label>
    <input name="{name}" palceholder="{placeholder}" class="form-control" value="">
  </div>
</template>

<template class="form-builder-template" data-type="textarea">
  <div class="form-group input-item" style="display: none" id="input-{index}">
    <label for="" class="d-block">
      <span class="float-left">{label}</span>
      <span class="float-right editor-addon">
        <a href="#" class="fa fa-edit mr-2" style=""></a>
        <a href="#" class="fa fa-trash delete-input" style=""></a>
      </span>
      <div class="clearfix"></div>
    </label>
    <textarea name="{name}" palceholder="{placeholder}" class="form-control" rows="3"></textarea>
  </div>
</template>

<template class="form-builder-template" data-type="upload">
  <div class="form-group input-item" style="display: none" id="input-{index}">
    <label for="" class="d-block">
      <span class="float-left">{label}</span>
      <span class="float-right editor-addon">
        <a href="#" class="fa fa-edit mr-2" style=""></a>
        <a href="#" class="fa fa-trash delete-input" style=""></a>
      </span>
      <div class="clearfix"></div>
    </label>
    <input type="file" class="form-control" name="{name}" />
  </div>
</template>
<!-- End Template Stub -->

@endsection

@push('scripts')

<script>
  const BASE_BUILD = "{{url('generator/build')}}";
</script>
<!-- Summernote -->
<script src="/theme/plugins/summernote/summernote-bs4.min.js"></script>
<!-- InputMask -->
<script src="/theme/plugins/moment/moment.min.js"></script>
<script src="/theme/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- Bootstrap Select -->
<script src="{{url('theme/plugins/bootstrap-select-1.13.9/js/bootstrap-select.js')}}"></script>

<script src="{{url('assets/app/generator/form.js')}}"></script>
@endpush

@push('styles')
<!-- summernote -->
<link rel="stylesheet" href="/theme/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<style>
  #build-log {
    max-height: 400px;
    overflow-y: scroll;
  }
</style>

@endpush