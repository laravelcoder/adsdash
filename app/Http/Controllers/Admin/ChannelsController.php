<?php

namespace App\Http\Controllers\Admin;

use App\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreChannelsRequest;
use App\Http\Requests\Admin\UpdateChannelsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ChannelsController extends Controller
{
    /**
     * Display a listing of Channel.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('channel_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Channel::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('channel_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'channels.id',
                'channels.channel',
                'channels.channel_name',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'channel_';
                $routeKey = 'admin.channels';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('channel_name', function ($row) {
                return $row->channel_name ? $row->channel_name : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.channels.index');
    }

    /**
     * Show the form for creating new Channel.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('channel_create')) {
            return abort(401);
        }
        return view('admin.channels.create');
    }

    /**
     * Store a newly created Channel in storage.
     *
     * @param  \App\Http\Requests\StoreChannelsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChannelsRequest $request)
    {
        if (! Gate::allows('channel_create')) {
            return abort(401);
        }
        $channel = Channel::create($request->all());



        return redirect()->route('admin.channels.index');
    }


    /**
     * Show the form for editing Channel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('channel_edit')) {
            return abort(401);
        }
        $channel = Channel::findOrFail($id);

        return view('admin.channels.edit', compact('channel'));
    }

    /**
     * Update Channel in storage.
     *
     * @param  \App\Http\Requests\UpdateChannelsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChannelsRequest $request, $id)
    {
        if (! Gate::allows('channel_edit')) {
            return abort(401);
        }
        $channel = Channel::findOrFail($id);
        $channel->update($request->all());



        return redirect()->route('admin.channels.index');
    }


    /**
     * Display Channel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('channel_view')) {
            return abort(401);
        }
        $channel = Channel::findOrFail($id);

        return view('admin.channels.show', compact('channel'));
    }


    /**
     * Remove Channel from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('channel_delete')) {
            return abort(401);
        }
        $channel = Channel::findOrFail($id);
        $channel->delete();

        return redirect()->route('admin.channels.index');
    }

    /**
     * Delete all selected Channel at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('channel_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Channel::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Channel from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('channel_delete')) {
            return abort(401);
        }
        $channel = Channel::onlyTrashed()->findOrFail($id);
        $channel->restore();

        return redirect()->route('admin.channels.index');
    }

    /**
     * Permanently delete Channel from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('channel_delete')) {
            return abort(401);
        }
        $channel = Channel::onlyTrashed()->findOrFail($id);
        $channel->forceDelete();

        return redirect()->route('admin.channels.index');
    }
}
