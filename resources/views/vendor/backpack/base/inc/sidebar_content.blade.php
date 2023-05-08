<li class="nav-item mobile">
    <a class="nav-link" href="/">
        <i class="la la-arrow-right nav-icon"></i>
        <span>{{ __('Home') }}</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('dashboard') }}">
        <i class="la la-dashboard nav-icon"></i>
        <span>{{ trans('backpack::base.dashboard') }}</span>
    </a>
</li>

{{-- App Content --}}
<li class="nav-item header">{{ __("Content") }}</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon la la-newspaper-o"></i>
        <span>{{ ucfirst(__("articles")) }}</span>
    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('article') }}">
                <i class="nav-icon la la-newspaper-o"></i>
                <span>{{ ucfirst(__("articles")) }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('category') }}">
                <i class="nav-icon la la-list"></i>
                <span>{{ ucfirst(__("categories")) }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('tag') }}">
                <i class="nav-icon la la-tag"></i>
                <span>{{ ucfirst(__("tags")) }}</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('custom') }}">
        <i class="nav-icon la la-question"></i> Livewire
    </a>
</li>

{{-- Custom crud --}}
@include('vendor.backpack.base.inc.sidebar_content_crud')

{{-- Admin --}}
@include('gemadigital::vendor.backpack.base.inc.sidebar_content_admin')



