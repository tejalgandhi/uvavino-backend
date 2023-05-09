<li class="nav-item header">{{ __("Crud") }}</li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('basket') }}"><i class="nav-icon la la-th-list"></i> Baskets</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('product') }}"><i class="nav-icon la la-th-list"></i> {{ ucfirst(__("products")) }}</a></li>

<li class="nav-item nav-dropdown">
  <a class="nav-link nav-dropdown-toggle" href="#">
    <i class="nav-icon la la-newspaper-o"></i>
    <span>{{ ucfirst(__("Trade Seller")) }}</span>
  </a>
  <ul class="nav-dropdown-items">
    <li class="nav-item">
      <a class="nav-link" href="{{ backpack_url('wine-tags') }}">
        <i class="nav-icon la la-circle-o"></i>
        <span>{{ ucfirst(__("Wine Tags")) }}</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ backpack_url('wine-variety') }}">
        <i class="nav-icon la la-circle-o"></i>
        <span>{{ ucfirst(__("Wine Variety")) }}</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ backpack_url('drink-type') }}">
        <i class="nav-icon la la-circle-o"></i>
        <span>{{ ucfirst(__("Drink Types")) }}</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ backpack_url('region') }}">
        <i class="nav-icon la la-circle-o"></i>
        <span>{{ ucfirst(__("region")) }}</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ backpack_url('brands') }}">
        <i class="nav-icon la la-circle-o"></i>
        <span>{{ ucfirst(__("brands")) }}</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ backpack_url('producers') }}">
        <i class="nav-icon la la-circle-o"></i>
        <span>{{ ucfirst(__("producers")) }}</span>
      </a>
    </li>

  </ul>
</li>


<li class="nav-item">
  <a class="nav-link" href="{{ backpack_url('countries') }}">
    <i class="la la-globe nav-icon"></i>
    <span>{{ ucfirst(__("Country")) }}</span>
  </a>
</li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('auction-package') }}"><i class="nav-icon la la-th-list"></i> Auction packages</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('auction') }}"><i class="nav-icon la la-th-list"></i> Auctions</a></li>

