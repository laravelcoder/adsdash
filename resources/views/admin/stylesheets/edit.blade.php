@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.stylesheet.title')</h3>
    
    {!! Form::model($stylesheet, ['method' => 'PUT', 'route' => ['admin.stylesheets.update', $stylesheet->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('order', trans('global.stylesheet.fields.order').'', ['class' => 'control-label']) !!}
                    {!! Form::number('order', old('order'), ['class' => 'form-control', 'placeholder' => 'Order to be loaded']) !!}
                    <p class="help-block">Order to be loaded</p>
                    @if($errors->has('order'))
                        <p class="help-block">
                            {{ $errors->first('order') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('link', trans('global.stylesheet.fields.link').'', ['class' => 'control-label']) !!}
                    {!! Form::text('link', old('link'), ['class' => 'form-control', 'placeholder' => 'add stylesheets here to add them to the page.']) !!}
                    <p class="help-block">add stylesheets here to add them to the page.</p>
                    @if($errors->has('link'))
                        <p class="help-block">
                            {{ $errors->first('link') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pages', trans('global.stylesheet.fields.pages').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-pages">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-pages">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('pages[]', $pages, old('pages') ? old('pages') : $stylesheet->pages->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-pages' ]) !!}
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