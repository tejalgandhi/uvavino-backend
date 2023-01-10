@extends(backpack_view('blank'))

@section('content')
    <div class="jumbotron mb-2 mt-4">
        <h1 class="display-3">{{ __("backpack::base.welcome") }}</h1>
        <p>{{ __("backpack::base.use_sidebar") }}</p>

        @if(admin())
        <hr />
        <div class="box">
            <div class="box-header with-border">
                <a data-toggle="collapse" href="#collapseOne">
                    <div class="btn btn-primary">{{ __("gemadigital::messages.admin_actions") }} <span class="la la-key" aria-hidden="true" style="margin-left: 10px;"></span></div>
                </a>
            </div>
            <div id="collapseOne" class="collapse out">
                <hr />
                <div class="panel-body">
                @include('gemadigital::admin.actions_buttons')
                </div>
            </div>
        </div>
        @endif

        @if(config('gemadigital.build.enabled'))
        <div class="box mt-3">
            @include('gemadigital::admin.build_button')
        </div>
        @endif
    </div>
@endsection
