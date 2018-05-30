<?php

namespace App\Http\Controllers\Admin;

use App\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLayoutsRequest;
use App\Http\Requests\Admin\UpdateLayoutsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class LayoutsController extends Controller
{
    /**
     * Display a listing of Layout.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('layout_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Layout::query();
            $query->with("template");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('layout_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'layouts.id',
                'layouts.layout',
                'layouts.path',
                'layouts.address',
                'layouts.template_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'layout_';
                $routeKey = 'admin.layouts';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('layout', function ($row) {
                return $row->layout ? $row->layout : '';
            });
            $table->editColumn('path', function ($row) {
                return $row->path ? $row->path : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('template.template_name', function ($row) {
                return $row->template ? $row->template->template_name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.layouts.index');
    }

    /**
     * Show the form for creating new Layout.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('layout_create')) {
            return abort(401);
        }
        
        $templates = \App\Template::get()->pluck('template_name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.layouts.create', compact('templates'));
    }

    /**
     * Store a newly created Layout in storage.
     *
     * @param  \App\Http\Requests\StoreLayoutsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLayoutsRequest $request)
    {
        if (! Gate::allows('layout_create')) {
            return abort(401);
        }
        $layout = Layout::create($request->all());



        return redirect()->route('admin.layouts.index');
    }


    /**
     * Show the form for editing Layout.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('layout_edit')) {
            return abort(401);
        }
        
        $templates = \App\Template::get()->pluck('template_name', 'id')->prepend(trans('global.app_please_select'), '');

        $layout = Layout::findOrFail($id);

        return view('admin.layouts.edit', compact('layout', 'templates'));
    }

    /**
     * Update Layout in storage.
     *
     * @param  \App\Http\Requests\UpdateLayoutsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLayoutsRequest $request, $id)
    {
        if (! Gate::allows('layout_edit')) {
            return abort(401);
        }
        $layout = Layout::findOrFail($id);
        $layout->update($request->all());



        return redirect()->route('admin.layouts.index');
    }


    /**
     * Display Layout.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('layout_view')) {
            return abort(401);
        }
        $layout = Layout::findOrFail($id);

        return view('admin.layouts.show', compact('layout'));
    }


    /**
     * Remove Layout from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('layout_delete')) {
            return abort(401);
        }
        $layout = Layout::findOrFail($id);
        $layout->delete();

        return redirect()->route('admin.layouts.index');
    }

    /**
     * Delete all selected Layout at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('layout_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Layout::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Layout from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('layout_delete')) {
            return abort(401);
        }
        $layout = Layout::onlyTrashed()->findOrFail($id);
        $layout->restore();

        return redirect()->route('admin.layouts.index');
    }

    /**
     * Permanently delete Layout from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('layout_delete')) {
            return abort(401);
        }
        $layout = Layout::onlyTrashed()->findOrFail($id);
        $layout->forceDelete();

        return redirect()->route('admin.layouts.index');
    }
}
