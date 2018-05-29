<?php

namespace App\Http\Controllers\Api\V1;

use App\Variable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVariablesRequest;
use App\Http\Requests\Admin\UpdateVariablesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class VariablesController extends Controller
{
    public function index()
    {
        return Variable::all();
    }

    public function show($id)
    {
        return Variable::findOrFail($id);
    }

    public function update(UpdateVariablesRequest $request, $id)
    {
        $variable = Variable::findOrFail($id);
        $variable->update($request->all());
        

        return $variable;
    }

    public function store(StoreVariablesRequest $request)
    {
        $variable = Variable::create($request->all());
        

        return $variable;
    }

    public function destroy($id)
    {
        $variable = Variable::findOrFail($id);
        $variable->delete();
        return '';
    }
}
