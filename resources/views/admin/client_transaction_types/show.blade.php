@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.client-transaction-types.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.client-transaction-types.fields.title')</th>
                            <td field-key='title'>{{ $client_transaction_type->title }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#client_transactions" aria-controls="client_transactions" role="tab" data-toggle="tab">Transactions</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="client_transactions">
<table class="table table-bordered table-striped {{ count($client_transactions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
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
                    <td field-key='project'>{{ $client_transaction->project->title or '' }}</td>
                                <td field-key='transaction_type'>{{ $client_transaction->transaction_type->title or '' }}</td>
                                <td field-key='income_source'>{{ $client_transaction->income_source->title or '' }}</td>
                                <td field-key='title'>{{ $client_transaction->title }}</td>
                                <td field-key='description'>{!! $client_transaction->description !!}</td>
                                <td field-key='amount'>{{ $client_transaction->amount }}</td>
                                <td field-key='currency'>{{ $client_transaction->currency->title or '' }}</td>
                                <td field-key='transaction_date'>{{ $client_transaction->transaction_date }}</td>
                                                                <td>
                                    @can('view')
                                    <a href="{{ route('client_transactions.show',[$client_transaction->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('client_transactions.edit',[$client_transaction->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['client_transactions.destroy', $client_transaction->id])) !!}
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

            <p>&nbsp;</p>

            <a href="{{ route('admin.client_transaction_types.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
