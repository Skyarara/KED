<li class="nav-item {{ isset($childs) ? 'has-sub' : '' }}">
  <a href="{!! !empty($menu->route_name) ? route($menu->route_name, $menu->parameters): '#' !!}">
      @if (!empty($menu->icon))
        <i class="fa {{ $menu->icon }}"></i>
      @endif
      <span class="menu-title">{{ $menu->title }}</span>
  </a>

  @isset ($childs)
    <ul class="menu-content">
      @foreach ($childs as $child)
        {!! $child !!}
      @endforeach
    </ul>
  @endisset

</li>