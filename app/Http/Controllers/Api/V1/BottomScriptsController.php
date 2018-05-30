<?php

namespace App\Http\Controllers\Api\V1;

use App\BottomScript;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBottomScriptsRequest;
use App\Http\Requests\Admin\UpdateBottomScriptsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class BottomScriptsController extends Controller
{
    public function index()
    {
        return BottomScript::all();
    }

    public function show($id)
    {
        return BottomScript::findOrFail($id);
    }

    public function update(UpdateBottomScriptsRequest $request, $id)
    {
        $bottom_script = BottomScript::findOrFail($id);
        $bottom_script->update($request->all());
        

        return $bottom_script;
    }

    public function store(StoreBottomScriptsRequest $request)
    {
        $bottom_script = BottomScript::create($request->all());
        

        return $bottom_script;
    }

    public function destroy($id)
    {
        $bottom_script = BottomScript::findOrFail($id);
        $bottom_script->delete();
        return '';
    }
}
