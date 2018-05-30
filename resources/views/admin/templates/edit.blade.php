@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.templates.title')</h3>
    
    {!! Form::model($template, ['method' => 'PUT', 'route' => ['admin.templates.update', $template->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('template_name', trans('global.templates.fields.template-name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('template_name', old('template_name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('template_name'))
                        <p class="help-block">
                            {{ $errors->first('template_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('content', trans('global.templates.fields.content').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('content', old('content'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('content'))
                        <p class="help-block">
                            {{ $errors->first('content') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pages', trans('global.templates.fields.pages').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-pages">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-pages">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('pages[]', $pages, old('pages') ? old('pages') : $template->pages->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-pages' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pages'))
                        <p class="help-block">
                            {{ $errors->first('pages') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('global.templates.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Stylesheet
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('global.stylesheet.fields.link')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="stylesheet">
                    @forelse(old('stylesheets', []) as $index => $data)
                        @include('admin.templates.stylesheets_row', [
                            'index' => $index
                        ])
                    @empty
                        @foreach($template->stylesheets as $item)
                            @include('admin.templates.stylesheets_row', [
                                'index' => 'id-' . $item->id,
                                'field' => $item
                            ])
                        @endforeach
                    @endforelse
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('global.app_add_new')</a>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Layouts
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('global.layouts.fields.layout')</th>
                        <th>@lang('global.layouts.fields.path')</th>
                        <th>@lang('global.layouts.fields.address')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="layouts">
                    @forelse(old('layouts', []) as $index => $data)
                        @include('admin.templates.layouts_row', [
                            'index' => $index
                        ])
                    @empty
                        @foreach($template->layouts as $item)
                            @include('admin.templates.layouts_row', [
                                'index' => 'id-' . $item->id,
                                'field' => $item
                            ])
                        @endforeach
                    @endforelse
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('global.app_add_new')</a>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Top scripts
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('global.top-scripts.fields.name')</th>
                        <th>@lang('global.top-scripts.fields.script')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="top-scripts">
                    @forelse(old('top_scripts', []) as $index => $data)
                        @include('admin.templates.top_scripts_row', [
                            'index' => $index
                        ])
                    @empty
                        @foreach($template->top_scripts as $item)
                            @include('admin.templates.top_scripts_row', [
                                'index' => 'id-' . $item->id,
                                'field' => $item
                            ])
                        @endforeach
                    @endforelse
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('global.app_add_new')</a>
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="stylesheet-template">
        @include('admin.templates.stylesheets_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

    <script type="text/html" id="layouts-template">
        @include('admin.templates.layouts_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

    <script type="text/html" id="top-scripts-template">
        @include('admin.templates.top_scripts_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

            <script>
        $('.add-new').click(function () {
            var tableBody = $(this).parent().find('tbody');
            var template = $('#' + tableBody.attr('id') + '-template').html();
            var lastIndex = parseInt(tableBody.find('tr').last().data('index'));
            if (isNaN(lastIndex)) {
                lastIndex = 0;
            }
            tableBody.append(template.replace(/_INDEX_/g, lastIndex + 1));
            return false;
        });
        $(document).on('click', '.remove', function () {
            var row = $(this).parentsUntil('tr').parent();
            row.remove();
            return false;
        });
        </script>
    <script>
        $("#selectbtn-pages").click(function(){
            $("#selectall-pages > option").prop("selected","selected");
            $("#selectall-pages").trigger("change");
        });
        $("#deselectbtn-pages").click(function(){
            $("#selectall-pages > option").prop("selected","");
            $("#selectall-pages").trigger("change");
        });
    </script>
@stop