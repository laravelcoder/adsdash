@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.client-statuses.title')</h3>
    @can('client_status_create')
    <p>
        <a href="{{ route('admin.client_statuses.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($client_statuses) > 0 ? 'datatable' : '' }} @can('client_status_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('client_status_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.client-statuses.fields.title')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($client_statuses) > 0)
                        @foreach ($client_statuses as $client_status)
                            <tr data-entry-id="{{ $client_status->id }}">
                                @can('client_status_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $client_status->title }}</td>
                                                                <td>
                                    @can('client_status_view')
                                    <a href="{{ route('admin.client_statuses.show',[$client_status->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('client_status_edit')
                                    <a href="{{ route('admin.client_statuses.edit',[$client_status->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('client_status_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.client_statuses.destroy', $client_status->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('client_status_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.client_statuses.mass_destroy') }}';
        @endcan

    </script>
@endsection