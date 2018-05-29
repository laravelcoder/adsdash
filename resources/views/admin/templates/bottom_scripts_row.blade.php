<tr data-index="{{ $index }}">
    <td>{!! Form::text('bottom_scripts['.$index.'][script]', old('bottom_scripts['.$index.'][script]', isset($field) ? $field->script: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('bottom_scripts['.$index.'][name]', old('bottom_scripts['.$index.'][name]', isset($field) ? $field->name: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>