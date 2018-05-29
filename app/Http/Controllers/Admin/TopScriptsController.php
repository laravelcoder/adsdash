<?php

namespace App\Http\Controllers\Admin;

use App\TopScript;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTopScriptsRequest;
use App\Http\Requests\Admin\UpdateTopScriptsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TopScriptsController extends Controller
{
    /**
     * Display a listing of TopScript.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('top_script_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = TopScript::query();
            $query->with("template");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('top_script_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'top_scripts.id',
                'top_scripts.name',
                'top_scripts.script',
                'top_scripts.jquery',
                'top_scripts.template_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'top_script_';
                $routeKey = 'admin.top_scripts';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('script', function ($row) {
                return $row->script ? $row->script : '';
            });
            $table->editColumn('jquery', function ($row) {
                return \Form::checkbox("jquery", 1, $row->jquery == 1, ["disabled"]);
            });
            $table->editColumn('template.template_name', function ($row) {
                return $row->template ? $row->template->template_name : '';
            });

            $table->rawColumns(['actions','massDelete','jquery']);

            return $table->make(true);
        }

        return view('admin.top_scripts.index');
    }

    /**
     * Show the form for creating new TopScript.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('top_script_create')) {
            return abort(401);
        }
        
        $templates = \App\Template::get()->pluck('template_name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.top_scripts.create', compact('templates'));
    }

    /**
     * Store a newly created TopScript in storage.
     *
     * @param  \App\Http\Requests\StoreTopScriptsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTopScriptsRequest $request)
    {
        if (! Gate::allows('top_script_create')) {
            return abort(401);
        }
        $top_script = TopScript::create($request->all());



        return redirect()->route('admin.top_scripts.index');
    }


    /**
     * Show the form for editing TopScript.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('top_script_edit')) {
            return abort(401);
        }
        
        $templates = \App\Template::get()->pluck('template_name', 'id')->prepend(trans('global.app_please_select'), '');

        $top_script = TopScript::findOrFail($id);

        return view('admin.top_scripts.edit', compact('top_script', 'templates'));
    }

    /**
     * Update TopScript in storage.
     *
     * @param  \App\Http\Requests\UpdateTopScriptsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopScriptsRequest $request, $id)
    {
        if (! Gate::allows('top_script_edit')) {
            return abort(401);
        }
        $top_script = TopScript::findOrFail($id);
        $top_script->update($request->all());



        return redirect()->route('admin.top_scripts.index');
    }


    /**
     * Display TopScript.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('top_script_view')) {
            return abort(401);
        }
        $top_script = TopScript::findOrFail($id);

        return view('admin.top_scripts.show', compact('top_script'));
    }


    /**
     * Remove TopScript from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('top_script_delete')) {
            return abort(401);
        }
        $top_script = TopScript::findOrFail($id);
        $top_script->delete();

        return redirect()->route('admin.top_scripts.index');
    }

    /**
     * Delete all selected TopScript at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('top_script_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = TopScript::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore TopScript from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('top_script_delete')) {
            return abort(401);
        }
        $top_script = TopScript::onlyTrashed()->findOrFail($id);
        $top_script->restore();

        return redirect()->route('admin.top_scripts.index');
    }

    /**
     * Permanently delete TopScript from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('top_script_delete')) {
            return abort(401);
        }
        $top_script = TopScript::onlyTrashed()->findOrFail($id);
        $top_script->forceDelete();

        return redirect()->route('admin.top_scripts.index');
    }
}
