@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.templates.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.templates.fields.template-name')</th>
                            <td field-key='template_name'>{{ $template->template_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.templates.fields.content')</th>
                            <td field-key='content'>{!! $template->content !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.templates.fields.pages')</th>
                            <td field-key='pages'>
                                @foreach ($template->pages as $singlePages)
                                    <span class="label label-info label-many">{{ $singlePages->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.templates.fields.description')</th>
                            <td field-key='description'>{!! $template->description !!}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#stylesheet" aria-controls="stylesheet" role="tab" data-toggle="tab">Stylesheet</a></li>
<li role="presentation" class=""><a href="#layouts" aria-controls="layouts" role="tab" data-toggle="tab">Layouts</a></li>
<li role="presentation" class=""><a href="#bottom_scripts" aria-controls="bottom_scripts" role="tab" data-toggle="tab">Bottom Scripts</a></li>
<li role="presentation" class=""><a href="#top_scripts" aria-controls="top_scripts" role="tab" data-toggle="tab">Top scripts</a></li>
<li role="presentation" class=""><a href="#content_pages" aria-controls="content_pages" role="tab" data-toggle="tab">Pages</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="stylesheet">
<table class="table table-bordered table-striped {{ count($stylesheets) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.stylesheet.fields.link')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($stylesheets) > 0)
            @foreach ($stylesheets as $stylesheet)
                <tr data-entry-id="{{ $stylesheet->id }}">
                    <td field-key='link'>{{ $stylesheet->link }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['stylesheets.restore', $stylesheet->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['stylesheets.perma_del', $stylesheet->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('stylesheets.show',[$stylesheet->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('stylesheets.edit',[$stylesheet->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['stylesheets.destroy', $stylesheet->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="layouts">
<table class="table table-bordered table-striped {{ count($layouts) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.layouts.fields.layout')</th>
                        <th>@lang('global.layouts.fields.path')</th>
                        <th>@lang('global.layouts.fields.address')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($layouts) > 0)
            @foreach ($layouts as $layout)
                <tr data-entry-id="{{ $layout->id }}">
                    <td field-key='layout'>{{ $layout->layout }}</td>
                                <td field-key='path'>{{ $layout->path }}</td>
                                <td field-key='address'>{{ $layout->address }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['layouts.restore', $layout->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['layouts.perma_del', $layout->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('layouts.show',[$layout->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('layouts.edit',[$layout->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['layouts.destroy', $layout->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="bottom_scripts">
<table class="table table-bordered table-striped {{ count($bottom_scripts) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.bottom-scripts.fields.name')</th>
                        <th>@lang('global.bottom-scripts.fields.jquery')</th>
                        <th>@lang('global.bottom-scripts.fields.templates')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($bottom_scripts) > 0)
            @foreach ($bottom_scripts as $bottom_script)
                <tr data-entry-id="{{ $bottom_script->id }}">
                    <td field-key='name'>{{ $bottom_script->name }}</td>
                                <td field-key='jquery'>{{ Form::checkbox("jquery", 1, $bottom_script->jquery == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='templates'>
                                    @foreach ($bottom_script->templates as $singleTemplates)
                                        <span class="label label-info label-many">{{ $singleTemplates->template_name }}</span>
                                    @endforeach
                                </td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['bottom_scripts.restore', $bottom_script->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['bottom_scripts.perma_del', $bottom_script->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('bottom_scripts.show',[$bottom_script->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('bottom_scripts.edit',[$bottom_script->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['bottom_scripts.destroy', $bottom_script->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="top_scripts">
<table class="table table-bordered table-striped {{ count($top_scripts) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.top-scripts.fields.name')</th>
                        <th>@lang('global.top-scripts.fields.jquery')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($top_scripts) > 0)
            @foreach ($top_scripts as $top_script)
                <tr data-entry-id="{{ $top_script->id }}">
                    <td field-key='name'>{{ $top_script->name }}</td>
                                <td field-key='jquery'>{{ Form::checkbox("jquery", 1, $top_script->jquery == 1 ? true : false, ["disabled"]) }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['top_scripts.restore', $top_script->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['top_scripts.perma_del', $top_script->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('top_scripts.show',[$top_script->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('top_scripts.edit',[$top_script->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['top_scripts.destroy', $top_script->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="content_pages">
<table class="table table-bordered table-striped {{ count($content_pages) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.content-pages.fields.title')</th>
                        <th>@lang('global.content-pages.fields.category-id')</th>
                        <th>@lang('global.content-pages.fields.tag-id')</th>
                        <th>@lang('global.content-pages.fields.featured-image')</th>
                        <th>@lang('global.content-pages.fields.template')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($content_pages) > 0)
            @foreach ($content_pages as $content_page)
                <tr data-entry-id="{{ $content_page->id }}">
                    <td field-key='title'>{{ $content_page->title }}</td>
                                <td field-key='category_id'>
                                    @foreach ($content_page->category_id as $singleCategoryId)
                                        <span class="label label-info label-many">{{ $singleCategoryId->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='tag_id'>
                                    @foreach ($content_page->tag_id as $singleTagId)
                                        <span class="label label-info label-many">{{ $singleTagId->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='featured_image'>@if($content_page->featured_image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $content_page->featured_image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $content_page->featured_image) }}"/></a>@endif</td>
                                <td field-key='template'>{{ $content_page->template->template_name or '' }}</td>
                                                                <td>
                                    @can('view')
                                    <a href="{{ route('content_pages.show',[$content_page->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('content_pages.edit',[$content_page->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['content_pages.destroy', $content_page->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.templates.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
