<?php

namespace App\Http\Controllers\Admin;

use App\ClientCurrency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientCurrenciesRequest;
use App\Http\Requests\Admin\UpdateClientCurrenciesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClientCurrenciesController extends Controller
{
    /**
     * Display a listing of ClientCurrency.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('client_currency_access')) {
            return abort(401);
        }


                $client_currencies = ClientCurrency::all();

        return view('admin.client_currencies.index', compact('client_currencies'));
    }

    /**
     * Show the form for creating new ClientCurrency.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('client_currency_create')) {
            return abort(401);
        }
        return view('admin.client_currencies.create');
    }

    /**
     * Store a newly created ClientCurrency in storage.
     *
     * @param  \App\Http\Requests\StoreClientCurrenciesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientCurrenciesRequest $request)
    {
        if (! Gate::allows('client_currency_create')) {
            return abort(401);
        }
        $client_currency = ClientCurrency::create($request->all());



        return redirect()->route('admin.client_currencies.index');
    }


    /**
     * Show the form for editing ClientCurrency.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('client_currency_edit')) {
            return abort(401);
        }
        $client_currency = ClientCurrency::findOrFail($id);

        return view('admin.client_currencies.edit', compact('client_currency'));
    }

    /**
     * Update ClientCurrency in storage.
     *
     * @param  \App\Http\Requests\UpdateClientCurrenciesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientCurrenciesRequest $request, $id)
    {
        if (! Gate::allows('client_currency_edit')) {
            return abort(401);
        }
        $client_currency = ClientCurrency::findOrFail($id);
        $client_currency->update($request->all());



        return redirect()->route('admin.client_currencies.index');
    }


    /**
     * Display ClientCurrency.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('client_currency_view')) {
            return abort(401);
        }
        $client_transactions = \App\ClientTransaction::where('currency_id', $id)->get();

        $client_currency = ClientCurrency::findOrFail($id);

        return view('admin.client_currencies.show', compact('client_currency', 'client_transactions'));
    }


    /**
     * Remove ClientCurrency from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('client_currency_delete')) {
            return abort(401);
        }
        $client_currency = ClientCurrency::findOrFail($id);
        $client_currency->delete();

        return redirect()->route('admin.client_currencies.index');
    }

    /**
     * Delete all selected ClientCurrency at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('client_currency_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ClientCurrency::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
