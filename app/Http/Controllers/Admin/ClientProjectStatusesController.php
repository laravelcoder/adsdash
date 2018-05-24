<?php

namespace App\Http\Controllers\Admin;

use App\ClientProjectStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientProjectStatusesRequest;
use App\Http\Requests\Admin\UpdateClientProjectStatusesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClientProjectStatusesController extends Controller
{
    /**
     * Display a listing of ClientProjectStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('client_project_status_access')) {
            return abort(401);
        }


                $client_project_statuses = ClientProjectStatus::all();

        return view('admin.client_project_statuses.index', compact('client_project_statuses'));
    }

    /**
     * Show the form for creating new ClientProjectStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('client_project_status_create')) {
            return abort(401);
        }
        return view('admin.client_project_statuses.create');
    }

    /**
     * Store a newly created ClientProjectStatus in storage.
     *
     * @param  \App\Http\Requests\StoreClientProjectStatusesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientProjectStatusesRequest $request)
    {
        if (! Gate::allows('client_project_status_create')) {
            return abort(401);
        }
        $client_project_status = ClientProjectStatus::create($request->all());



        return redirect()->route('admin.client_project_statuses.index');
    }


    /**
     * Show the form for editing ClientProjectStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('client_project_status_edit')) {
            return abort(401);
        }
        $client_project_status = ClientProjectStatus::findOrFail($id);

        return view('admin.client_project_statuses.edit', compact('client_project_status'));
    }

    /**
     * Update ClientProjectStatus in storage.
     *
     * @param  \App\Http\Requests\UpdateClientProjectStatusesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientProjectStatusesRequest $request, $id)
    {
        if (! Gate::allows('client_project_status_edit')) {
            return abort(401);
        }
        $client_project_status = ClientProjectStatus::findOrFail($id);
        $client_project_status->update($request->all());



        return redirect()->route('admin.client_project_statuses.index');
    }


    /**
     * Display ClientProjectStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('client_project_status_view')) {
            return abort(401);
        }
        $client_projects = \App\ClientProject::where('project_status_id', $id)->get();

        $client_project_status = ClientProjectStatus::findOrFail($id);

        return view('admin.client_project_statuses.show', compact('client_project_status', 'client_projects'));
    }


    /**
     * Remove ClientProjectStatus from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('client_project_status_delete')) {
            return abort(401);
        }
        $client_project_status = ClientProjectStatus::findOrFail($id);
        $client_project_status->delete();

        return redirect()->route('admin.client_project_statuses.index');
    }

    /**
     * Delete all selected ClientProjectStatus at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('client_project_status_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ClientProjectStatus::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
