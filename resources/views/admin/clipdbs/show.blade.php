@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.clipdb.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.clipdb.fields.clip-label')</th>
                            <td field-key='clip_label'>{{ $clipdb->clip_label }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.clipdb.fields.created-by-team')</th>
                            <td field-key='created_by_team'>{{ $clipdb->created_by_team->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.clipdbs.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
