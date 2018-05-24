<?php

namespace App\Http\Controllers\Admin;

use App\ClientTransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientTransactionTypesRequest;
use App\Http\Requests\Admin\UpdateClientTransactionTypesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClientTransactionTypesController extends Controller
{
    /**
     * Display a listing of ClientTransactionType.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('client_transaction_type_access')) {
            return abort(401);
        }


                $client_transaction_types = ClientTransactionType::all();

        return view('admin.client_transaction_types.index', compact('client_transaction_types'));
    }

    /**
     * Show the form for creating new ClientTransactionType.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('client_transaction_type_create')) {
            return abort(401);
        }
        return view('admin.client_transaction_types.create');
    }

    /**
     * Store a newly created ClientTransactionType in storage.
     *
     * @param  \App\Http\Requests\StoreClientTransactionTypesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientTransactionTypesRequest $request)
    {
        if (! Gate::allows('client_transaction_type_create')) {
            return abort(401);
        }
        $client_transaction_type = ClientTransactionType::create($request->all());



        return redirect()->route('admin.client_transaction_types.index');
    }


    /**
     * Show the form for editing ClientTransactionType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('client_transaction_type_edit')) {
            return abort(401);
        }
        $client_transaction_type = ClientTransactionType::findOrFail($id);

        return view('admin.client_transaction_types.edit', compact('client_transaction_type'));
    }

    /**
     * Update ClientTransactionType in storage.
     *
     * @param  \App\Http\Requests\UpdateClientTransactionTypesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientTransactionTypesRequest $request, $id)
    {
        if (! Gate::allows('client_transaction_type_edit')) {
            return abort(401);
        }
        $client_transaction_type = ClientTransactionType::findOrFail($id);
        $client_transaction_type->update($request->all());



        return redirect()->route('admin.client_transaction_types.index');
    }


    /**
     * Display ClientTransactionType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('client_transaction_type_view')) {
            return abort(401);
        }
        $client_transactions = \App\ClientTransaction::where('transaction_type_id', $id)->get();

        $client_transaction_type = ClientTransactionType::findOrFail($id);

        return view('admin.client_transaction_types.show', compact('client_transaction_type', 'client_transactions'));
    }


    /**
     * Remove ClientTransactionType from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('client_transaction_type_delete')) {
            return abort(401);
        }
        $client_transaction_type = ClientTransactionType::findOrFail($id);
        $client_transaction_type->delete();

        return redirect()->route('admin.client_transaction_types.index');
    }

    /**
     * Delete all selected ClientTransactionType at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('client_transaction_type_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ClientTransactionType::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
