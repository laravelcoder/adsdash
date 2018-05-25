@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.audiences.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.audiences.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('global.audiences.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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
                    {!! Form::label('value', trans('global.audiences.fields.value').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('value', old('value'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('value'))
                        <p class="help-block">
                            {{ $errors->first('value') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('companies', trans('global.audiences.fields.companies').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-companies">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-companies">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('companies[]', $companies, old('companies'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-companies' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('companies'))
                        <p class="help-block">
                            {{ $errors->first('companies') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script>
        $("#selectbtn-companies").click(function(){
            $("#selectall-companies > option").prop("selected","selected");
            $("#selectall-companies").trigger("change");
        });
        $("#deselectbtn-companies").click(function(){
            $("#selectall-companies > option").prop("selected","");
            $("#selectall-companies").trigger("change");
        });
    </script>
@stop