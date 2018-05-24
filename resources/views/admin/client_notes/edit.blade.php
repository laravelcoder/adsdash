@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.client-notes.title')</h3>
    
    {!! Form::model($client_note, ['method' => 'PUT', 'route' => ['admin.client_notes.update', $client_note->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('project_id', trans('global.client-notes.fields.project').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('project_id', $projects, old('project_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('project_id'))
                        <p class="help-block">
                            {{ $errors->first('project_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('text', trans('global.client-notes.fields.text').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('text', old('text'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('text'))
                        <p class="help-block">
                            {{ $errors->first('text') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

