@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.layouts.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.layouts.fields.layout')</th>
                            <td field-key='layout'>{{ $layout->layout }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.layouts.fields.path')</th>
                            <td field-key='path'>{{ $layout->path }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.layouts.fields.address')</th>
                            <td field-key='address'>{{ $layout->address }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.layouts.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
