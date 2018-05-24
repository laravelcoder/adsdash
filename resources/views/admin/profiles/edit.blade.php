@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.profiles.title')</h3>
    
    {!! Form::model($profile, ['method' => 'PUT', 'route' => ['admin.profiles.update', $profile->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    @if ($profile->image)
                        <a href="{{ asset(env('UPLOAD_PATH').'/'.$profile->image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/'.$profile->image) }}"></a>
                    @endif
                    {!! Form::label('image', trans('global.profiles.fields.image').'', ['class' => 'control-label']) !!}
                    {!! Form::file('image', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('image_max_size', 2) !!}
                    {!! Form::hidden('image_max_width', 4096) !!}
                    {!! Form::hidden('image_max_height', 4096) !!}
                    <p class="help-block"></p>
                    @if($errors->has('image'))
                        <p class="help-block">
                            {{ $errors->first('image') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

