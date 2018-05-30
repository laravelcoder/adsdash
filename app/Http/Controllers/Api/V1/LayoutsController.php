<?php

namespace App\Http\Controllers\Api\V1;

use App\Layout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLayoutsRequest;
use App\Http\Requests\Admin\UpdateLayoutsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class LayoutsController extends Controller
{
    public function index()
    {
        return Layout::all();
    }

    public function show($id)
    {
        return Layout::findOrFail($id);
    }

    public function update(UpdateLayoutsRequest $request, $id)
    {
        $layout = Layout::findOrFail($id);
        $layout->update($request->all());
        

        return $layout;
    }

    public function store(StoreLayoutsRequest $request)
    {
        $layout = Layout::create($request->all());
        

        return $layout;
    }

    public function destroy($id)
    {
        $layout = Layout::findOrFail($id);
        $layout->delete();
        return '';
    }
}
