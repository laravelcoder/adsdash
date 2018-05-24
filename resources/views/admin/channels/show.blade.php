@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.channels.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.channels.fields.channel')</th>
                            <td field-key='channel'>{{ $channel->channel }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.channels.fields.channel-name')</th>
                            <td field-key='channel_name'>{{ $channel->channel_name }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.channels.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
