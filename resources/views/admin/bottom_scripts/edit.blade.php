@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.bottom-scripts.title')</h3>
    
    {!! Form::model($bottom_script, ['method' => 'PUT', 'route' => ['admin.bottom_scripts.update', $bottom_script->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('script', trans('global.bottom-scripts.fields.script').'', ['class' => 'control-label']) !!}
                    {!! Form::text('script', old('script'), ['class' => 'form-control', 'placeholder' => 'Only add the file name the the path']) !!}
                    <p class="help-block">Only add the file name the the path</p>
                    @if($errors->has('script'))
                        <p class="help-block">
                            {{ $errors->first('script') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('global.bottom-scripts.fields.name').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('jquery', trans('global.bottom-scripts.fields.jquery').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('jquery', 0) !!}
                    {!! Form::checkbox('jquery', 1, old('jquery', old('jquery')), []) !!}
                    <p class="help-block">check this if query has to be loaded already</p>
                    @if($errors->has('jquery'))
                        <p class="help-block">
                            {{ $errors->first('jquery') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pages', trans('global.bottom-scripts.fields.pages').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-pages">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-pages">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('pages[]', $pages, old('pages') ? old('pages') : $bottom_script->pages->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-pages' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pages'))
                        <p class="help-block">
                            {{ $errors->first('pages') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script>
        $("#selectbtn-pages").click(function(){
            $("#selectall-pages > option").prop("selected","selected");
            $("#selectall-pages").trigger("change");
        });
        $("#deselectbtn-pages").click(function(){
            $("#selectall-pages > option").prop("selected","");
            $("#selectall-pages").trigger("change");
        });
    </script>
@stop