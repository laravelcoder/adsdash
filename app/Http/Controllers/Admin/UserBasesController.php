<?php

namespace App\Http\Controllers\Admin;

use App\UserBase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserBasesRequest;
use App\Http\Requests\Admin\UpdateUserBasesRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class UserBasesController extends Controller
{
    /**
     * Display a listing of UserBase.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('user_base_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('UserBase.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('UserBase.filter', 'my');
            }
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('UserBase.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('UserBase.filter', 'my');
            }
        }

        
        if (request()->ajax()) {
            $query = UserBase::query();
            $query->with("created_by");
            $query->with("created_by_team");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('user_base_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'user_bases.id',
                'user_bases.name',
                'user_bases.value',
                'user_bases.created_by_id',
                'user_bases.created_by_team_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'user_base_';
                $routeKey = 'admin.user_bases';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('value', function ($row) {
                return $row->value ? $row->value : '';
            });
            $table->editColumn('created_by.name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });
            $table->editColumn('created_by_team.name', function ($row) {
                return $row->created_by_team ? $row->created_by_team->name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.user_bases.index');
    }

    /**
     * Show the form for creating new UserBase.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('user_base_create')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.user_bases.create', compact('created_bies', 'created_by_teams'));
    }

    /**
     * Store a newly created UserBase in storage.
     *
     * @param  \App\Http\Requests\StoreUserBasesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserBasesRequest $request)
    {
        if (! Gate::allows('user_base_create')) {
            return abort(401);
        }
        $user_base = UserBase::create($request->all());



        return redirect()->route('admin.user_bases.index');
    }


    /**
     * Show the form for editing UserBase.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('user_base_edit')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $user_base = UserBase::findOrFail($id);

        return view('admin.user_bases.edit', compact('user_base', 'created_bies', 'created_by_teams'));
    }

    /**
     * Update UserBase in storage.
     *
     * @param  \App\Http\Requests\UpdateUserBasesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserBasesRequest $request, $id)
    {
        if (! Gate::allows('user_base_edit')) {
            return abort(401);
        }
        $user_base = UserBase::findOrFail($id);
        $user_base->update($request->all());



        return redirect()->route('admin.user_bases.index');
    }


    /**
     * Display UserBase.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('user_base_view')) {
            return abort(401);
        }
        $user_base = UserBase::findOrFail($id);

        return view('admin.user_bases.show', compact('user_base'));
    }


    /**
     * Remove UserBase from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('user_base_delete')) {
            return abort(401);
        }
        $user_base = UserBase::findOrFail($id);
        $user_base->delete();

        return redirect()->route('admin.user_bases.index');
    }

    /**
     * Delete all selected UserBase at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('user_base_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = UserBase::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore UserBase from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('user_base_delete')) {
            return abort(401);
        }
        $user_base = UserBase::onlyTrashed()->findOrFail($id);
        $user_base->restore();

        return redirect()->route('admin.user_bases.index');
    }

    /**
     * Permanently delete UserBase from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('user_base_delete')) {
            return abort(401);
        }
        $user_base = UserBase::onlyTrashed()->findOrFail($id);
        $user_base->forceDelete();

        return redirect()->route('admin.user_bases.index');
    }
}
