@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.client-documents.title')</h3>
    @can('client_document_create')
    <p>
        <a href="{{ route('admin.client_documents.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($client_documents) > 0 ? 'datatable' : '' }} @can('client_document_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('client_document_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.client-documents.fields.project')</th>
                        <th>@lang('global.client-documents.fields.title')</th>
                        <th>@lang('global.client-documents.fields.description')</th>
                        <th>@lang('global.client-documents.fields.file')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($client_documents) > 0)
                        @foreach ($client_documents as $client_document)
                            <tr data-entry-id="{{ $client_document->id }}">
                                @can('client_document_delete')
                                    <td></td>
                                @endcan

                                <td field-key='project'>{{ $client_document->project->title or '' }}</td>
                                <td field-key='title'>{{ $client_document->title }}</td>
                                <td field-key='description'>{!! $client_document->description !!}</td>
                                <td field-key='file'>@if($client_document->file)<a href="{{ asset(env('UPLOAD_PATH').'/' . $client_document->file) }}" target="_blank">Download file</a>@endif</td>
                                                                <td>
                                    @can('client_document_view')
                                    <a href="{{ route('admin.client_documents.show',[$client_document->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('client_document_edit')
                                    <a href="{{ route('admin.client_documents.edit',[$client_document->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('client_document_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.client_documents.destroy', $client_document->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('client_document_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.client_documents.mass_destroy') }}';
        @endcan

    </script>
@endsection