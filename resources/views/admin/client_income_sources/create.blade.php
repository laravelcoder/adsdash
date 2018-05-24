@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.client-income-sources.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.client_income_sources.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('global.client-income-sources.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('fee_percent', trans('global.client-income-sources.fields.fee-percent').'', ['class' => 'control-label']) !!}
                    {!! Form::text('fee_percent', old('fee_percent'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('fee_percent'))
                        <p class="help-block">
                            {{ $errors->first('fee_percent') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

