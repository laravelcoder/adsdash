@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.ad-types.title')</h3>
    @can('ad_type_create')
    <p>
        <a href="{{ route('admin.ad_types.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('ad_type_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('ad_type_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.ad-types.fields.codec')</th>
                        <th>@lang('global.ad-types.fields.extention')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('ad_type_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.ad_types.mass_destroy') }}';
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.ad_types.index') !!}';
            window.dtDefaultOptions.columns = [@can('ad_type_delete')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan{data: 'codec', name: 'codec'},
                {data: 'extention', name: 'extention'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection