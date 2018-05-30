<tr data-index="{{ $index }}">
    <td>{!! Form::text('scripts['.$index.'][name]', old('scripts['.$index.'][name]', isset($field) ? $field->name: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('scripts['.$index.'][script]', old('scripts['.$index.'][script]', isset($field) ? $field->script: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>