@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.client-currencies.title')</h3>
    @can('client_currency_create')
    <p>
        <a href="{{ route('admin.client_currencies.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($client_currencies) > 0 ? 'datatable' : '' }} @can('client_currency_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('client_currency_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.client-currencies.fields.title')</th>
                        <th>@lang('global.client-currencies.fields.code')</th>
                        <th>@lang('global.client-currencies.fields.main-currency')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($client_currencies) > 0)
                        @foreach ($client_currencies as $client_currency)
                            <tr data-entry-id="{{ $client_currency->id }}">
                                @can('client_currency_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $client_currency->title }}</td>
                                <td field-key='code'>{{ $client_currency->code }}</td>
                                <td field-key='main_currency'>{{ Form::checkbox("main_currency", 1, $client_currency->main_currency == 1 ? true : false, ["disabled"]) }}</td>
                                                                <td>
                                    @can('client_currency_view')
                                    <a href="{{ route('admin.client_currencies.show',[$client_currency->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('client_currency_edit')
                                    <a href="{{ route('admin.client_currencies.edit',[$client_currency->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('client_currency_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.client_currencies.destroy', $client_currency->id])) !!}
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
@stop

@section('javascript') 
    <script>
        @can('client_currency_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.client_currencies.mass_destroy') }}';
        @endcan

    </script>
@endsection