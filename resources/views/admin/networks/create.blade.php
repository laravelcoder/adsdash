@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.networks.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.networks.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('network', trans('global.networks.fields.network').'', ['class' => 'control-label']) !!}
                    {!! Form::text('network', old('network'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('network'))
                        <p class="help-block">
                            {{ $errors->first('network') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('network_affiliate', trans('global.networks.fields.network-affiliate').'', ['class' => 'control-label']) !!}
                    {!! Form::text('network_affiliate', old('network_affiliate'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('network_affiliate'))
                        <p class="help-block">
                            {{ $errors->first('network_affiliate') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('provider', trans('global.networks.fields.provider').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-provider">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-provider">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('provider[]', $providers, old('provider'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-provider' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('provider'))
                        <p class="help-block">
                            {{ $errors->first('provider') }}
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
        $("#selectbtn-provider").click(function(){
            $("#selectall-provider > option").prop("selected","selected");
            $("#selectall-provider").trigger("change");
        });
        $("#deselectbtn-provider").click(function(){
            $("#selectall-provider > option").prop("selected","");
            $("#selectall-provider").trigger("change");
        });
    </script>
@stop