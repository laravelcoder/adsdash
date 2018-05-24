<tr data-index="{{ $index }}">
    <td>{!! Form::text('ad_types['.$index.'][codec]', old('ad_types['.$index.'][codec]', isset($field) ? $field->codec: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('ad_types['.$index.'][extention]', old('ad_types['.$index.'][extention]', isset($field) ? $field->extention: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>