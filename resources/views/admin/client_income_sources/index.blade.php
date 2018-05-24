@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.client-income-sources.title')</h3>
    @can('client_income_source_create')
    <p>
        <a href="{{ route('admin.client_income_sources.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($client_income_sources) > 0 ? 'datatable' : '' }} @can('client_income_source_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('client_income_source_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.client-income-sources.fields.title')</th>
                        <th>@lang('global.client-income-sources.fields.fee-percent')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($client_income_sources) > 0)
                        @foreach ($client_income_sources as $client_income_source)
                            <tr data-entry-id="{{ $client_income_source->id }}">
                                @can('client_income_source_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $client_income_source->title }}</td>
                                <td field-key='fee_percent'>{{ $client_income_source->fee_percent }}</td>
                                                                <td>
                                    @can('client_income_source_view')
                                    <a href="{{ route('admin.client_income_sources.show',[$client_income_source->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('client_income_source_edit')
                                    <a href="{{ route('admin.client_income_sources.edit',[$client_income_source->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('client_income_source_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.client_income_sources.destroy', $client_income_source->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('client_income_source_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.client_income_sources.mass_destroy') }}';
        @endcan

    </script>
@endsection