<?php $selected_value = (isset($dataTypeContent->{$row->field}) && !is_null(old($row->field, $dataTypeContent->{$row->field}))) ? old($row->field, $dataTypeContent->{$row->field}) : old($row->field); ?>
@if($view == 'browse' || $view == 'read')
    <div>
        {{ $content }}
    </div>
@else

<select class="form-control select2" name="{{ $row->field }}">
    <?php $default = (isset($options->default) && !isset($dataTypeContent->{$row->field})) ? $options->default : 'text'; ?>
    @foreach (config('constants.formFields') as $code => $value)
        <option value="{{ $code }}" @if($default == $code && $selected_value === NULL) selected="selected" @endif @if($selected_value == $code) selected="selected" @endif>
            {{ $code }}
        </option>
    @endforeach
</select>
@endif
