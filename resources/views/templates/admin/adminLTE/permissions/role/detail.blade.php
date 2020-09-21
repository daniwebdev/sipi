@extends('templates.admin.adminLTE.layout')

@push('title')
  {{__('Role Permissions')}}
@endpush

@section('content')
@section('content')

<form method="post" id="set_persmission_form" action="{{route('permissions.role.set')}}">
  @csrf
  <input type="hidden" name="role_id" value="{{$role->id}}" />
  <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $role->name }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>

                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>

        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 20px">No</th>
                        <th style="width: 200px">Menu</th>
                        @foreach ($actions as $item)
                          <th class="text-center" style="width: 100px">{{$item['name']}}</th>
                        @endforeach
                        <th style="width: 150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($menus as $item)
                        <tr>
                            <td style="vertical-align: middle">{{$no++}}</td>
                            <td>
                                {{$item->title}}<br/>
                                <small>{{$item->url}}</small>
                            </td>
                            @foreach ($actions as $act)
                              <td class="text-center">

                                @if(in_array($act['supfix'], json_decode($item->actions) ?? []))
                                    <input type="checkbox" id="{{$item->id}}_{{$act['supfix']}}" data-id="{{$item->id}}" name="action[{{$item->id}}][{{$act['supfix']}}][]" value="{{$act['supfix']}}" {{Role::getAction($role->id, $item->id, $act['supfix']) ? 'checked':''}} />
                                @endif
                              </td>
                            @endforeach
                            <td>
                              <button type="button" class="btn btn-primary btn-xs check-row">Check All</button>
                              <a  href="{{route('menu.edit', $item->uuid)}}" class="btn btn-info btn-xs">Edit Menu</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <div class="btn-group">
              <a class="btn btn-secondary" href="{{ $base }}"><i class="fa fa-arrow-left"></i> @lang('general.back')</a>
              {{-- <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button> --}}
          </div>
        </div>
    </div>
    <!-- /.card -->
</form>
@endsection

@push('styles')
<!-- Toastr -->
<link rel="stylesheet" href="/theme/plugins/toastr/toastr.min.css">
@endpush

@push('scripts')
<!-- Toastr -->
<script src="/theme/plugins/toastr/toastr.min.js"></script>

<script>
$("input[type='checkbox']").change(function() {

    let status = $(this).is(':checked');

    route = '{{route('permissions.role.set')}}';
    let menu_id = $(this).data('id');
    let action = $(this).val();
    status = status ? "create":"delete";

    axios.post(`${route}?status=${status}&menu_id=${menu_id}&action=${action}&role_id={{$role->id}}`).then(res => {
        if(res.data.status) {
            toastr.success(`${res.data.message}`)
        } else {
            toastr.warning(`${res.data.message}`)
        }
    })
});


$('#check-all, .check-row').click(function() {
  let checked = $(this).attr('data-checked');

  let checkbox = $('[type="checkbox"]'); 
  if($(this).attr('class').match(/check\-row/)) {
    checkbox = $(this).closest('tr').find('[type="checkbox"]');
  }


  if(checked == 'true') {
    $(this).attr('data-checked', 'false')
    $(this).text('Check All')
    checkbox.prop('checked', false);
  } else {
    $(this).text('Un-Check All')
    $(this).attr('data-checked', 'true')
    checkbox.prop('checked', true);
  }

  checkbox.each(function() {
    $(this).trigger('change')
  });
  
})
</script>

@endpush
