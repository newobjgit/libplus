	@if (count($menu->children) > 0)
	<li class="list-group-item">{{ $menu->title }}</li>
	    <ul>
	    @foreach($menu->children as $menu)
	        @include('menu.partials.menu', $menu)
	    @endforeach
	    </ul>
	@else
	<li class="list-group-item list-group-item-action"><a href={{route('path', $menu->url)}}>{{ $menu->title }}</a></li>  
	@endif