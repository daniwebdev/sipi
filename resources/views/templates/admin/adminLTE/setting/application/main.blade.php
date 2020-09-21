@extends('Admin::adminLTE.setting.layout')


@section('setting-title')
    Application
@endsection

@section('setting-body')
<form class="row">
    <div class="form-group col-md-6">
      <label for="app_name">App Name</label>
      <input type="text" name="app[name]" id="app_name" class="form-control" placeholder="Name" aria-describedby="helpId" value="{{config('app.name')}}">
      <small id="helpId" class="text-muted">Help text</small>
    </div>
    <div class="form-group col-md-6">
      <label for="app_version">Version</label>
      <input type="text" name="app[version]" id="app_version" class="form-control" placeholder="Name" aria-describedby="helpId" value="{{config('app.version')}}">
      <small id="helpId" class="text-muted">Help text</small>
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="form-group col-12">
      <label for="">Re-captcha status</label>
      <select class="form-control" name="recaptcha[status]">
        <option value="true">True</option>
        <option value="false">False</option>
      </select>
      <small id="helpId" class="text-muted">Help text</small>
    </div>

    <div class="form-group col-12">
      <label for="recaptcha[site_key]">Site Key</label>
      <input type="text" name="recaptcha[site_key]" id="recaptcha[site_key]" class="form-control" placeholder="" aria-describedby="helpId">
      <small id="helpId" class="text-muted">Help text</small>
    </div>
</form>
@endsection

@section('setting-footer')
<div class="btn-group">
    {{-- <a class="btn btn-secondary" href="{{ $base }}"><i class="fa fa-arrow-left"></i> Kembali</a> --}}
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
</div>
@endsection
@push('styles')
<!-- Bootstrap Select -->
<link rel="stylesheet" href="/theme/plugins/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css">

@endpush
@push('scripts')

<!-- Bootstrap Select -->
<script src="/theme/plugins/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js"></script>

<script>
    $('select').selectpicker();
</script>

@endpush