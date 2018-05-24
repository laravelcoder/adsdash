@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.demographics.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.demographics.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('demographic', trans('global.demographics.fields.demographic').'', ['class' => 'control-label']) !!}
                    {!! Form::text('demographic', old('demographic'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('demographic'))
                        <p class="help-block">
                            {{ $errors->first('demographic') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('value', trans('global.demographics.fields.value').'', ['class' => 'control-label']) !!}
                    {!! Form::text('value', old('value'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('value'))
                        <p class="help-block">
                            {{ $errors->first('value') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

