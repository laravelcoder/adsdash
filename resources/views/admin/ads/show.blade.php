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
                            <th>@lang('global.ads.fields.link')</th>
                            <td field-key='link'>{{ $ad->link }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ads.fields.ad-label')</th>
                            <td field-key='ad_label'>{{ $ad->ad_label }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ads.fields.ad-type')</th>
                            <td field-key='ad_type'>{{ $ad->ad_type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ads.fields.created-by')</th>
                            <td field-key='created_by'>{{ $ad->created_by->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.ads.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
