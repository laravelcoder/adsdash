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
                            <th>@lang('global.clipdb.fields.link-to-clip')</th>
                            <td field-key='link_to_clip'>{{ $clipdb->link_to_clip }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.clipdb.fields.video-upload')</th>
                            <td field-key='video_upload'>@if($clipdb->video_upload)<a href="{{ asset(env('UPLOAD_PATH').'/' . $clipdb->video_upload) }}" target="_blank">Download file</a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.clipdb.fields.image-upload')</th>
                            <td field-key='image_upload'>@if($clipdb->image_upload)<a href="{{ asset(env('UPLOAD_PATH').'/' . $clipdb->image_upload) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $clipdb->image_upload) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.clipdb.fields.created-by')</th>
                            <td field-key='created_by'>{{ $clipdb->created_by->name or '' }}</td>
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
