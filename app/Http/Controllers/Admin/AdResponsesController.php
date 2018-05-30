<?php

namespace App\Http\Controllers\Admin;

use App\AdResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdResponsesRequest;
use App\Http\Requests\Admin\UpdateAdResponsesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class AdResponsesController extends Controller
{
    /**
     * Display a listing of AdResponse.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('ad_response_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = AdResponse::query();
            $query->with("station");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('ad_response_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'ad_responses.id',
                'ad_responses.station_id',
                'ad_responses.time',
                'ad_responses.impressions',
                'ad_responses.non_impressions',
                'ad_responses.cypi_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'ad_response_';
                $routeKey = 'admin.ad_responses';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('station.station_label', function ($row) {
                return $row->station ? $row->station->station_label : '';
            });
            $table->editColumn('time', function ($row) {
                return $row->time ? $row->time : '';
            });
            $table->editColumn('impressions', function ($row) {
                return $row->impressions ? $row->impressions : '';
            });
            $table->editColumn('non_impressions', function ($row) {
                return $row->non_impressions ? $row->non_impressions : '';
            });
            $table->editColumn('cypi_id', function ($row) {
                return $row->cypi_id ? $row->cypi_id : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.ad_responses.index');
    }

    /**
     * Show the form for creating new AdResponse.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('ad_response_create')) {
            return abort(401);
        }
        
        $stations = \App\Station::get()->pluck('station_label', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.ad_responses.create', compact('stations'));
    }

    /**
     * Store a newly created AdResponse in storage.
     *
     * @param  \App\Http\Requests\StoreAdResponsesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdResponsesRequest $request)
    {
        if (! Gate::allows('ad_response_create')) {
            return abort(401);
        }
        $ad_response = AdResponse::create($request->all());



        return redirect()->route('admin.ad_responses.index');
    }


    /**
     * Show the form for editing AdResponse.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('ad_response_edit')) {
            return abort(401);
        }
        
        $stations = \App\Station::get()->pluck('station_label', 'id')->prepend(trans('global.app_please_select'), '');

        $ad_response = AdResponse::findOrFail($id);

        return view('admin.ad_responses.edit', compact('ad_response', 'stations'));
    }

    /**
     * Update AdResponse in storage.
     *
     * @param  \App\Http\Requests\UpdateAdResponsesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdResponsesRequest $request, $id)
    {
        if (! Gate::allows('ad_response_edit')) {
            return abort(401);
        }
        $ad_response = AdResponse::findOrFail($id);
        $ad_response->update($request->all());



        return redirect()->route('admin.ad_responses.index');
    }


    /**
     * Display AdResponse.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('ad_response_view')) {
            return abort(401);
        }
        $ad_response = AdResponse::findOrFail($id);

        return view('admin.ad_responses.show', compact('ad_response'));
    }


    /**
     * Remove AdResponse from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('ad_response_delete')) {
            return abort(401);
        }
        $ad_response = AdResponse::findOrFail($id);
        $ad_response->delete();

        return redirect()->route('admin.ad_responses.index');
    }

    /**
     * Delete all selected AdResponse at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('ad_response_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = AdResponse::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore AdResponse from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('ad_response_delete')) {
            return abort(401);
        }
        $ad_response = AdResponse::onlyTrashed()->findOrFail($id);
        $ad_response->restore();

        return redirect()->route('admin.ad_responses.index');
    }

    /**
     * Permanently delete AdResponse from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('ad_response_delete')) {
            return abort(401);
        }
        $ad_response = AdResponse::onlyTrashed()->findOrFail($id);
        $ad_response->forceDelete();

        return redirect()->route('admin.ad_responses.index');
    }
}
