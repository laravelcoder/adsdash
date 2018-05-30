<?php

namespace App\Http\Controllers\Admin;

use App\BottomScript;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBottomScriptsRequest;
use App\Http\Requests\Admin\UpdateBottomScriptsRequest;
use Yajra\DataTables\DataTables;

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


        
        if (request()->ajax()) {
            $query = BottomScript::query();
            $query->with("pages");
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
            $table->editColumn('pages.title', function ($row) {
                if(count($row->pages) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->pages->pluck('title')->toArray()) . '</span>';
            });

            $table->rawColumns(['actions','massDelete','jquery','pages.title']);

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
        
        $pages = \App\ContentPage::get()->pluck('title', 'id');


        return view('admin.bottom_scripts.create', compact('pages'));
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
        $bottom_script->pages()->sync(array_filter((array)$request->input('pages')));



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
        
        $pages = \App\ContentPage::get()->pluck('title', 'id');


        $bottom_script = BottomScript::findOrFail($id);

        return view('admin.bottom_scripts.edit', compact('bottom_script', 'pages'));
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
        $bottom_script->pages()->sync(array_filter((array)$request->input('pages')));



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
