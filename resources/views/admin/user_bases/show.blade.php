@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.user-base.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.user-base.fields.name')</th>
                            <td field-key='name'>{{ $user_base->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.user-base.fields.value')</th>
                            <td field-key='value'>{{ $user_base->value }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.user-base.fields.created-by')</th>
                            <td field-key='created_by'>{{ $user_base->created_by->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.user-base.fields.created-by-team')</th>
                            <td field-key='created_by_team'>{{ $user_base->created_by_team->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.user_bases.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
