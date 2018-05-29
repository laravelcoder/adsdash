<?php

namespace App\Http\Controllers\Api\V1;

use App\TopScript;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTopScriptsRequest;
use App\Http\Requests\Admin\UpdateTopScriptsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TopScriptsController extends Controller
{
    public function index()
    {
        return TopScript::all();
    }

    public function show($id)
    {
        return TopScript::findOrFail($id);
    }

    public function update(UpdateTopScriptsRequest $request, $id)
    {
        $top_script = TopScript::findOrFail($id);
        $top_script->update($request->all());
        

        return $top_script;
    }

    public function store(StoreTopScriptsRequest $request)
    {
        $top_script = TopScript::create($request->all());
        

        return $top_script;
    }

    public function destroy($id)
    {
        $top_script = TopScript::findOrFail($id);
        $top_script->delete();
        return '';
    }
}
