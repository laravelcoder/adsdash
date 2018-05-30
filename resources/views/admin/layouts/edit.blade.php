@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.layouts.title')</h3>
    
    {!! Form::model($layout, ['method' => 'PUT', 'route' => ['admin.layouts.update', $layout->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('layout', trans('global.layouts.fields.layout').'', ['class' => 'control-label']) !!}
                    {!! Form::text('layout', old('layout'), ['class' => 'form-control', 'placeholder' => '']) !!}
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
                    {!! Form::label('path', trans('global.layouts.fields.path').'', ['class' => 'control-label']) !!}
                    {!! Form::text('path', old('path'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('path'))
                        <p class="help-block">
                            {{ $errors->first('path') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('address', trans('global.layouts.fields.address').'', ['class' => 'control-label']) !!}
                    {!! Form::text('address', old('address'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('address'))
                        <p class="help-block">
                            {{ $errors->first('address') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('template_id', trans('global.layouts.fields.template').'', ['class' => 'control-label']) !!}
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

