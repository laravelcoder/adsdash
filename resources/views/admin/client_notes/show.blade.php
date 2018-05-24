@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.client-notes.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.client-notes.fields.project')</th>
                            <td field-key='project'>{{ $client_note->project->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-notes.fields.text')</th>
                            <td field-key='text'>{!! $client_note->text !!}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.client_notes.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
