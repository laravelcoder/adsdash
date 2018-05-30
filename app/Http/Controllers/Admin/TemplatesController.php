<?php

namespace App\Http\Controllers\Admin;

use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTemplatesRequest;
use App\Http\Requests\Admin\UpdateTemplatesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TemplatesController extends Controller
{
    /**
     * Display a listing of Template.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('template_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Template::query();
            $query->with("pages");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('template_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'templates.id',
                'templates.template_name',
                'templates.content',
                'templates.description',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'template_';
                $routeKey = 'admin.templates';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('template_name', function ($row) {
                return $row->template_name ? $row->template_name : '';
            });
            $table->editColumn('content', function ($row) {
                return $row->content ? $row->content : '';
            });
            $table->editColumn('pages.title', function ($row) {
                if(count($row->pages) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->pages->pluck('title')->toArray()) . '</span>';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->rawColumns(['actions','massDelete','pages.title']);

            return $table->make(true);
        }

        return view('admin.templates.index');
    }

    /**
     * Show the form for creating new Template.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('template_create')) {
            return abort(401);
        }
        
        $pages = \App\ContentPage::get()->pluck('title', 'id');


        return view('admin.templates.create', compact('pages'));
    }

    /**
     * Store a newly created Template in storage.
     *
     * @param  \App\Http\Requests\StoreTemplatesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTemplatesRequest $request)
    {
        if (! Gate::allows('template_create')) {
            return abort(401);
        }
        $template = Template::create($request->all());
        $template->pages()->sync(array_filter((array)$request->input('pages')));

        foreach ($request->input('stylesheets', []) as $data) {
            $template->stylesheets()->create($data);
        }
        foreach ($request->input('layouts', []) as $data) {
            $template->layouts()->create($data);
        }
        foreach ($request->input('top_scripts', []) as $data) {
            $template->top_scripts()->create($data);
        }


        return redirect()->route('admin.templates.index');
    }


    /**
     * Show the form for editing Template.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('template_edit')) {
            return abort(401);
        }
        
        $pages = \App\ContentPage::get()->pluck('title', 'id');


        $template = Template::findOrFail($id);

        return view('admin.templates.edit', compact('template', 'pages'));
    }

    /**
     * Update Template in storage.
     *
     * @param  \App\Http\Requests\UpdateTemplatesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTemplatesRequest $request, $id)
    {
        if (! Gate::allows('template_edit')) {
            return abort(401);
        }
        $template = Template::findOrFail($id);
        $template->update($request->all());
        $template->pages()->sync(array_filter((array)$request->input('pages')));

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


        return redirect()->route('admin.templates.index');
    }


    /**
     * Display Template.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('template_view')) {
            return abort(401);
        }
        
        $pages = \App\ContentPage::get()->pluck('title', 'id');
$stylesheets = \App\Stylesheet::where('template_id', $id)->get();$layouts = \App\Layout::where('template_id', $id)->get();$bottom_scripts = \App\BottomScript::whereHas('templates',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$top_scripts = \App\TopScript::where('template_id', $id)->get();$content_pages = \App\ContentPage::where('template_id', $id)->get();

        $template = Template::findOrFail($id);

        return view('admin.templates.show', compact('template', 'stylesheets', 'layouts', 'bottom_scripts', 'top_scripts', 'content_pages'));
    }


    /**
     * Remove Template from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('template_delete')) {
            return abort(401);
        }
        $template = Template::findOrFail($id);
        $template->delete();

        return redirect()->route('admin.templates.index');
    }

    /**
     * Delete all selected Template at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('template_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Template::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Template from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('template_delete')) {
            return abort(401);
        }
        $template = Template::onlyTrashed()->findOrFail($id);
        $template->restore();

        return redirect()->route('admin.templates.index');
    }

    /**
     * Permanently delete Template from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('template_delete')) {
            return abort(401);
        }
        $template = Template::onlyTrashed()->findOrFail($id);
        $template->forceDelete();

        return redirect()->route('admin.templates.index');
    }
}
