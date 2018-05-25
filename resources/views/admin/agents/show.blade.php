@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.agents.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.agents.fields.company')</th>
                            <td field-key='company'>{{ $agent->company->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agents.fields.first-name')</th>
                            <td field-key='first_name'>{{ $agent->first_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agents.fields.last-name')</th>
                            <td field-key='last_name'>{{ $agent->last_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agents.fields.phone1')</th>
                            <td field-key='phone1'>{{ $agent->phone1 }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agents.fields.phone2')</th>
                            <td field-key='phone2'>{{ $agent->phone2 }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agents.fields.email')</th>
                            <td field-key='email'>{{ $agent->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agents.fields.skype')</th>
                            <td field-key='skype'>{{ $agent->skype }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agents.fields.address')</th>
                            <td field-key='address'>{{ $agent->address }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agents.fields.photo')</th>
                            <td field-key='photo'>@if($agent->photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $agent->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $agent->photo) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agents.fields.about')</th>
                            <td field-key='about'>{!! $agent->about !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agents.fields.created-by')</th>
                            <td field-key='created_by'>{{ $agent->created_by->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.agents.fields.created-by-team')</th>
                            <td field-key='created_by_team'>{{ $agent->created_by_team->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.agents.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
