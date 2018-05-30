<?php

namespace App\Http\Controllers\Admin;

use App\Stylesheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStylesheetsRequest;
use App\Http\Requests\Admin\UpdateStylesheetsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class StylesheetsController extends Controller
{
    /**
     * Display a listing of Stylesheet.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('stylesheet_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Stylesheet::query();
            $query->with("pages");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('stylesheet_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'stylesheets.id',
                'stylesheets.order',
                'stylesheets.link',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'stylesheet_';
                $routeKey = 'admin.stylesheets';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('order', function ($row) {
                return $row->order ? $row->order : '';
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });
            $table->editColumn('pages.title', function ($row) {
                if(count($row->pages) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->pages->pluck('title')->toArray()) . '</span>';
            });

            $table->rawColumns(['actions','massDelete','pages.title']);

            return $table->make(true);
        }

        return view('admin.stylesheets.index');
    }

    /**
     * Show the form for creating new Stylesheet.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('stylesheet_create')) {
            return abort(401);
        }
        
        $pages = \App\ContentPage::get()->pluck('title', 'id');


        return view('admin.stylesheets.create', compact('pages'));
    }

    /**
     * Store a newly created Stylesheet in storage.
     *
     * @param  \App\Http\Requests\StoreStylesheetsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStylesheetsRequest $request)
    {
        if (! Gate::allows('stylesheet_create')) {
            return abort(401);
        }
        $stylesheet = Stylesheet::create($request->all());
        $stylesheet->pages()->sync(array_filter((array)$request->input('pages')));



        return redirect()->route('admin.stylesheets.index');
    }


    /**
     * Show the form for editing Stylesheet.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('stylesheet_edit')) {
            return abort(401);
        }
        
        $pages = \App\ContentPage::get()->pluck('title', 'id');


        $stylesheet = Stylesheet::findOrFail($id);

        return view('admin.stylesheets.edit', compact('stylesheet', 'pages'));
    }

    /**
     * Update Stylesheet in storage.
     *
     * @param  \App\Http\Requests\UpdateStylesheetsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStylesheetsRequest $request, $id)
    {
        if (! Gate::allows('stylesheet_edit')) {
            return abort(401);
        }
        $stylesheet = Stylesheet::findOrFail($id);
        $stylesheet->update($request->all());
        $stylesheet->pages()->sync(array_filter((array)$request->input('pages')));



        return redirect()->route('admin.stylesheets.index');
    }


    /**
     * Display Stylesheet.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('stylesheet_view')) {
            return abort(401);
        }
        $stylesheet = Stylesheet::findOrFail($id);

        return view('admin.stylesheets.show', compact('stylesheet'));
    }


    /**
     * Remove Stylesheet from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('stylesheet_delete')) {
            return abort(401);
        }
        $stylesheet = Stylesheet::findOrFail($id);
        $stylesheet->delete();

        return redirect()->route('admin.stylesheets.index');
    }

    /**
     * Delete all selected Stylesheet at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('stylesheet_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Stylesheet::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Stylesheet from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('stylesheet_delete')) {
            return abort(401);
        }
        $stylesheet = Stylesheet::onlyTrashed()->findOrFail($id);
        $stylesheet->restore();

        return redirect()->route('admin.stylesheets.index');
    }

    /**
     * Permanently delete Stylesheet from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('stylesheet_delete')) {
            return abort(401);
        }
        $stylesheet = Stylesheet::onlyTrashed()->findOrFail($id);
        $stylesheet->forceDelete();

        return redirect()->route('admin.stylesheets.index');
    }
}
