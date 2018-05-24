<?php

namespace App\Http\Controllers\Admin;

use App\ClientStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientStatusesRequest;
use App\Http\Requests\Admin\UpdateClientStatusesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClientStatusesController extends Controller
{
    /**
     * Display a listing of ClientStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('client_status_access')) {
            return abort(401);
        }


                $client_statuses = ClientStatus::all();

        return view('admin.client_statuses.index', compact('client_statuses'));
    }

    /**
     * Show the form for creating new ClientStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('client_status_create')) {
            return abort(401);
        }
        return view('admin.client_statuses.create');
    }

    /**
     * Store a newly created ClientStatus in storage.
     *
     * @param  \App\Http\Requests\StoreClientStatusesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientStatusesRequest $request)
    {
        if (! Gate::allows('client_status_create')) {
            return abort(401);
        }
        $client_status = ClientStatus::create($request->all());



        return redirect()->route('admin.client_statuses.index');
    }


    /**
     * Show the form for editing ClientStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('client_status_edit')) {
            return abort(401);
        }
        $client_status = ClientStatus::findOrFail($id);

        return view('admin.client_statuses.edit', compact('client_status'));
    }

    /**
     * Update ClientStatus in storage.
     *
     * @param  \App\Http\Requests\UpdateClientStatusesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientStatusesRequest $request, $id)
    {
        if (! Gate::allows('client_status_edit')) {
            return abort(401);
        }
        $client_status = ClientStatus::findOrFail($id);
        $client_status->update($request->all());



        return redirect()->route('admin.client_statuses.index');
    }


    /**
     * Display ClientStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('client_status_view')) {
            return abort(401);
        }
        $clients = \App\Client::where('client_status_id', $id)->get();

        $client_status = ClientStatus::findOrFail($id);

        return view('admin.client_statuses.show', compact('client_status', 'clients'));
    }


    /**
     * Remove ClientStatus from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('client_status_delete')) {
            return abort(401);
        }
        $client_status = ClientStatus::findOrFail($id);
        $client_status->delete();

        return redirect()->route('admin.client_statuses.index');
    }

    /**
     * Delete all selected ClientStatus at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('client_status_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ClientStatus::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
