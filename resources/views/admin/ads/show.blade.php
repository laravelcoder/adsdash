@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.ads.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.ads.fields.ad-label')</th>
                            <td field-key='ad_label'>{{ $ad->ad_label }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ads.fields.ad-type')</th>
                            <td field-key='ad_type'>{{ $ad->ad_type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ads.fields.ad-description')</th>
                            <td field-key='ad_description'>{!! $ad->ad_description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ads.fields.total-impressions')</th>
                            <td field-key='total_impressions'>{{ $ad->total_impressions }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ads.fields.total-networks')</th>
                            <td field-key='total_networks'>{{ $ad->total_networks }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ads.fields.total-channels')</th>
                            <td field-key='total_channels'>{{ $ad->total_channels }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#clipdb" aria-controls="clipdb" role="tab" data-toggle="tab">ClipDB</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="clipdb">
<table class="table table-bordered table-striped {{ count($clipdbs) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.clipdb.fields.clip-label')</th>
                        <th>@lang('global.clipdb.fields.link-to-clip')</th>
                        <th>@lang('global.clipdb.fields.video-upload')</th>
                        <th>@lang('global.clipdb.fields.image-upload')</th>
                        <th>@lang('global.clipdb.fields.created-by-team')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($clipdbs) > 0)
            @foreach ($clipdbs as $clipdb)
                <tr data-entry-id="{{ $clipdb->id }}">
                    <td field-key='clip_label'>{{ $clipdb->clip_label }}</td>
                                <td field-key='link_to_clip'>{{ $clipdb->link_to_clip }}</td>
                                <td field-key='video_upload'>@if($clipdb->video_upload)<a href="{{ asset(env('UPLOAD_PATH').'/' . $clipdb->video_upload) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='image_upload'>@if($clipdb->image_upload)<a href="{{ asset(env('UPLOAD_PATH').'/' . $clipdb->image_upload) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $clipdb->image_upload) }}"/></a>@endif</td>
                                <td field-key='created_by_team'>{{ $clipdb->created_by_team->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['clipdbs.restore', $clipdb->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['clipdbs.perma_del', $clipdb->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('clipdbs.show',[$clipdb->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('clipdbs.edit',[$clipdb->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['clipdbs.destroy', $clipdb->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.ads.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
