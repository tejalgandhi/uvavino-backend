<header class="{{ config('backpack.base.header_class') }}">
  {{-- Logo --}}
  <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="{{ url('') }}">
    {{-- NEW LAYOUT --}}
    <span class="logo-lg">
      <img src="/img/logo/logo-text.png" />
    </span>
    {{-- END NEW LAYOUT --}}
  </a>
  <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
    <span class="navbar-toggler-icon"></span>
  </button>

  @include(backpack_view('inc.menu'))
</header>
