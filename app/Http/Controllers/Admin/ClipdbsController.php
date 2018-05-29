<?php

namespace App\Http\Controllers\Admin;

use App\Clipdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClipdbsRequest;
use App\Http\Requests\Admin\UpdateClipdbsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClipdbsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Clipdb.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('clipdb_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Clipdb.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Clipdb.filter', 'my');
            }
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Clipdb.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Clipdb.filter', 'my');
            }
        }

        
        if (request()->ajax()) {
            $query = Clipdb::query();
            $query->with("ad");
            $query->with("created_by");
            $query->with("created_by_team");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('clipdb_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'clipdbs.id',
                'clipdbs.ad_id',
                'clipdbs.clip_label',
                'clipdbs.link_to_clip',
                'clipdbs.video_upload',
                'clipdbs.image_upload',
                'clipdbs.created_by_id',
                'clipdbs.created_by_team_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'clipdb_';
                $routeKey = 'admin.clipdbs';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('ad.ad_label', function ($row) {
                return $row->ad ? $row->ad->ad_label : '';
            });
            $table->editColumn('clip_label', function ($row) {
                return $row->clip_label ? $row->clip_label : '';
            });
            $table->editColumn('link_to_clip', function ($row) {
                return $row->link_to_clip ? $row->link_to_clip : '';
            });
            $table->editColumn('video_upload', function ($row) {
                if($row->video_upload) { return '<a href="'.asset(env('UPLOAD_PATH').'/'.$row->video_upload) .'" target="_blank">Download file</a>'; };
            });
            $table->editColumn('image_upload', function ($row) {
                if($row->image_upload) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->image_upload) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->image_upload) .'"/>'; };
            });
            $table->editColumn('created_by.name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });
            $table->editColumn('created_by_team.name', function ($row) {
                return $row->created_by_team ? $row->created_by_team->name : '';
            });

            $table->rawColumns(['actions','massDelete','video_upload','image_upload']);

            return $table->make(true);
        }

        return view('admin.clipdbs.index');
    }

    /**
     * Show the form for creating new Clipdb.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('clipdb_create')) {
            return abort(401);
        }
        
        $ads = \App\Ad::get()->pluck('ad_label', 'id')->prepend(trans('global.app_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.clipdbs.create', compact('ads', 'created_bies', 'created_by_teams'));
    }

    /**
     * Store a newly created Clipdb in storage.
     *
     * @param  \App\Http\Requests\StoreClipdbsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClipdbsRequest $request)
    {
        if (! Gate::allows('clipdb_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $clipdb = Clipdb::create($request->all());



        return redirect()->route('admin.clipdbs.index');
    }


    /**
     * Show the form for editing Clipdb.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('clipdb_edit')) {
            return abort(401);
        }
        
        $ads = \App\Ad::get()->pluck('ad_label', 'id')->prepend(trans('global.app_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $clipdb = Clipdb::findOrFail($id);

        return view('admin.clipdbs.edit', compact('clipdb', 'ads', 'created_bies', 'created_by_teams'));
    }

    /**
     * Update Clipdb in storage.
     *
     * @param  \App\Http\Requests\UpdateClipdbsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClipdbsRequest $request, $id)
    {
        if (! Gate::allows('clipdb_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $clipdb = Clipdb::findOrFail($id);
        $clipdb->update($request->all());



        return redirect()->route('admin.clipdbs.index');
    }


    /**
     * Display Clipdb.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('clipdb_view')) {
            return abort(401);
        }
        $clipdb = Clipdb::findOrFail($id);

        return view('admin.clipdbs.show', compact('clipdb'));
    }


    /**
     * Remove Clipdb from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('clipdb_delete')) {
            return abort(401);
        }
        $clipdb = Clipdb::findOrFail($id);
        $clipdb->delete();

        return redirect()->route('admin.clipdbs.index');
    }

    /**
     * Delete all selected Clipdb at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('clipdb_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Clipdb::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Clipdb from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('clipdb_delete')) {
            return abort(401);
        }
        $clipdb = Clipdb::onlyTrashed()->findOrFail($id);
        $clipdb->restore();

        return redirect()->route('admin.clipdbs.index');
    }

    /**
     * Permanently delete Clipdb from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('clipdb_delete')) {
            return abort(401);
        }
        $clipdb = Clipdb::onlyTrashed()->findOrFail($id);
        $clipdb->forceDelete();

        return redirect()->route('admin.clipdbs.index');
    }
}
