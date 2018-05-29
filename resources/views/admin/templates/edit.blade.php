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
                    {!! Form::label('layout', trans('global.templates.fields.layout').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('layout', old('layout'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('layout'))
                        <p class="help-block">
                            {{ $errors->first('layout') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('global.templates.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('template_link', trans('global.templates.fields.template-link').'', ['class' => 'control-label']) !!}
                    {!! Form::text('template_link', old('template_link'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('template_link'))
                        <p class="help-block">
                            {{ $errors->first('template_link') }}
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
            Bottom Scripts
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('global.bottom-scripts.fields.script')</th>
                        <th>@lang('global.bottom-scripts.fields.name')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="bottom-scripts">
                    @forelse(old('bottom_scripts', []) as $index => $data)
                        @include('admin.templates.bottom_scripts_row', [
                            'index' => $index
                        ])
                    @empty
                        @foreach($template->bottom_scripts as $item)
                            @include('admin.templates.bottom_scripts_row', [
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

    <script type="text/html" id="bottom-scripts-template">
        @include('admin.templates.bottom_scripts_row',
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
@stop