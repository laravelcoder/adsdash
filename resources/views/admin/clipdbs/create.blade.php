@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.clipdb.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.clipdbs.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ad_id', trans('global.clipdb.fields.ad').'', ['class' => 'control-label']) !!}
                    {!! Form::select('ad_id', $ads, old('ad_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ad_id'))
                        <p class="help-block">
                            {{ $errors->first('ad_id') }}
                        </p>
                    @endif
                </div>
            </div>
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
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('link_to_clip', trans('global.clipdb.fields.link-to-clip').'', ['class' => 'control-label']) !!}
                    {!! Form::text('link_to_clip', old('link_to_clip'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('link_to_clip'))
                        <p class="help-block">
                            {{ $errors->first('link_to_clip') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('video_upload', trans('global.clipdb.fields.video-upload').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('video_upload', old('video_upload')) !!}
                    {!! Form::file('video_upload', ['class' => 'form-control']) !!}
                    {!! Form::hidden('video_upload_max_size', 32) !!}
                    <p class="help-block"></p>
                    @if($errors->has('video_upload'))
                        <p class="help-block">
                            {{ $errors->first('video_upload') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('image_upload', trans('global.clipdb.fields.image-upload').'', ['class' => 'control-label']) !!}
                    {!! Form::file('image_upload', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('image_upload_max_size', 2) !!}
                    {!! Form::hidden('image_upload_max_width', 4096) !!}
                    {!! Form::hidden('image_upload_max_height', 4096) !!}
                    <p class="help-block"></p>
                    @if($errors->has('image_upload'))
                        <p class="help-block">
                            {{ $errors->first('image_upload') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
