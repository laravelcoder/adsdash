@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.top-scripts.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.top-scripts.fields.name')</th>
                            <td field-key='name'>{{ $top_script->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.top-scripts.fields.script')</th>
                            <td field-key='script'>{{ $top_script->script }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.top-scripts.fields.jquery')</th>
                            <td field-key='jquery'>{{ Form::checkbox("jquery", 1, $top_script->jquery == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.top_scripts.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
