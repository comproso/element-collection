<div @if(isset($cssid)) {{ $cssid }} @endif class="text content element @if(isset($cssclass)) {{ $cssclass }} @endif">
	{!! trans($content) !!}
</div>