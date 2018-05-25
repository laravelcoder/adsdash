@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.ad-responses.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.ad_responses.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('station_id', trans('global.ad-responses.fields.station').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('station_id', $stations, old('station_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block">Enter the channel number</p>
                    @if($errors->has('station_id'))
                        <p class="help-block">
                            {{ $errors->first('station_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('time', trans('global.ad-responses.fields.time').'', ['class' => 'control-label']) !!}
                    {!! Form::text('time', old('time'), ['class' => 'form-control timepicker', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('time'))
                        <p class="help-block">
                            {{ $errors->first('time') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('impressions', trans('global.ad-responses.fields.impressions').'', ['class' => 'control-label']) !!}
                    {!! Form::number('impressions', old('impressions'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('impressions'))
                        <p class="help-block">
                            {{ $errors->first('impressions') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('non_impressions', trans('global.ad-responses.fields.non-impressions').'', ['class' => 'control-label']) !!}
                    {!! Form::number('non_impressions', old('non_impressions'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('non_impressions'))
                        <p class="help-block">
                            {{ $errors->first('non_impressions') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cypi_id', trans('global.ad-responses.fields.cypi-id').'', ['class' => 'control-label']) !!}
                    {!! Form::text('cypi_id', old('cypi_id'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cypi_id'))
                        <p class="help-block">
                            {{ $errors->first('cypi_id') }}
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

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.timepicker').datetimepicker({
                format: "{{ config('app.time_format_moment') }}",
            });
            
        });
    </script>
            
@stop