@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.channels.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.channels.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('channel', trans('global.channels.fields.channel').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('channel', old('channel'), ['class' => 'form-control', 'placeholder' => 'Enter the channel number', 'required' => '']) !!}
                    <p class="help-block">Enter the channel number</p>
                    @if($errors->has('channel'))
                        <p class="help-block">
                            {{ $errors->first('channel') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('channel_name', trans('global.channels.fields.channel-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('channel_name', old('channel_name'), ['class' => 'form-control', 'placeholder' => 'Enter the name of the channel', 'required' => '']) !!}
                    <p class="help-block">Enter the name of the channel</p>
                    @if($errors->has('channel_name'))
                        <p class="help-block">
                            {{ $errors->first('channel_name') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

