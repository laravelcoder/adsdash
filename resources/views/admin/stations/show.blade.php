@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.stations.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.stations.fields.station-label')</th>
                            <td field-key='station_label'>{{ $station->station_label }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.stations.fields.channel-number')</th>
                            <td field-key='channel_number'>{{ $station->channel_number }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#ad_responses" aria-controls="ad_responses" role="tab" data-toggle="tab">Ad Responses</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="ad_responses">
<table class="table table-bordered table-striped {{ count($ad_responses) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.ad-responses.fields.time')</th>
                        <th>@lang('global.ad-responses.fields.impressions')</th>
                        <th>@lang('global.ad-responses.fields.non-impressions')</th>
                        <th>@lang('global.ad-responses.fields.cypi-id')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($ad_responses) > 0)
            @foreach ($ad_responses as $ad_response)
                <tr data-entry-id="{{ $ad_response->id }}">
                    <td field-key='time'>{{ $ad_response->time }}</td>
                                <td field-key='impressions'>{{ $ad_response->impressions }}</td>
                                <td field-key='non_impressions'>{{ $ad_response->non_impressions }}</td>
                                <td field-key='cypi_id'>{{ $ad_response->cypi_id }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['ad_responses.restore', $ad_response->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['ad_responses.perma_del', $ad_response->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('ad_responses.show',[$ad_response->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('ad_responses.edit',[$ad_response->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['ad_responses.destroy', $ad_response->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.stations.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
