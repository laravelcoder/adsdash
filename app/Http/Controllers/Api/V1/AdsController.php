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
        
        $clipdbs           = $ad->clipdbs;
        $currentClipdbData = [];
        foreach ($request->input('clipdbs', []) as $index => $data) {
            if (is_integer($index)) {
                $ad->clipdbs()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentClipdbData[$id] = $data;
            }
        }
        foreach ($clipdbs as $item) {
            if (isset($currentClipdbData[$item->id])) {
                $item->update($currentClipdbData[$item->id]);
            } else {
                $item->delete();
            }
        }

        return $ad;
    }

    public function store(StoreAdsRequest $request)
    {
        $ad = Ad::create($request->all());
        
        foreach ($request->input('clipdbs', []) as $data) {
            $ad->clipdbs()->create($data);
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
