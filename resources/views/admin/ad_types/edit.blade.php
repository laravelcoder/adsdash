@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.ad-types.title')</h3>
    
    {!! Form::model($ad_type, ['method' => 'PUT', 'route' => ['admin.ad_types.update', $ad_type->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('codec', trans('global.ad-types.fields.codec').'', ['class' => 'control-label']) !!}
                    {!! Form::text('codec', old('codec'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('codec'))
                        <p class="help-block">
                            {{ $errors->first('codec') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('extention', trans('global.ad-types.fields.extention').'', ['class' => 'control-label']) !!}
                    {!! Form::text('extention', old('extention'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('extention'))
                        <p class="help-block">
                            {{ $errors->first('extention') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ad_id', trans('global.ad-types.fields.ad').'', ['class' => 'control-label']) !!}
                    {!! Form::select('ad_id', $ads, old('ad_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ad_id'))
                        <p class="help-block">
                            {{ $errors->first('ad_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

