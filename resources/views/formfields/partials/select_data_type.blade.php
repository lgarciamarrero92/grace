<?php $selected_value = (isset($dataTypeContent->{$row->field}) && !is_null(old($row->field, $dataTypeContent->{$row->field}))) ? old($row->field, $dataTypeContent->{$row->field}) : old($row->field); ?>
@if($view == 'browse' || $view == 'read')
    <div>
        {{ $content }}
    </div>
@else

<select class="form-control select2" name="{{ $row->field }}">
    <?php $default = (isset($options->default) && !isset($dataTypeContent->{$row->field})) ? $options->default : 'text'; ?>
    @foreach (App\Models\Entry::formFields() as $formField)
        <option value="{{ $formField->code }}" @if($default == $formField->code && $selected_value === NULL) selected="selected" @endif @if($selected_value == $formField->code) selected="selected" @endif>
            {{ $formField->code }}
        </option>
    @endforeach
</select>
@endif
