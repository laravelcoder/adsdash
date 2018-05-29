<?php

namespace App\Http\Controllers\Api\V1;

use App\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAgentsRequest;
use App\Http\Requests\Admin\UpdateAgentsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class AgentsController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Agent::all();
    }

    public function show($id)
    {
        return Agent::findOrFail($id);
    }

    public function update(UpdateAgentsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $agent = Agent::findOrFail($id);
        $agent->update($request->all());
        

        return $agent;
    }

    public function store(StoreAgentsRequest $request)
    {
        $request = $this->saveFiles($request);
        $agent = Agent::create($request->all());
        

        return $agent;
    }

    public function destroy($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->delete();
        return '';
    }
}
