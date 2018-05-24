<?php

namespace App\Http\Controllers\Admin;

use App\Variable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVariablesRequest;
use App\Http\Requests\Admin\UpdateVariablesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class VariablesController extends Controller
{
    /**
     * Display a listing of Variable.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('variable_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Variable::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('variable_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'variables.id',
                'variables.name',
                'variables.value',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'variable_';
                $routeKey = 'admin.variables';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('value', function ($row) {
                return $row->value ? $row->value : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.variables.index');
    }

    /**
     * Show the form for creating new Variable.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('variable_create')) {
            return abort(401);
        }
        return view('admin.variables.create');
    }

    /**
     * Store a newly created Variable in storage.
     *
     * @param  \App\Http\Requests\StoreVariablesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVariablesRequest $request)
    {
        if (! Gate::allows('variable_create')) {
            return abort(401);
        }
        $variable = Variable::create($request->all());



        return redirect()->route('admin.variables.index');
    }


    /**
     * Show the form for editing Variable.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('variable_edit')) {
            return abort(401);
        }
        $variable = Variable::findOrFail($id);

        return view('admin.variables.edit', compact('variable'));
    }

    /**
     * Update Variable in storage.
     *
     * @param  \App\Http\Requests\UpdateVariablesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVariablesRequest $request, $id)
    {
        if (! Gate::allows('variable_edit')) {
            return abort(401);
        }
        $variable = Variable::findOrFail($id);
        $variable->update($request->all());



        return redirect()->route('admin.variables.index');
    }


    /**
     * Display Variable.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('variable_view')) {
            return abort(401);
        }
        $variable = Variable::findOrFail($id);

        return view('admin.variables.show', compact('variable'));
    }


    /**
     * Remove Variable from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('variable_delete')) {
            return abort(401);
        }
        $variable = Variable::findOrFail($id);
        $variable->delete();

        return redirect()->route('admin.variables.index');
    }

    /**
     * Delete all selected Variable at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('variable_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Variable::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Variable from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('variable_delete')) {
            return abort(401);
        }
        $variable = Variable::onlyTrashed()->findOrFail($id);
        $variable->restore();

        return redirect()->route('admin.variables.index');
    }

    /**
     * Permanently delete Variable from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('variable_delete')) {
            return abort(401);
        }
        $variable = Variable::onlyTrashed()->findOrFail($id);
        $variable->forceDelete();

        return redirect()->route('admin.variables.index');
    }
}
