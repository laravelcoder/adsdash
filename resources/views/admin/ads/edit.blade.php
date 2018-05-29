@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.ads.title')</h3>
    
    {!! Form::model($ad, ['method' => 'PUT', 'route' => ['admin.ads.update', $ad->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ad_label', trans('global.ads.fields.ad-label').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('ad_label', old('ad_label'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ad_label'))
                        <p class="help-block">
                            {{ $errors->first('ad_label') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ad_description', trans('global.ads.fields.ad-description').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('ad_description', old('ad_description'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ad_description'))
                        <p class="help-block">
                            {{ $errors->first('ad_description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('total_impressions', trans('global.ads.fields.total-impressions').'', ['class' => 'control-label']) !!}
                    {!! Form::number('total_impressions', old('total_impressions'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('total_impressions'))
                        <p class="help-block">
                            {{ $errors->first('total_impressions') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('total_networks', trans('global.ads.fields.total-networks').'', ['class' => 'control-label']) !!}
                    {!! Form::number('total_networks', old('total_networks'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('total_networks'))
                        <p class="help-block">
                            {{ $errors->first('total_networks') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('total_channels', trans('global.ads.fields.total-channels').'', ['class' => 'control-label']) !!}
                    {!! Form::number('total_channels', old('total_channels'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('total_channels'))
                        <p class="help-block">
                            {{ $errors->first('total_channels') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            ClipDB
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('global.clipdb.fields.clip-label')</th>
                        <th>@lang('global.clipdb.fields.link-to-clip')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="clipdb">
                    @forelse(old('clipdbs', []) as $index => $data)
                        @include('admin.ads.clipdbs_row', [
                            'index' => $index
                        ])
                    @empty
                        @foreach($ad->clipdbs as $item)
                            @include('admin.ads.clipdbs_row', [
                                'index' => 'id-' . $item->id,
                                'field' => $item
                            ])
                        @endforeach
                    @endforelse
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('global.app_add_new')</a>
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="clipdb-template">
        @include('admin.ads.clipdbs_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

            <script>
        $('.add-new').click(function () {
            var tableBody = $(this).parent().find('tbody');
            var template = $('#' + tableBody.attr('id') + '-template').html();
            var lastIndex = parseInt(tableBody.find('tr').last().data('index'));
            if (isNaN(lastIndex)) {
                lastIndex = 0;
            }
            tableBody.append(template.replace(/_INDEX_/g, lastIndex + 1));
            return false;
        });
        $(document).on('click', '.remove', function () {
            var row = $(this).parentsUntil('tr').parent();
            row.remove();
            return false;
        });
        </script>
@stop