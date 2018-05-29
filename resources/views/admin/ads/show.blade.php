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
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.ads.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
