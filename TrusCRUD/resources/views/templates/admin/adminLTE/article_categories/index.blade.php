@extends('templates.admin.adminLTE.layout')

@push('title')
    Article Categories
@endpush
@push('page-name')
Article Categories
@endpush

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">

        @if (Role::isAllow("create"))
            <div class="btn-group">
            <a href="{{route($resource.'.create')}}" class="btn btn-primary btn-sm float-left">
                <i class="fa fa-plus"></i> Create
            </a>
            </div>
        @endif
        <!-- SEARCH FORM -->
        <form class="form-inline ml-3 float-right" action="{{route($resource.'.index')}}">
          <div class="input-group input-group-sm">
            <input style="background-color: #f2f4f6; border: none" class="form-control form-control-navbar"
              type="search" placeholder="Search" aria-label="Search" name="search" value="{{Request::get('search')}}">
            <div class="input-group-append">
              <button class="btn btn-navbar" style="background-color: #f2f4f6" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
        <div class="clearfix"></div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
          <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
										<th>Name</th>
										<th>Description</th>
										<th style="width: 200px">Cover</th>

                    <th style="width: 80px">Status</th>
                    <th style="width: 160px">Action</th>
                  </tr>
                </thead>
                @if (!count($results))
                <tr>
                  <td colspan="6" class="text-center">@lang('Not Found')</td>
                </tr>
                @endif
                <tbody>
                  @php
                  $no = ($results->currentPage() - 1) * $results->perPage() + 1;
                  @endphp
                  @foreach ($results as $item)

                  <tr>
                    <td style="vertical-align: middle">{{ $no }}</td>
										<td style="vertical-align: middle">{{ $item->name }}</td>
										<td style="vertical-align: middle">{{ $item->description }}</td>
										<td style="vertical-align: middle">
                      @if (isset($item->get_cover->url))
                        {{-- <img width="20" class="image" src="" /> --}}
                        <div class="image-cover" style="background: url({{ $item->get_cover->url }});background-position: center; background-size: 100%">
                        </div>
                      @endif
                    </td>

                    <td style="vertical-align: middle">
                      @if(!$item->deleted_at)
                        <span class="badge bg-success">Aktif</span>
                      @else
                        <span class="badge bg-danger">Deleted</span>
                      @endif
                    </td>
                    <td style="vertical-align: middle">
                        <a href="{{route($resource.'.edit', $item->id)}}" class="btn btn-primary btn-xs text-white"><i class="fas fa-pencil-alt"></i> Edit</a>
                        @if($item->deleted_at)
                        <button class="btn btn-success btn-xs text-white restore" data-id="{{$item->id}}"><i class="fas fa-sync-alt"></i> Restore</button>
                        @else
                          @if (Role::isAllow("destroy"))
                          <button class="btn btn-danger btn-xs text-white delete" data-id="{{$item->id}}"><i class="fas fa-trash"></i> Delete</button>
                          @endif
                        @endif
                    </td>
                  </tr>
                  @php
                  $no++;
                  @endphp
                  @endforeach

                </tbody>
              </table>
          </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <div class="float-left">
            Total Result : {{$results->total()}}
        </div>
        <div class="float-right">
            {{$results->links()}}
        </div>
        <div class="clearfix"></div>
      </div>
      <!-- /.card-footer -->
    </div>
  </div>
</div>
@endsection



@push('styles')
<!-- Toastr -->
<link rel="stylesheet" href="/theme/plugins/toastr/toastr.min.css">
<style>
.image-cover {
  width: 200px;
  height: 60px;
  border-radius: 5px;
}
</style>
@endpush

@push('scripts')
<!-- Toastr -->
<script src="/theme/plugins/toastr/toastr.min.js"></script>
@if (session('status'))
<script>

  showAlert("{{session('status') != 'success' ? 'Error..!':'Success..!'}}", `{!! session('message') !!}`,"{{session('status')}}")

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
</script>
@endpush
