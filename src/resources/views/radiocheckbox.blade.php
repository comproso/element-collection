<div @if(isset($cssid)) {{ $cssid }} @endif class="{{ $type }} content element @if(isset($cssclass)) {{ $cssclass }} @endif">
	@if(isset($label))<label>{!! trans($label) !!}</label>@endif
	@foreach($options as $lbl => $val)
		@if(!is_int($lbl)) <label for="{{ $name }}">{!! trans($lbl) !!}</label>@endif
		<input name="{{ $name }}" type="{{ $type }}" value="{{ $val }}"@if($val == $value) checked="checked" @endif>
	@endforeach
</div>