<?php

namespace App\Http\Controllers\Admin;

use App\BottomScript;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBottomScriptsRequest;
use App\Http\Requests\Admin\UpdateBottomScriptsRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class BottomScriptsController extends Controller
{
    /**
     * Display a listing of BottomScript.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('bottom_script_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('BottomScript.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('BottomScript.filter', 'my');
            }
        }

        
        if (request()->ajax()) {
            $query = BottomScript::query();
            $query->with("template");
            $query->with("created_by");
            $query->with("created_by_team");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('bottom_script_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'bottom_scripts.id',
                'bottom_scripts.script',
                'bottom_scripts.name',
                'bottom_scripts.jquery',
                'bottom_scripts.template_id',
                'bottom_scripts.created_by_id',
                'bottom_scripts.created_by_team_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'bottom_script_';
                $routeKey = 'admin.bottom_scripts';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('script', function ($row) {
                return $row->script ? $row->script : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('jquery', function ($row) {
                return \Form::checkbox("jquery", 1, $row->jquery == 1, ["disabled"]);
            });
            $table->editColumn('template.template_name', function ($row) {
                return $row->template ? $row->template->template_name : '';
            });
            $table->editColumn('created_by.name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });
            $table->editColumn('created_by_team.name', function ($row) {
                return $row->created_by_team ? $row->created_by_team->name : '';
            });

            $table->rawColumns(['actions','massDelete','jquery']);

            return $table->make(true);
        }

        return view('admin.bottom_scripts.index');
    }

    /**
     * Show the form for creating new BottomScript.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('bottom_script_create')) {
            return abort(401);
        }
        
        $templates = \App\Template::get()->pluck('template_name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.bottom_scripts.create', compact('templates', 'created_bies', 'created_by_teams'));
    }

    /**
     * Store a newly created BottomScript in storage.
     *
     * @param  \App\Http\Requests\StoreBottomScriptsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBottomScriptsRequest $request)
    {
        if (! Gate::allows('bottom_script_create')) {
            return abort(401);
        }
        $bottom_script = BottomScript::create($request->all());



        return redirect()->route('admin.bottom_scripts.index');
    }


    /**
     * Show the form for editing BottomScript.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('bottom_script_edit')) {
            return abort(401);
        }
        
        $templates = \App\Template::get()->pluck('template_name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $bottom_script = BottomScript::findOrFail($id);

        return view('admin.bottom_scripts.edit', compact('bottom_script', 'templates', 'created_bies', 'created_by_teams'));
    }

    /**
     * Update BottomScript in storage.
     *
     * @param  \App\Http\Requests\UpdateBottomScriptsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBottomScriptsRequest $request, $id)
    {
        if (! Gate::allows('bottom_script_edit')) {
            return abort(401);
        }
        $bottom_script = BottomScript::findOrFail($id);
        $bottom_script->update($request->all());



        return redirect()->route('admin.bottom_scripts.index');
    }


    /**
     * Display BottomScript.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('bottom_script_view')) {
            return abort(401);
        }
        $bottom_script = BottomScript::findOrFail($id);

        return view('admin.bottom_scripts.show', compact('bottom_script'));
    }


    /**
     * Remove BottomScript from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('bottom_script_delete')) {
            return abort(401);
        }
        $bottom_script = BottomScript::findOrFail($id);
        $bottom_script->delete();

        return redirect()->route('admin.bottom_scripts.index');
    }

    /**
     * Delete all selected BottomScript at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('bottom_script_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = BottomScript::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore BottomScript from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('bottom_script_delete')) {
            return abort(401);
        }
        $bottom_script = BottomScript::onlyTrashed()->findOrFail($id);
        $bottom_script->restore();

        return redirect()->route('admin.bottom_scripts.index');
    }

    /**
     * Permanently delete BottomScript from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('bottom_script_delete')) {
            return abort(401);
        }
        $bottom_script = BottomScript::onlyTrashed()->findOrFail($id);
        $bottom_script->forceDelete();

        return redirect()->route('admin.bottom_scripts.index');
    }
}
