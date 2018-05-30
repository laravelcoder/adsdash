@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.clipdb.title')</h3>
    
    {!! Form::model($clipdb, ['method' => 'PUT', 'route' => ['admin.clipdbs.update', $clipdb->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('clip_label', trans('global.clipdb.fields.clip-label').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('clip_label', old('clip_label'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('clip_label'))
                        <p class="help-block">
                            {{ $errors->first('clip_label') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

