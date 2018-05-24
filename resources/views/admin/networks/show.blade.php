@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.networks.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.networks.fields.network')</th>
                            <td field-key='network'>{{ $network->network }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.networks.fields.network-affiliate')</th>
                            <td field-key='network_affiliate'>{{ $network->network_affiliate }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.networks.fields.provider')</th>
                            <td field-key='provider'>
                                @foreach ($network->provider as $singleProvider)
                                    <span class="label label-info label-many">{{ $singleProvider->provider }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#providers" aria-controls="providers" role="tab" data-toggle="tab">Providers</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="providers">
<table class="table table-bordered table-striped {{ count($providers) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.providers.fields.provider')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($providers) > 0)
            @foreach ($providers as $provider)
                <tr data-entry-id="{{ $provider->id }}">
                    <td field-key='provider'>{{ $provider->provider }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['providers.restore', $provider->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['providers.perma_del', $provider->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('providers.show',[$provider->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('providers.edit',[$provider->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['providers.destroy', $provider->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.networks.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
