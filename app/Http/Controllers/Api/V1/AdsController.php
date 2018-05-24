<?php

namespace App\Http\Controllers\Api\V1;

use App\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdsRequest;
use App\Http\Requests\Admin\UpdateAdsRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class AdsController extends Controller
{
    public function index()
    {
        return Ad::all();
    }

    public function show($id)
    {
        return Ad::findOrFail($id);
    }

    public function update(UpdateAdsRequest $request, $id)
    {
        $ad = Ad::findOrFail($id);
        $ad->update($request->all());
        
        $adTypes           = $ad->ad_types;
        $currentAdTypeData = [];
        foreach ($request->input('ad_types', []) as $index => $data) {
            if (is_integer($index)) {
                $ad->ad_types()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentAdTypeData[$id] = $data;
            }
        }
        foreach ($adTypes as $item) {
            if (isset($currentAdTypeData[$item->id])) {
                $item->update($currentAdTypeData[$item->id]);
            } else {
                $item->delete();
            }
        }

        return $ad;
    }

    public function store(StoreAdsRequest $request)
    {
        $ad = Ad::create($request->all());
        
        foreach ($request->input('ad_types', []) as $data) {
            $ad->ad_types()->create($data);
        }

        return $ad;
    }

    public function destroy($id)
    {
        $ad = Ad::findOrFail($id);
        $ad->delete();
        return '';
    }
}
