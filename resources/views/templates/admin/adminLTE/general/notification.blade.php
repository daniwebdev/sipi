@extends('Admin::adminLTE.layout')

@push('title')
    Notifications
@endpush

@section('content')
    <section class="pb-5" id="notification-area">
        

    </section>
    <button class="btn btn-secondary btn-block">More.. </button>
    <template>
        <div class="card" style="display:none">
            <div class="card-header ">
                <h4 class="card-title">{title}</h4>
                <div class="card-tools">
                    <span class="text-gray">{date}</span>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">{content}</p>
                <div class="mt-2 btn-group">
                    <button class="btn btn-primary">Accept</button>
                    <button class="btn btn-danger">Reject</button>
                </div>
            </div>
        </div>
    </template>
@endsection


@push('scripts')
    <script>
        let url = '{{route("notification")}}';
        let html = $('template').html();
        let del  = 500;
        axios.post(url).then(res => {
            let data = res.data;
            data.notifications.forEach(N => {
                let template = html.replace(/{title}/g, N.data.title);
                    template = template.replace(/{content}/g, N.data.message);
                $(template).appendTo('#notification-area').fadeIn(del);
            del += 500;
            });
        });
    </script>
@endpush
