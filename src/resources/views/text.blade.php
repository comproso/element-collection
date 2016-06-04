<div @if(isset($cssid)) id="{{ $cssid }}" @endif class="text content element @if(isset($cssclass)) {{ $cssclass }} @endif "<?php if(isset($html_attributes)): foreach($html_attributes as $attr => $val): ?> {{ $attr }}='{{ $val }}'<?php endforeach; endif; ?>>
	{!! trans($content) !!}
</div>