<?php

namespace App\Http\Controllers\Admin;

use App\ClientProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientProjectsRequest;
use App\Http\Requests\Admin\UpdateClientProjectsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClientProjectsController extends Controller
{
    /**
     * Display a listing of ClientProject.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('client_project_access')) {
            return abort(401);
        }


                $client_projects = ClientProject::all();

        return view('admin.client_projects.index', compact('client_projects'));
    }

    /**
     * Show the form for creating new ClientProject.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('client_project_create')) {
            return abort(401);
        }
        
        $clients = \App\Client::get()->pluck('first_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_statuses = \App\ClientProjectStatus::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.client_projects.create', compact('clients', 'project_statuses'));
    }

    /**
     * Store a newly created ClientProject in storage.
     *
     * @param  \App\Http\Requests\StoreClientProjectsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientProjectsRequest $request)
    {
        if (! Gate::allows('client_project_create')) {
            return abort(401);
        }
        $client_project = ClientProject::create($request->all());



        return redirect()->route('admin.client_projects.index');
    }


    /**
     * Show the form for editing ClientProject.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('client_project_edit')) {
            return abort(401);
        }
        
        $clients = \App\Client::get()->pluck('first_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_statuses = \App\ClientProjectStatus::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        $client_project = ClientProject::findOrFail($id);

        return view('admin.client_projects.edit', compact('client_project', 'clients', 'project_statuses'));
    }

    /**
     * Update ClientProject in storage.
     *
     * @param  \App\Http\Requests\UpdateClientProjectsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientProjectsRequest $request, $id)
    {
        if (! Gate::allows('client_project_edit')) {
            return abort(401);
        }
        $client_project = ClientProject::findOrFail($id);
        $client_project->update($request->all());



        return redirect()->route('admin.client_projects.index');
    }


    /**
     * Display ClientProject.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('client_project_view')) {
            return abort(401);
        }
        
        $clients = \App\Client::get()->pluck('first_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_statuses = \App\ClientProjectStatus::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');$client_notes = \App\ClientNote::where('project_id', $id)->get();$client_documents = \App\ClientDocument::where('project_id', $id)->get();$client_transactions = \App\ClientTransaction::where('project_id', $id)->get();

        $client_project = ClientProject::findOrFail($id);

        return view('admin.client_projects.show', compact('client_project', 'client_notes', 'client_documents', 'client_transactions'));
    }


    /**
     * Remove ClientProject from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('client_project_delete')) {
            return abort(401);
        }
        $client_project = ClientProject::findOrFail($id);
        $client_project->delete();

        return redirect()->route('admin.client_projects.index');
    }

    /**
     * Delete all selected ClientProject at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('client_project_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ClientProject::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
