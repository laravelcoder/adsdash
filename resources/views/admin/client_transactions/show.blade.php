@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.client-transactions.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.client-transactions.fields.project')</th>
                            <td field-key='project'>{{ $client_transaction->project->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-transactions.fields.transaction-type')</th>
                            <td field-key='transaction_type'>{{ $client_transaction->transaction_type->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-transactions.fields.income-source')</th>
                            <td field-key='income_source'>{{ $client_transaction->income_source->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-transactions.fields.title')</th>
                            <td field-key='title'>{{ $client_transaction->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-transactions.fields.description')</th>
                            <td field-key='description'>{!! $client_transaction->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-transactions.fields.amount')</th>
                            <td field-key='amount'>{{ $client_transaction->amount }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-transactions.fields.currency')</th>
                            <td field-key='currency'>{{ $client_transaction->currency->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-transactions.fields.transaction-date')</th>
                            <td field-key='transaction_date'>{{ $client_transaction->transaction_date }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.client_transactions.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
