<tr data-index="{{ $index }}">
    <td>{!! Form::text('clipdbs['.$index.'][clip_label]', old('clipdbs['.$index.'][clip_label]', isset($field) ? $field->clip_label: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('clipdbs['.$index.'][link_to_clip]', old('clipdbs['.$index.'][link_to_clip]', isset($field) ? $field->link_to_clip: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>