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
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#ad_types" aria-controls="ad_types" role="tab" data-toggle="tab">Ad types</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="ad_types">
<table class="table table-bordered table-striped {{ count($ad_types) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.ad-types.fields.codec')</th>
                        <th>@lang('global.ad-types.fields.extention')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($ad_types) > 0)
            @foreach ($ad_types as $ad_type)
                <tr data-entry-id="{{ $ad_type->id }}">
                    <td field-key='codec'>{{ $ad_type->codec }}</td>
                                <td field-key='extention'>{{ $ad_type->extention }}</td>
                                                                <td>
                                    @can('view')
                                    <a href="{{ route('ad_types.show',[$ad_type->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('ad_types.edit',[$ad_type->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['ad_types.destroy', $ad_type->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.ads.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
