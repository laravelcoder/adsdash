@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.ad-responses.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.ad-responses.fields.station')</th>
                            <td field-key='station'>{{ $ad_response->station->station_label or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.stations.fields.channel-number')</th>
                            <td field-key='channel_number'>{{ isset($ad_response->station) ? $ad_response->station->channel_number : '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ad-responses.fields.time')</th>
                            <td field-key='time'>{{ $ad_response->time }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ad-responses.fields.impressions')</th>
                            <td field-key='impressions'>{{ $ad_response->impressions }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ad-responses.fields.non-impressions')</th>
                            <td field-key='non_impressions'>{{ $ad_response->non_impressions }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ad-responses.fields.cypi-id')</th>
                            <td field-key='cypi_id'>{{ $ad_response->cypi_id }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.ad_responses.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
