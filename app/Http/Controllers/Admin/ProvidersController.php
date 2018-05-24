<?php

namespace App\Http\Controllers\Admin;

use App\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProvidersRequest;
use App\Http\Requests\Admin\UpdateProvidersRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ProvidersController extends Controller
{
    /**
     * Display a listing of Provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('provider_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Provider.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Provider.filter', 'my');
            }
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Provider.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Provider.filter', 'my');
            }
        }

        
        if (request()->ajax()) {
            $query = Provider::query();
            $query->with("created_by");
            $query->with("created_by_team");
            $query->with("network_affiliate");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('provider_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'providers.id',
                'providers.provider',
                'providers.created_by_id',
                'providers.created_by_team_id',
                'providers.network_affiliate_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'provider_';
                $routeKey = 'admin.providers';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('created_by.name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });
            $table->editColumn('created_by_team.name', function ($row) {
                return $row->created_by_team ? $row->created_by_team->name : '';
            });
            $table->editColumn('network_affiliate.network_affiliate', function ($row) {
                return $row->network_affiliate ? $row->network_affiliate->network_affiliate : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.providers.index');
    }

    /**
     * Show the form for creating new Provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('provider_create')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $network_affiliates = \App\Network::get()->pluck('network_affiliate', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.providers.create', compact('created_bies', 'created_by_teams', 'network_affiliates'));
    }

    /**
     * Store a newly created Provider in storage.
     *
     * @param  \App\Http\Requests\StoreProvidersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProvidersRequest $request)
    {
        if (! Gate::allows('provider_create')) {
            return abort(401);
        }
        $provider = Provider::create($request->all());

        foreach ($request->input('stations', []) as $data) {
            $provider->stations()->create($data);
        }


        return redirect()->route('admin.providers.index');
    }


    /**
     * Show the form for editing Provider.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('provider_edit')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $network_affiliates = \App\Network::get()->pluck('network_affiliate', 'id')->prepend(trans('global.app_please_select'), '');

        $provider = Provider::findOrFail($id);

        return view('admin.providers.edit', compact('provider', 'created_bies', 'created_by_teams', 'network_affiliates'));
    }

    /**
     * Update Provider in storage.
     *
     * @param  \App\Http\Requests\UpdateProvidersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProvidersRequest $request, $id)
    {
        if (! Gate::allows('provider_edit')) {
            return abort(401);
        }
        $provider = Provider::findOrFail($id);
        $provider->update($request->all());

        $stations           = $provider->stations;
        $currentStationData = [];
        foreach ($request->input('stations', []) as $index => $data) {
            if (is_integer($index)) {
                $provider->stations()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentStationData[$id] = $data;
            }
        }
        foreach ($stations as $item) {
            if (isset($currentStationData[$item->id])) {
                $item->update($currentStationData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.providers.index');
    }


    /**
     * Display Provider.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('provider_view')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $network_affiliates = \App\Network::get()->pluck('network_affiliate', 'id')->prepend(trans('global.app_please_select'), '');$stations = \App\Station::where('provider_id', $id)->get();$networks = \App\Network::whereHas('provider',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $provider = Provider::findOrFail($id);

        return view('admin.providers.show', compact('provider', 'stations', 'networks'));
    }


    /**
     * Remove Provider from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('provider_delete')) {
            return abort(401);
        }
        $provider = Provider::findOrFail($id);
        $provider->delete();

        return redirect()->route('admin.providers.index');
    }

    /**
     * Delete all selected Provider at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('provider_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Provider::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Provider from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('provider_delete')) {
            return abort(401);
        }
        $provider = Provider::onlyTrashed()->findOrFail($id);
        $provider->restore();

        return redirect()->route('admin.providers.index');
    }

    /**
     * Permanently delete Provider from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('provider_delete')) {
            return abort(401);
        }
        $provider = Provider::onlyTrashed()->findOrFail($id);
        $provider->forceDelete();

        return redirect()->route('admin.providers.index');
    }
}
