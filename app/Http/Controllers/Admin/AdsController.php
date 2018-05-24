<?php

namespace App\Http\Controllers\Admin;

use App\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
    /**
     * Display a listing of Ad.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('ad_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Ad.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Ad.filter', 'my');
            }
        }

        
        if (request()->ajax()) {
            $query = Ad::query();
            $query->with("created_by");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('ad_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'ads.id',
                'ads.link',
                'ads.ad_label',
                'ads.ad_type',
                'ads.created_by_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'ad_';
                $routeKey = 'admin.ads';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });
            $table->editColumn('ad_type', function ($row) {
                return $row->ad_type ? $row->ad_type : '';
            });
            $table->editColumn('created_by.name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.ads.index');
    }

    /**
     * Show the form for creating new Ad.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('ad_create')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.ads.create', compact('created_bies'));
    }

    /**
     * Store a newly created Ad in storage.
     *
     * @param  \App\Http\Requests\StoreAdsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdsRequest $request)
    {
        if (! Gate::allows('ad_create')) {
            return abort(401);
        }
        $ad = Ad::create($request->all());



        return redirect()->route('admin.ads.index');
    }


    /**
     * Show the form for editing Ad.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('ad_edit')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $ad = Ad::findOrFail($id);

        return view('admin.ads.edit', compact('ad', 'created_bies'));
    }

    /**
     * Update Ad in storage.
     *
     * @param  \App\Http\Requests\UpdateAdsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdsRequest $request, $id)
    {
        if (! Gate::allows('ad_edit')) {
            return abort(401);
        }
        $ad = Ad::findOrFail($id);
        $ad->update($request->all());



        return redirect()->route('admin.ads.index');
    }


    /**
     * Display Ad.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('ad_view')) {
            return abort(401);
        }
        $ad = Ad::findOrFail($id);

        return view('admin.ads.show', compact('ad'));
    }


    /**
     * Remove Ad from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('ad_delete')) {
            return abort(401);
        }
        $ad = Ad::findOrFail($id);
        $ad->delete();

        return redirect()->route('admin.ads.index');
    }

    /**
     * Delete all selected Ad at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('ad_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Ad::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Ad from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('ad_delete')) {
            return abort(401);
        }
        $ad = Ad::onlyTrashed()->findOrFail($id);
        $ad->restore();

        return redirect()->route('admin.ads.index');
    }

    /**
     * Permanently delete Ad from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('ad_delete')) {
            return abort(401);
        }
        $ad = Ad::onlyTrashed()->findOrFail($id);
        $ad->forceDelete();

        return redirect()->route('admin.ads.index');
    }
}
