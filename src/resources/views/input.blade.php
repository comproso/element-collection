<div @if(isset($cssid)) {{ $cssid }} @endif class="input content element @if(isset($cssclass)) {{ $cssclass }} @endif">
	@if(isset($label))<label for="{{ $name }}" class="ui label">{!! trans($label) !!}</label>@endif
	<input name="{{ $name }}" type="{{ $type }}"<?php if(isset($html_attributes)): foreach($html_attributes as $attr => $val): if($attr != 'value'): ?> {{ $attr }}='{{ $val }}'<?php endif; endforeach; endif; ?> value='<?php if(isset($cache)): ?>{{ trans($cache) }}<?php elseif(isset($html_attributes->value)): ?>{{ trans($html_attributes->value) }}<?php endif; ?>'>
</div>