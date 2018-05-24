@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.assets-categories.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.assets-categories.fields.title')</th>
                            <td field-key='title'>{{ $assets_category->title }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#assets" aria-controls="assets" role="tab" data-toggle="tab">Assets</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="assets">
<table class="table table-bordered table-striped {{ count($assets) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.assets.fields.category')</th>
                        <th>@lang('global.assets.fields.serial-number')</th>
                        <th>@lang('global.assets.fields.title')</th>
                        <th>@lang('global.assets.fields.photo1')</th>
                        <th>@lang('global.assets.fields.photo2')</th>
                        <th>@lang('global.assets.fields.photo3')</th>
                        <th>@lang('global.assets.fields.status')</th>
                        <th>@lang('global.assets.fields.location')</th>
                        <th>@lang('global.assets.fields.assigned-user')</th>
                        <th>@lang('global.assets.fields.notes')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($assets) > 0)
            @foreach ($assets as $asset)
                <tr data-entry-id="{{ $asset->id }}">
                    <td field-key='category'>{{ $asset->category->title or '' }}</td>
                                <td field-key='serial_number'>{{ $asset->serial_number }}</td>
                                <td field-key='title'>{{ $asset->title }}</td>
                                <td field-key='photo1'>@if($asset->photo1)<a href="{{ asset(env('UPLOAD_PATH').'/' . $asset->photo1) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $asset->photo1) }}"/></a>@endif</td>
                                <td field-key='photo2'>@if($asset->photo2)<a href="{{ asset(env('UPLOAD_PATH').'/' . $asset->photo2) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $asset->photo2) }}"/></a>@endif</td>
                                <td field-key='photo3'>@if($asset->photo3)<a href="{{ asset(env('UPLOAD_PATH').'/' . $asset->photo3) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $asset->photo3) }}"/></a>@endif</td>
                                <td field-key='status'>{{ $asset->status->title or '' }}</td>
                                <td field-key='location'>{{ $asset->location->title or '' }}</td>
                                <td field-key='assigned_user'>{{ $asset->assigned_user->name or '' }}</td>
                                <td field-key='notes'>{!! $asset->notes !!}</td>
                                                                <td>
                                    @can('view')
                                    <a href="{{ route('assets.show',[$asset->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('assets.edit',[$asset->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['assets.destroy', $asset->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="15">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.assets_categories.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
