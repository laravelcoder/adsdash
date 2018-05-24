<?php

namespace App\Http\Controllers\Admin;

use App\ClientDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientDocumentsRequest;
use App\Http\Requests\Admin\UpdateClientDocumentsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClientDocumentsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of ClientDocument.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('client_document_access')) {
            return abort(401);
        }


                $client_documents = ClientDocument::all();

        return view('admin.client_documents.index', compact('client_documents'));
    }

    /**
     * Show the form for creating new ClientDocument.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('client_document_create')) {
            return abort(401);
        }
        
        $projects = \App\ClientProject::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.client_documents.create', compact('projects'));
    }

    /**
     * Store a newly created ClientDocument in storage.
     *
     * @param  \App\Http\Requests\StoreClientDocumentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientDocumentsRequest $request)
    {
        if (! Gate::allows('client_document_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $client_document = ClientDocument::create($request->all());



        return redirect()->route('admin.client_documents.index');
    }


    /**
     * Show the form for editing ClientDocument.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('client_document_edit')) {
            return abort(401);
        }
        
        $projects = \App\ClientProject::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        $client_document = ClientDocument::findOrFail($id);

        return view('admin.client_documents.edit', compact('client_document', 'projects'));
    }

    /**
     * Update ClientDocument in storage.
     *
     * @param  \App\Http\Requests\UpdateClientDocumentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientDocumentsRequest $request, $id)
    {
        if (! Gate::allows('client_document_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $client_document = ClientDocument::findOrFail($id);
        $client_document->update($request->all());



        return redirect()->route('admin.client_documents.index');
    }


    /**
     * Display ClientDocument.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('client_document_view')) {
            return abort(401);
        }
        $client_document = ClientDocument::findOrFail($id);

        return view('admin.client_documents.show', compact('client_document'));
    }


    /**
     * Remove ClientDocument from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('client_document_delete')) {
            return abort(401);
        }
        $client_document = ClientDocument::findOrFail($id);
        $client_document->delete();

        return redirect()->route('admin.client_documents.index');
    }

    /**
     * Delete all selected ClientDocument at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('client_document_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ClientDocument::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
