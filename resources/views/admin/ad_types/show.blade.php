@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.ad-types.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.ad-types.fields.codec')</th>
                            <td field-key='codec'>{{ $ad_type->codec }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ad-types.fields.extention')</th>
                            <td field-key='extention'>{{ $ad_type->extention }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.ad_types.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
