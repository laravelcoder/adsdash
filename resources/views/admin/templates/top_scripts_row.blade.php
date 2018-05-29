<tr data-index="{{ $index }}">
    <td>{!! Form::text('top_scripts['.$index.'][name]', old('top_scripts['.$index.'][name]', isset($field) ? $field->name: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('top_scripts['.$index.'][script]', old('top_scripts['.$index.'][script]', isset($field) ? $field->script: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>