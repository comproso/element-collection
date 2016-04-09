<div @if(isset($cssid)) {{ $cssid }} @endif class="input content element @if(isset($cssclass)) {{ $cssclass }} @endif">
	@if(isset($label))<label for={{ $name }}>{!! trans($label) !!}</label>@endif
	<input name="{{ $name }}" type="{{ $type }}"<?php if(isset($params)): foreach($params as $param => $val): if((!isset($cache)) OR ($param != 'value')): ?> {{ $param }}='{{ $val }}'<?php endif; endforeach; endif; if(isset($cache)): ?> value='{{ $cache }}'<?php endif; ?>>
</div>