<?php

namespace App\Http\Controllers\Api\V1;

use App\AdType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdTypesRequest;
use App\Http\Requests\Admin\UpdateAdTypesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class AdTypesController extends Controller
{
    public function index()
    {
        return AdType::all();
    }

    public function show($id)
    {
        return AdType::findOrFail($id);
    }

    public function update(UpdateAdTypesRequest $request, $id)
    {
        $ad_type = AdType::findOrFail($id);
        $ad_type->update($request->all());
        

        return $ad_type;
    }

    public function store(StoreAdTypesRequest $request)
    {
        $ad_type = AdType::create($request->all());
        

        return $ad_type;
    }

    public function destroy($id)
    {
        $ad_type = AdType::findOrFail($id);
        $ad_type->delete();
        return '';
    }
}
