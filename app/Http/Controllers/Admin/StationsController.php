<?php

namespace App\Http\Controllers\Admin;

use App\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStationsRequest;
use App\Http\Requests\Admin\UpdateStationsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class StationsController extends Controller
{
    /**
     * Display a listing of Station.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('station_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Station::query();
            $query->with("provider");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('station_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'stations.id',
                'stations.station_label',
                'stations.channel_number',
                'stations.provider_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'station_';
                $routeKey = 'admin.stations';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('channel_number', function ($row) {
                return $row->channel_number ? $row->channel_number : '';
            });
            $table->editColumn('provider.provider', function ($row) {
                return $row->provider ? $row->provider->provider : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.stations.index');
    }

    /**
     * Show the form for creating new Station.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('station_create')) {
            return abort(401);
        }
        
        $providers = \App\Provider::get()->pluck('provider', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.stations.create', compact('providers'));
    }

    /**
     * Store a newly created Station in storage.
     *
     * @param  \App\Http\Requests\StoreStationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStationsRequest $request)
    {
        if (! Gate::allows('station_create')) {
            return abort(401);
        }
        $station = Station::create($request->all());



        return redirect()->route('admin.stations.index');
    }


    /**
     * Show the form for editing Station.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('station_edit')) {
            return abort(401);
        }
        
        $providers = \App\Provider::get()->pluck('provider', 'id')->prepend(trans('global.app_please_select'), '');

        $station = Station::findOrFail($id);

        return view('admin.stations.edit', compact('station', 'providers'));
    }

    /**
     * Update Station in storage.
     *
     * @param  \App\Http\Requests\UpdateStationsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStationsRequest $request, $id)
    {
        if (! Gate::allows('station_edit')) {
            return abort(401);
        }
        $station = Station::findOrFail($id);
        $station->update($request->all());



        return redirect()->route('admin.stations.index');
    }


    /**
     * Display Station.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('station_view')) {
            return abort(401);
        }
        
        $providers = \App\Provider::get()->pluck('provider', 'id')->prepend(trans('global.app_please_select'), '');$ad_responses = \App\AdResponse::where('station_id', $id)->get();

        $station = Station::findOrFail($id);

        return view('admin.stations.show', compact('station', 'ad_responses'));
    }


    /**
     * Remove Station from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('station_delete')) {
            return abort(401);
        }
        $station = Station::findOrFail($id);
        $station->delete();

        return redirect()->route('admin.stations.index');
    }

    /**
     * Delete all selected Station at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('station_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Station::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Station from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('station_delete')) {
            return abort(401);
        }
        $station = Station::onlyTrashed()->findOrFail($id);
        $station->restore();

        return redirect()->route('admin.stations.index');
    }

    /**
     * Permanently delete Station from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('station_delete')) {
            return abort(401);
        }
        $station = Station::onlyTrashed()->findOrFail($id);
        $station->forceDelete();

        return redirect()->route('admin.stations.index');
    }
}
