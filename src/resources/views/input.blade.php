<div @if(isset($cssid)) {{ $cssid }} @endif class="input content element @if(isset($cssclass)) {{ $cssclass }} @endif">
	@if(isset($label))<label for={{ $name }}>{!! trans($label) !!}</label>@endif
	<input name="{{ $name }}" type="{{ $type }}"<?php if(isset($html_attributes)): foreach($html_attributes as $attr => $val): if($attr != 'value'): ?> {{ $attr }}='{{ $val }}'<?php endif; endforeach; endif; if((isset($cache)) OR (isset($html_attributes->value))): ?> value='<?php if(isset($cache)): ?>{{ trans($cache) }}<?php else: ?>{{ trans($html_attributes->value) }}<?php endif; ?>'<?php endif; ?>>
</div>