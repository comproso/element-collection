<div @if(isset($cssid)) {{ $cssid }} @endif class="input content element @if(isset($cssclass)) {{ $cssclass }} @endif">
	@if(isset($label))<label for={{ $name }}>{!! trans($label) !!}</label>@endif
	<input name="{{ $name }}" type="{{ $type }}"@foreach($params as $param => $val) @if((is_null($cache)) OR ($param != 'value')){{ $param }}='{{ $val }}'@endif @endforeach @if(!is_null($cache)) value='{{ $cache }}'@endif>
</div>