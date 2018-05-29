<?php

namespace App\Http\Controllers\Api\V1;

use App\Stylesheet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStylesheetsRequest;
use App\Http\Requests\Admin\UpdateStylesheetsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class StylesheetsController extends Controller
{
    public function index()
    {
        return Stylesheet::all();
    }

    public function show($id)
    {
        return Stylesheet::findOrFail($id);
    }

    public function update(UpdateStylesheetsRequest $request, $id)
    {
        $stylesheet = Stylesheet::findOrFail($id);
        $stylesheet->update($request->all());
        

        return $stylesheet;
    }

    public function store(StoreStylesheetsRequest $request)
    {
        $stylesheet = Stylesheet::create($request->all());
        

        return $stylesheet;
    }

    public function destroy($id)
    {
        $stylesheet = Stylesheet::findOrFail($id);
        $stylesheet->delete();
        return '';
    }
}
