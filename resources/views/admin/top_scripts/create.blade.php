@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.top-scripts.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.top_scripts.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('global.top-scripts.fields.name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('script', trans('global.top-scripts.fields.script').'', ['class' => 'control-label']) !!}
                    {!! Form::text('script', old('script'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('script'))
                        <p class="help-block">
                            {{ $errors->first('script') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('jquery', trans('global.top-scripts.fields.jquery').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('jquery', 0) !!}
                    {!! Form::checkbox('jquery', 1, old('jquery', true), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('jquery'))
                        <p class="help-block">
                            {{ $errors->first('jquery') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('template_id', trans('global.top-scripts.fields.template').'', ['class' => 'control-label']) !!}
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

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

