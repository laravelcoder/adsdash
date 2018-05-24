<?php

namespace App\Http\Controllers\Api\V1;

use App\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreChannelsRequest;
use App\Http\Requests\Admin\UpdateChannelsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ChannelsController extends Controller
{
    public function index()
    {
        return Channel::all();
    }

    public function show($id)
    {
        return Channel::findOrFail($id);
    }

    public function update(UpdateChannelsRequest $request, $id)
    {
        $channel = Channel::findOrFail($id);
        $channel->update($request->all());
        

        return $channel;
    }

    public function store(StoreChannelsRequest $request)
    {
        $channel = Channel::create($request->all());
        

        return $channel;
    }

    public function destroy($id)
    {
        $channel = Channel::findOrFail($id);
        $channel->delete();
        return '';
    }
}
