<?php

namespace App\Http\Controllers\Admin;

use App\ClientNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientNotesRequest;
use App\Http\Requests\Admin\UpdateClientNotesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClientNotesController extends Controller
{
    /**
     * Display a listing of ClientNote.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('client_note_access')) {
            return abort(401);
        }


                $client_notes = ClientNote::all();

        return view('admin.client_notes.index', compact('client_notes'));
    }

    /**
     * Show the form for creating new ClientNote.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('client_note_create')) {
            return abort(401);
        }
        
        $projects = \App\ClientProject::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.client_notes.create', compact('projects'));
    }

    /**
     * Store a newly created ClientNote in storage.
     *
     * @param  \App\Http\Requests\StoreClientNotesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientNotesRequest $request)
    {
        if (! Gate::allows('client_note_create')) {
            return abort(401);
        }
        $client_note = ClientNote::create($request->all());



        return redirect()->route('admin.client_notes.index');
    }


    /**
     * Show the form for editing ClientNote.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('client_note_edit')) {
            return abort(401);
        }
        
        $projects = \App\ClientProject::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        $client_note = ClientNote::findOrFail($id);

        return view('admin.client_notes.edit', compact('client_note', 'projects'));
    }

    /**
     * Update ClientNote in storage.
     *
     * @param  \App\Http\Requests\UpdateClientNotesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientNotesRequest $request, $id)
    {
        if (! Gate::allows('client_note_edit')) {
            return abort(401);
        }
        $client_note = ClientNote::findOrFail($id);
        $client_note->update($request->all());



        return redirect()->route('admin.client_notes.index');
    }


    /**
     * Display ClientNote.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('client_note_view')) {
            return abort(401);
        }
        $client_note = ClientNote::findOrFail($id);

        return view('admin.client_notes.show', compact('client_note'));
    }


    /**
     * Remove ClientNote from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('client_note_delete')) {
            return abort(401);
        }
        $client_note = ClientNote::findOrFail($id);
        $client_note->delete();

        return redirect()->route('admin.client_notes.index');
    }

    /**
     * Delete all selected ClientNote at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('client_note_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ClientNote::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
