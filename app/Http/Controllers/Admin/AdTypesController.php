<?php

namespace App\Http\Controllers\Admin;

use App\AdType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdTypesRequest;
use App\Http\Requests\Admin\UpdateAdTypesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class AdTypesController extends Controller
{
    /**
     * Display a listing of AdType.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('ad_type_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = AdType::query();
            $template = 'actionsTemplate';
            
            $query->select([
                'ad_types.id',
                'ad_types.codec',
                'ad_types.extention',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'ad_type_';
                $routeKey = 'admin.ad_types';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('codec', function ($row) {
                return $row->codec ? $row->codec : '';
            });
            $table->editColumn('extention', function ($row) {
                return $row->extention ? $row->extention : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.ad_types.index');
    }

    /**
     * Show the form for creating new AdType.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('ad_type_create')) {
            return abort(401);
        }
        return view('admin.ad_types.create');
    }

    /**
     * Store a newly created AdType in storage.
     *
     * @param  \App\Http\Requests\StoreAdTypesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdTypesRequest $request)
    {
        if (! Gate::allows('ad_type_create')) {
            return abort(401);
        }
        $ad_type = AdType::create($request->all());



        return redirect()->route('admin.ad_types.index');
    }


    /**
     * Show the form for editing AdType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('ad_type_edit')) {
            return abort(401);
        }
        $ad_type = AdType::findOrFail($id);

        return view('admin.ad_types.edit', compact('ad_type'));
    }

    /**
     * Update AdType in storage.
     *
     * @param  \App\Http\Requests\UpdateAdTypesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdTypesRequest $request, $id)
    {
        if (! Gate::allows('ad_type_edit')) {
            return abort(401);
        }
        $ad_type = AdType::findOrFail($id);
        $ad_type->update($request->all());



        return redirect()->route('admin.ad_types.index');
    }


    /**
     * Display AdType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('ad_type_view')) {
            return abort(401);
        }
        $ad_type = AdType::findOrFail($id);

        return view('admin.ad_types.show', compact('ad_type'));
    }


    /**
     * Remove AdType from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('ad_type_delete')) {
            return abort(401);
        }
        $ad_type = AdType::findOrFail($id);
        $ad_type->delete();

        return redirect()->route('admin.ad_types.index');
    }

    /**
     * Delete all selected AdType at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('ad_type_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = AdType::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
