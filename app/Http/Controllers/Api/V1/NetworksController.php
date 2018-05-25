<?php

namespace App\Http\Controllers\Api\V1;

use App\Network;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNetworksRequest;
use App\Http\Requests\Admin\UpdateNetworksRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class NetworksController extends Controller
{
    public function index()
    {
        return Network::all();
    }

    public function show($id)
    {
        return Network::findOrFail($id);
    }

    public function update(UpdateNetworksRequest $request, $id)
    {
        $network = Network::findOrFail($id);
        $network->update($request->all());
        

        return $network;
    }

    public function store(StoreNetworksRequest $request)
    {
        $network = Network::create($request->all());
        

        return $network;
    }

    public function destroy($id)
    {
        $network = Network::findOrFail($id);
        $network->delete();
        return '';
    }
}
