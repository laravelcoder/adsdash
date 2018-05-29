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
                            <th>@lang('global.clipdb.fields.created-by')</th>
                            <td field-key='created_by'>{{ $clipdb->created_by->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.clipdb.fields.created-by-team')</th>
                            <td field-key='created_by_team'>{{ $clipdb->created_by_team->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#ads" aria-controls="ads" role="tab" data-toggle="tab">Ads</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="ads">
<table class="table table-bordered table-striped {{ count($ads) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.ads.fields.ad-label')</th>
                        <th>@lang('global.ads.fields.total-impressions')</th>
                        <th>@lang('global.ads.fields.total-networks')</th>
                        <th>@lang('global.ads.fields.total-channels')</th>
                        <th>@lang('global.ads.fields.video-clip')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($ads) > 0)
            @foreach ($ads as $ad)
                <tr data-entry-id="{{ $ad->id }}">
                    <td field-key='ad_label'>{{ $ad->ad_label }}</td>
                                <td field-key='total_impressions'>{{ $ad->total_impressions }}</td>
                                <td field-key='total_networks'>{{ $ad->total_networks }}</td>
                                <td field-key='total_channels'>{{ $ad->total_channels }}</td>
                                <td field-key='video_clip'>@if($ad->video_clip)<a href="{{ asset(env('UPLOAD_PATH').'/' . $ad->video_clip) }}" target="_blank">Download file</a>@endif</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['ads.restore', $ad->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['ads.perma_del', $ad->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('ads.show',[$ad->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('ads.edit',[$ad->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['ads.destroy', $ad->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="14">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.clipdbs.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
