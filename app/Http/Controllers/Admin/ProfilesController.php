<?php

namespace App\Http\Controllers\Admin;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProfilesRequest;
use App\Http\Requests\Admin\UpdateProfilesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ProfilesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('profile_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Profile.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Profile.filter', 'my');
            }
        }

        
        if (request()->ajax()) {
            $query = Profile::query();
            $query->with("created_by");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('profile_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'profiles.id',
                'profiles.image',
                'profiles.created_by_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'profile_';
                $routeKey = 'admin.profiles';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('image', function ($row) {
                if($row->image) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->image) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->image) .'"/>'; };
            });
            $table->editColumn('created_by.name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions','massDelete','image']);

            return $table->make(true);
        }

        return view('admin.profiles.index');
    }

    /**
     * Show the form for creating new Profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('profile_create')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.profiles.create', compact('created_bies'));
    }

    /**
     * Store a newly created Profile in storage.
     *
     * @param  \App\Http\Requests\StoreProfilesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfilesRequest $request)
    {
        if (! Gate::allows('profile_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $profile = Profile::create($request->all());



        return redirect()->route('admin.profiles.index');
    }


    /**
     * Show the form for editing Profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('profile_edit')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $profile = Profile::findOrFail($id);

        return view('admin.profiles.edit', compact('profile', 'created_bies'));
    }

    /**
     * Update Profile in storage.
     *
     * @param  \App\Http\Requests\UpdateProfilesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfilesRequest $request, $id)
    {
        if (! Gate::allows('profile_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $profile = Profile::findOrFail($id);
        $profile->update($request->all());



        return redirect()->route('admin.profiles.index');
    }


    /**
     * Display Profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('profile_view')) {
            return abort(401);
        }
        $profile = Profile::findOrFail($id);

        return view('admin.profiles.show', compact('profile'));
    }


    /**
     * Remove Profile from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('profile_delete')) {
            return abort(401);
        }
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return redirect()->route('admin.profiles.index');
    }

    /**
     * Delete all selected Profile at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('profile_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Profile::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Profile from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('profile_delete')) {
            return abort(401);
        }
        $profile = Profile::onlyTrashed()->findOrFail($id);
        $profile->restore();

        return redirect()->route('admin.profiles.index');
    }

    /**
     * Permanently delete Profile from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('profile_delete')) {
            return abort(401);
        }
        $profile = Profile::onlyTrashed()->findOrFail($id);
        $profile->forceDelete();

        return redirect()->route('admin.profiles.index');
    }
}
