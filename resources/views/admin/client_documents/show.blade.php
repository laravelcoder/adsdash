@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.client-documents.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.client-documents.fields.project')</th>
                            <td field-key='project'>{{ $client_document->project->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-documents.fields.title')</th>
                            <td field-key='title'>{{ $client_document->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-documents.fields.description')</th>
                            <td field-key='description'>{!! $client_document->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-documents.fields.file')</th>
                            <td field-key='file'>@if($client_document->file)<a href="{{ asset(env('UPLOAD_PATH').'/' . $client_document->file) }}" target="_blank">Download file</a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.client_documents.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
