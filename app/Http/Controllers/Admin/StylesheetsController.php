<?php

namespace App\Http\Controllers\Admin;

use App\Stylesheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStylesheetsRequest;
use App\Http\Requests\Admin\UpdateStylesheetsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

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
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Stylesheet.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Stylesheet.filter', 'my');
            }
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('stylesheet_delete')) {
                return abort(401);
            }
            $stylesheets = Stylesheet::onlyTrashed()->get();
        } else {
            $stylesheets = Stylesheet::all();
        }

        return view('admin.stylesheets.index', compact('stylesheets'));
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
        
        $templates = \App\Template::get()->pluck('template_name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.stylesheets.create', compact('templates'));
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
        
        $templates = \App\Template::get()->pluck('template_name', 'id')->prepend(trans('global.app_please_select'), '');

        $stylesheet = Stylesheet::findOrFail($id);

        return view('admin.stylesheets.edit', compact('stylesheet', 'templates'));
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
