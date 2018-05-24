@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.client-transactions.title')</h3>
    @can('client_transaction_create')
    <p>
        <a href="{{ route('admin.client_transactions.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($client_transactions) > 0 ? 'datatable' : '' }} @can('client_transaction_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('client_transaction_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.client-transactions.fields.project')</th>
                        <th>@lang('global.client-transactions.fields.transaction-type')</th>
                        <th>@lang('global.client-transactions.fields.income-source')</th>
                        <th>@lang('global.client-transactions.fields.title')</th>
                        <th>@lang('global.client-transactions.fields.description')</th>
                        <th>@lang('global.client-transactions.fields.amount')</th>
                        <th>@lang('global.client-transactions.fields.currency')</th>
                        <th>@lang('global.client-transactions.fields.transaction-date')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($client_transactions) > 0)
                        @foreach ($client_transactions as $client_transaction)
                            <tr data-entry-id="{{ $client_transaction->id }}">
                                @can('client_transaction_delete')
                                    <td></td>
                                @endcan

                                <td field-key='project'>{{ $client_transaction->project->title or '' }}</td>
                                <td field-key='transaction_type'>{{ $client_transaction->transaction_type->title or '' }}</td>
                                <td field-key='income_source'>{{ $client_transaction->income_source->title or '' }}</td>
                                <td field-key='title'>{{ $client_transaction->title }}</td>
                                <td field-key='description'>{!! $client_transaction->description !!}</td>
                                <td field-key='amount'>{{ $client_transaction->amount }}</td>
                                <td field-key='currency'>{{ $client_transaction->currency->title or '' }}</td>
                                <td field-key='transaction_date'>{{ $client_transaction->transaction_date }}</td>
                                                                <td>
                                    @can('client_transaction_view')
                                    <a href="{{ route('admin.client_transactions.show',[$client_transaction->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('client_transaction_edit')
                                    <a href="{{ route('admin.client_transactions.edit',[$client_transaction->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('client_transaction_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.client_transactions.destroy', $client_transaction->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="13">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('client_transaction_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.client_transactions.mass_destroy') }}';
        @endcan

    </script>
@endsection