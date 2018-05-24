<?php

namespace App\Http\Controllers\Admin;

use App\ClientTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientTransactionsRequest;
use App\Http\Requests\Admin\UpdateClientTransactionsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClientTransactionsController extends Controller
{
    /**
     * Display a listing of ClientTransaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('client_transaction_access')) {
            return abort(401);
        }


                $client_transactions = ClientTransaction::all();

        return view('admin.client_transactions.index', compact('client_transactions'));
    }

    /**
     * Show the form for creating new ClientTransaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('client_transaction_create')) {
            return abort(401);
        }
        
        $projects = \App\ClientProject::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $transaction_types = \App\ClientTransactionType::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $income_sources = \App\ClientIncomeSource::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $currencies = \App\ClientCurrency::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.client_transactions.create', compact('projects', 'transaction_types', 'income_sources', 'currencies'));
    }

    /**
     * Store a newly created ClientTransaction in storage.
     *
     * @param  \App\Http\Requests\StoreClientTransactionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientTransactionsRequest $request)
    {
        if (! Gate::allows('client_transaction_create')) {
            return abort(401);
        }
        $client_transaction = ClientTransaction::create($request->all());



        return redirect()->route('admin.client_transactions.index');
    }


    /**
     * Show the form for editing ClientTransaction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('client_transaction_edit')) {
            return abort(401);
        }
        
        $projects = \App\ClientProject::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $transaction_types = \App\ClientTransactionType::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $income_sources = \App\ClientIncomeSource::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $currencies = \App\ClientCurrency::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        $client_transaction = ClientTransaction::findOrFail($id);

        return view('admin.client_transactions.edit', compact('client_transaction', 'projects', 'transaction_types', 'income_sources', 'currencies'));
    }

    /**
     * Update ClientTransaction in storage.
     *
     * @param  \App\Http\Requests\UpdateClientTransactionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientTransactionsRequest $request, $id)
    {
        if (! Gate::allows('client_transaction_edit')) {
            return abort(401);
        }
        $client_transaction = ClientTransaction::findOrFail($id);
        $client_transaction->update($request->all());



        return redirect()->route('admin.client_transactions.index');
    }


    /**
     * Display ClientTransaction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('client_transaction_view')) {
            return abort(401);
        }
        $client_transaction = ClientTransaction::findOrFail($id);

        return view('admin.client_transactions.show', compact('client_transaction'));
    }


    /**
     * Remove ClientTransaction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('client_transaction_delete')) {
            return abort(401);
        }
        $client_transaction = ClientTransaction::findOrFail($id);
        $client_transaction->delete();

        return redirect()->route('admin.client_transactions.index');
    }

    /**
     * Delete all selected ClientTransaction at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('client_transaction_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ClientTransaction::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
