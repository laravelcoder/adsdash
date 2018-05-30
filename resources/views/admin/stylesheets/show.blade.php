@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.stylesheet.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.stylesheet.fields.order')</th>
                            <td field-key='order'>{{ $stylesheet->order }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.stylesheet.fields.link')</th>
                            <td field-key='link'>{{ $stylesheet->link }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.stylesheet.fields.pages')</th>
                            <td field-key='pages'>
                                @foreach ($stylesheet->pages as $singlePages)
                                    <span class="label label-info label-many">{{ $singlePages->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.stylesheets.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
