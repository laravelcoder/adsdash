@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.bottom-scripts.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.bottom-scripts.fields.script')</th>
                            <td field-key='script'>{{ $bottom_script->script }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.bottom-scripts.fields.name')</th>
                            <td field-key='name'>{{ $bottom_script->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.bottom-scripts.fields.jquery')</th>
                            <td field-key='jquery'>{{ Form::checkbox("jquery", 1, $bottom_script->jquery == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.bottom-scripts.fields.pages')</th>
                            <td field-key='pages'>
                                @foreach ($bottom_script->pages as $singlePages)
                                    <span class="label label-info label-many">{{ $singlePages->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.bottom_scripts.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
