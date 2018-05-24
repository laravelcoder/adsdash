<?php

namespace App\Http\Controllers\Admin;

use App\Audience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAudiencesRequest;
use App\Http\Requests\Admin\UpdateAudiencesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class AudiencesController extends Controller
{
    /**
     * Display a listing of Audience.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('audience_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Audience::query();
            $query->with("companies");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('audience_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'audiences.id',
                'audiences.name',
                'audiences.value',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'audience_';
                $routeKey = 'admin.audiences';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('companies.name', function ($row) {
                if(count($row->companies) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->companies->pluck('name')->toArray()) . '</span>';
            });

            $table->rawColumns(['actions','massDelete','companies.name']);

            return $table->make(true);
        }

        return view('admin.audiences.index');
    }

    /**
     * Show the form for creating new Audience.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('audience_create')) {
            return abort(401);
        }
        
        $companies = \App\ContactCompany::get()->pluck('name', 'id');


        return view('admin.audiences.create', compact('companies'));
    }

    /**
     * Store a newly created Audience in storage.
     *
     * @param  \App\Http\Requests\StoreAudiencesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAudiencesRequest $request)
    {
        if (! Gate::allows('audience_create')) {
            return abort(401);
        }
        $audience = Audience::create($request->all());
        $audience->companies()->sync(array_filter((array)$request->input('companies')));



        return redirect()->route('admin.audiences.index');
    }


    /**
     * Show the form for editing Audience.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('audience_edit')) {
            return abort(401);
        }
        
        $companies = \App\ContactCompany::get()->pluck('name', 'id');


        $audience = Audience::findOrFail($id);

        return view('admin.audiences.edit', compact('audience', 'companies'));
    }

    /**
     * Update Audience in storage.
     *
     * @param  \App\Http\Requests\UpdateAudiencesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAudiencesRequest $request, $id)
    {
        if (! Gate::allows('audience_edit')) {
            return abort(401);
        }
        $audience = Audience::findOrFail($id);
        $audience->update($request->all());
        $audience->companies()->sync(array_filter((array)$request->input('companies')));



        return redirect()->route('admin.audiences.index');
    }


    /**
     * Display Audience.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('audience_view')) {
            return abort(401);
        }
        
        $companies = \App\ContactCompany::get()->pluck('name', 'id');
$demographics = \App\Demographic::where('audience_id', $id)->get();

        $audience = Audience::findOrFail($id);

        return view('admin.audiences.show', compact('audience', 'demographics'));
    }


    /**
     * Remove Audience from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('audience_delete')) {
            return abort(401);
        }
        $audience = Audience::findOrFail($id);
        $audience->delete();

        return redirect()->route('admin.audiences.index');
    }

    /**
     * Delete all selected Audience at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('audience_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Audience::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Audience from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('audience_delete')) {
            return abort(401);
        }
        $audience = Audience::onlyTrashed()->findOrFail($id);
        $audience->restore();

        return redirect()->route('admin.audiences.index');
    }

    /**
     * Permanently delete Audience from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('audience_delete')) {
            return abort(401);
        }
        $audience = Audience::onlyTrashed()->findOrFail($id);
        $audience->forceDelete();

        return redirect()->route('admin.audiences.index');
    }
}
