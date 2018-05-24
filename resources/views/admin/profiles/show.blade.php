@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.profiles.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.profiles.fields.image')</th>
                            <td field-key='image'>@if($profile->image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $profile->image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $profile->image) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.profiles.fields.created-by')</th>
                            <td field-key='created_by'>{{ $profile->created_by->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.profiles.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
