<?php

namespace App\Http\Controllers\Admin;

use App\ClientIncomeSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientIncomeSourcesRequest;
use App\Http\Requests\Admin\UpdateClientIncomeSourcesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClientIncomeSourcesController extends Controller
{
    /**
     * Display a listing of ClientIncomeSource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('client_income_source_access')) {
            return abort(401);
        }


                $client_income_sources = ClientIncomeSource::all();

        return view('admin.client_income_sources.index', compact('client_income_sources'));
    }

    /**
     * Show the form for creating new ClientIncomeSource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('client_income_source_create')) {
            return abort(401);
        }
        return view('admin.client_income_sources.create');
    }

    /**
     * Store a newly created ClientIncomeSource in storage.
     *
     * @param  \App\Http\Requests\StoreClientIncomeSourcesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientIncomeSourcesRequest $request)
    {
        if (! Gate::allows('client_income_source_create')) {
            return abort(401);
        }
        $client_income_source = ClientIncomeSource::create($request->all());



        return redirect()->route('admin.client_income_sources.index');
    }


    /**
     * Show the form for editing ClientIncomeSource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('client_income_source_edit')) {
            return abort(401);
        }
        $client_income_source = ClientIncomeSource::findOrFail($id);

        return view('admin.client_income_sources.edit', compact('client_income_source'));
    }

    /**
     * Update ClientIncomeSource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientIncomeSourcesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientIncomeSourcesRequest $request, $id)
    {
        if (! Gate::allows('client_income_source_edit')) {
            return abort(401);
        }
        $client_income_source = ClientIncomeSource::findOrFail($id);
        $client_income_source->update($request->all());



        return redirect()->route('admin.client_income_sources.index');
    }


    /**
     * Display ClientIncomeSource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('client_income_source_view')) {
            return abort(401);
        }
        $client_transactions = \App\ClientTransaction::where('income_source_id', $id)->get();

        $client_income_source = ClientIncomeSource::findOrFail($id);

        return view('admin.client_income_sources.show', compact('client_income_source', 'client_transactions'));
    }


    /**
     * Remove ClientIncomeSource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('client_income_source_delete')) {
            return abort(401);
        }
        $client_income_source = ClientIncomeSource::findOrFail($id);
        $client_income_source->delete();

        return redirect()->route('admin.client_income_sources.index');
    }

    /**
     * Delete all selected ClientIncomeSource at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('client_income_source_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ClientIncomeSource::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
