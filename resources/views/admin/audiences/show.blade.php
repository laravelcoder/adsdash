@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.audiences.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.audiences.fields.name')</th>
                            <td field-key='name'>{{ $audience->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.audiences.fields.value')</th>
                            <td field-key='value'>{{ $audience->value }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.audiences.fields.companies')</th>
                            <td field-key='companies'>
                                @foreach ($audience->companies as $singleCompanies)
                                    <span class="label label-info label-many">{{ $singleCompanies->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#demographics" aria-controls="demographics" role="tab" data-toggle="tab">Demographics</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="demographics">
<table class="table table-bordered table-striped {{ count($demographics) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.demographics.fields.demographic')</th>
                        <th>@lang('global.demographics.fields.value')</th>
                        <th>@lang('global.demographics.fields.audience')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($demographics) > 0)
            @foreach ($demographics as $demographic)
                <tr data-entry-id="{{ $demographic->id }}">
                    <td field-key='demographic'>{{ $demographic->demographic }}</td>
                                <td field-key='value'>{{ $demographic->value }}</td>
                                <td field-key='audience'>{{ $demographic->audience->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['demographics.restore', $demographic->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['demographics.perma_del', $demographic->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('demographics.show',[$demographic->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('demographics.edit',[$demographic->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['demographics.destroy', $demographic->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
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

            <a href="{{ route('admin.audiences.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
