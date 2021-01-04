<?php $selected_value = (isset($dataTypeContent->{$row->field}) && !is_null(old($row->field, $dataTypeContent->{$row->field}))) ? old($row->field, $dataTypeContent->{$row->field}) : old($row->field); ?>
@if($view == 'browse' || $view == 'read')
    <div>
        {{ $content }}
    </div>
@else

<select class="form-control select2" name="{{ $row->field }}">
    <?php $default = (isset($options->default) && !isset($dataTypeContent->{$row->field})) ? $options->default : 'text'; ?>
    @foreach (Voyager::formFields() as $formField)
        <option value="{{ $formField->getCodename() }}" @if($default == $formField->getCodename() && $selected_value === NULL) selected="selected" @endif @if($selected_value == $formField->getCodename()) selected="selected" @endif>
            {{ $formField->getName() }}
        </option>
    @endforeach
</select>
@endif
