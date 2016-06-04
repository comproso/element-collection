<div @if(isset($cssid)) {{ $cssid }} @endif class="input content element @if(isset($cssclass)) {{ $cssclass }} @endif">
	@if(isset($label))<label for={{ $name }}>{!! trans($label) !!}</label>@endif
	<input name="{{ $name }}" type="{{ $type }}"<?php if(isset($html_attributes)): foreach($html_attributes as $attr => $val): if((!isset($cache)) OR ($attr != 'value')): ?> {{ $attr }}='{{ $val }}'<?php endif; endforeach; endif; if(isset($cache)): ?> value='{{ $cache }}'<?php endif; ?>>
</div>