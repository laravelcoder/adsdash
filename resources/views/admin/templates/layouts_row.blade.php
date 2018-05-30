<tr data-index="{{ $index }}">
    <td>{!! Form::text('layouts['.$index.'][layout]', old('layouts['.$index.'][layout]', isset($field) ? $field->layout: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('layouts['.$index.'][path]', old('layouts['.$index.'][path]', isset($field) ? $field->path: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('layouts['.$index.'][address]', old('layouts['.$index.'][address]', isset($field) ? $field->address: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>