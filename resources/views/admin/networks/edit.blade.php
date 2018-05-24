@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.networks.title')</h3>
    
    {!! Form::model($network, ['method' => 'PUT', 'route' => ['admin.networks.update', $network->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
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
                    {!! Form::select('provider[]', $providers, old('provider') ? old('provider') : $network->provider->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-provider' ]) !!}
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
    <div class="panel panel-default">
        <div class="panel-heading">
            Providers
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('global.providers.fields.provider')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="providers">
                    @forelse(old('providers', []) as $index => $data)
                        @include('admin.networks.providers_row', [
                            'index' => $index
                        ])
                    @empty
                        @foreach($network->providers as $item)
                            @include('admin.networks.providers_row', [
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

    <script type="text/html" id="providers-template">
        @include('admin.networks.providers_row',
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