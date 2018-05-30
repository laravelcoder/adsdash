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
        $layouts           = $template->layouts;
        $currentLayoutData = [];
        foreach ($request->input('layouts', []) as $index => $data) {
            if (is_integer($index)) {
                $template->layouts()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentLayoutData[$id] = $data;
            }
        }
        foreach ($layouts as $item) {
            if (isset($currentLayoutData[$item->id])) {
                $item->update($currentLayoutData[$item->id]);
            } else {
                $item->delete();
            }
        }
        $bottomScripts           = $template->bottom_scripts;
        $currentBottomScriptData = [];
        foreach ($request->input('bottom_scripts', []) as $index => $data) {
            if (is_integer($index)) {
                $template->bottom_scripts()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentBottomScriptData[$id] = $data;
            }
        }
        foreach ($bottomScripts as $item) {
            if (isset($currentBottomScriptData[$item->id])) {
                $item->update($currentBottomScriptData[$item->id]);
            } else {
                $item->delete();
            }
        }
        $topScripts           = $template->top_scripts;
        $currentTopScriptData = [];
        foreach ($request->input('top_scripts', []) as $index => $data) {
            if (is_integer($index)) {
                $template->top_scripts()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentTopScriptData[$id] = $data;
            }
        }
        foreach ($topScripts as $item) {
            if (isset($currentTopScriptData[$item->id])) {
                $item->update($currentTopScriptData[$item->id]);
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
        foreach ($request->input('layouts', []) as $data) {
            $template->layouts()->create($data);
        }
        foreach ($request->input('bottom_scripts', []) as $data) {
            $template->bottom_scripts()->create($data);
        }
        foreach ($request->input('top_scripts', []) as $data) {
            $template->top_scripts()->create($data);
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
