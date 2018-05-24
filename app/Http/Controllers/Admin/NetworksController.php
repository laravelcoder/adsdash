<?php

namespace App\Http\Controllers\Admin;

use App\Network;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNetworksRequest;
use App\Http\Requests\Admin\UpdateNetworksRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class NetworksController extends Controller
{
    /**
     * Display a listing of Network.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('network_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Network::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('network_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'networks.id',
                'networks.network',
                'networks.network_affiliate',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'network_';
                $routeKey = 'admin.networks';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('network', function ($row) {
                return $row->network ? $row->network : '';
            });
            $table->editColumn('network_affiliate', function ($row) {
                return $row->network_affiliate ? $row->network_affiliate : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.networks.index');
    }

    /**
     * Show the form for creating new Network.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('network_create')) {
            return abort(401);
        }
        return view('admin.networks.create');
    }

    /**
     * Store a newly created Network in storage.
     *
     * @param  \App\Http\Requests\StoreNetworksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNetworksRequest $request)
    {
        if (! Gate::allows('network_create')) {
            return abort(401);
        }
        $network = Network::create($request->all());

        foreach ($request->input('providers', []) as $data) {
            $network->providers()->create($data);
        }


        return redirect()->route('admin.networks.index');
    }


    /**
     * Show the form for editing Network.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('network_edit')) {
            return abort(401);
        }
        $network = Network::findOrFail($id);

        return view('admin.networks.edit', compact('network'));
    }

    /**
     * Update Network in storage.
     *
     * @param  \App\Http\Requests\UpdateNetworksRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNetworksRequest $request, $id)
    {
        if (! Gate::allows('network_edit')) {
            return abort(401);
        }
        $network = Network::findOrFail($id);
        $network->update($request->all());

        $providers           = $network->providers;
        $currentProviderData = [];
        foreach ($request->input('providers', []) as $index => $data) {
            if (is_integer($index)) {
                $network->providers()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentProviderData[$id] = $data;
            }
        }
        foreach ($providers as $item) {
            if (isset($currentProviderData[$item->id])) {
                $item->update($currentProviderData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.networks.index');
    }


    /**
     * Display Network.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('network_view')) {
            return abort(401);
        }
        $providers = \App\Provider::where('network_affiliate_id', $id)->get();

        $network = Network::findOrFail($id);

        return view('admin.networks.show', compact('network', 'providers'));
    }


    /**
     * Remove Network from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('network_delete')) {
            return abort(401);
        }
        $network = Network::findOrFail($id);
        $network->delete();

        return redirect()->route('admin.networks.index');
    }

    /**
     * Delete all selected Network at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('network_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Network::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Network from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('network_delete')) {
            return abort(401);
        }
        $network = Network::onlyTrashed()->findOrFail($id);
        $network->restore();

        return redirect()->route('admin.networks.index');
    }

    /**
     * Permanently delete Network from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('network_delete')) {
            return abort(401);
        }
        $network = Network::onlyTrashed()->findOrFail($id);
        $network->forceDelete();

        return redirect()->route('admin.networks.index');
    }
}
