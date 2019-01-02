	@if (count($menu->children) > 0)
	<li class="">{{ $menu->title }}</li>
	    <ul class="sub-menu">
	    @foreach($menu->children as $menu)
	        @include('menu.partials.menu', $menu)
	    @endforeach
	    </ul>
	@else
	<li class=""><a href={{route('filter', $menu->id)}}>{{ $menu->title }}</a></li>
	@endif