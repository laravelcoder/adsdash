<tr data-index="{{ $index }}">
    <td>{!! Form::text('providers['.$index.'][provider]', old('providers['.$index.'][provider]', isset($field) ? $field->provider: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>