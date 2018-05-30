<?php

namespace App\Http\Controllers\Api\V1;

use App\AdResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdResponsesRequest;
use App\Http\Requests\Admin\UpdateAdResponsesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class AdResponsesController extends Controller
{
    public function index()
    {
        return AdResponse::all();
    }

    public function show($id)
    {
        return AdResponse::findOrFail($id);
    }

    public function update(UpdateAdResponsesRequest $request, $id)
    {
        $ad_response = AdResponse::findOrFail($id);
        $ad_response->update($request->all());
        

        return $ad_response;
    }

    public function store(StoreAdResponsesRequest $request)
    {
        $ad_response = AdResponse::create($request->all());
        

        return $ad_response;
    }

    public function destroy($id)
    {
        $ad_response = AdResponse::findOrFail($id);
        $ad_response->delete();
        return '';
    }
}
