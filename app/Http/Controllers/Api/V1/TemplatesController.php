<?php

namespace App\Http\Controllers\Api\V1;

use App\Template;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTemplatesRequest;
use App\Http\Requests\Admin\UpdateTemplatesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TemplatesController extends Controller
{
    public function index()
    {
        return Template::all();
    }

    public function show($id)
    {
        return Template::findOrFail($id);
    }

    public function update(UpdateTemplatesRequest $request, $id)
    {
        $template = Template::findOrFail($id);
        $template->update($request->all());
        
        $stylesheets           = $template->stylesheets;
        $currentStylesheetData = [];
        foreach ($request->input('stylesheets', []) as $index => $data) {
            if (is_integer($index)) {
                $template->stylesheets()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentStylesheetData[$id] = $data;
            }
        }
        foreach ($stylesheets as $item) {
            if (isset($currentStylesheetData[$item->id])) {
                $item->update($currentStylesheetData[$item->id]);
            } else {
                $item->delete();
            }
        }
        $javascripts           = $template->javascripts;
        $currentJavascriptData = [];
        foreach ($request->input('javascripts', []) as $index => $data) {
            if (is_integer($index)) {
                $template->javascripts()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentJavascriptData[$id] = $data;
            }
        }
        foreach ($javascripts as $item) {
            if (isset($currentJavascriptData[$item->id])) {
                $item->update($currentJavascriptData[$item->id]);
            } else {
                $item->delete();
            }
        }

        return $template;
    }

    public function store(StoreTemplatesRequest $request)
    {
        $template = Template::create($request->all());
        
        foreach ($request->input('stylesheets', []) as $data) {
            $template->stylesheets()->create($data);
        }
        foreach ($request->input('javascripts', []) as $data) {
            $template->javascripts()->create($data);
        }

        return $template;
    }

    public function destroy($id)
    {
        $template = Template::findOrFail($id);
        $template->delete();
        return '';
    }
}
