@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.stylesheet.title')</h3>
    
    {!! Form::model($stylesheet, ['method' => 'PUT', 'route' => ['admin.stylesheets.update', $stylesheet->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('link', trans('global.stylesheet.fields.link').'', ['class' => 'control-label']) !!}
                    {!! Form::text('link', old('link'), ['class' => 'form-control', 'placeholder' => 'add stylesheets here to add them to the page.']) !!}
                    <p class="help-block">add stylesheets here to add them to the page.</p>
                    @if($errors->has('link'))
                        <p class="help-block">
                            {{ $errors->first('link') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('template_id', trans('global.stylesheet.fields.template').'', ['class' => 'control-label']) !!}
                    {!! Form::select('template_id', $templates, old('template_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('template_id'))
                        <p class="help-block">
                            {{ $errors->first('template_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

