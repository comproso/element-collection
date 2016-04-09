<div<?php if(isset($cssid)): ?> id="{{ $cssid }}"<?php endif; ?> class="{{ $type }} content element<?php if(isset($cssclass)): ?> {{ $cssclass }}<?php endif; ?>">
	<?php if(isset($label)): ?><label>{!! trans($label) !!}</label><?php endif; ?>
	<?php foreach($options as $lbl => $val): ?>
		<?php if(!is_int($lbl)): ?> <label for="{{ $name }}">{!! trans($lbl) !!}</label><?php endif; ?>
		<input name="{{ $name }}" type="{{ $type }}"<?php if($type != 'checkbox'): ?> value="{{ $val }}"<?php endif; if($val == $value): ?> checked="checked"<?php endif; ?>>
	<?php endforeach; ?>
</div>