@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.clients.title')</h3>
    @can('client_create')
    <p>
        <a href="{{ route('admin.clients.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($clients) > 0 ? 'datatable' : '' }} @can('client_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('client_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.clients.fields.first-name')</th>
                        <th>@lang('global.clients.fields.last-name')</th>
                        <th>@lang('global.clients.fields.company-name')</th>
                        <th>@lang('global.clients.fields.email')</th>
                        <th>@lang('global.clients.fields.phone')</th>
                        <th>@lang('global.clients.fields.website')</th>
                        <th>@lang('global.clients.fields.skype')</th>
                        <th>@lang('global.clients.fields.country')</th>
                        <th>@lang('global.clients.fields.client-status')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($clients) > 0)
                        @foreach ($clients as $client)
                            <tr data-entry-id="{{ $client->id }}">
                                @can('client_delete')
                                    <td></td>
                                @endcan

                                <td field-key='first_name'>{{ $client->first_name }}</td>
                                <td field-key='last_name'>{{ $client->last_name }}</td>
                                <td field-key='company_name'>{{ $client->company_name }}</td>
                                <td field-key='email'>{{ $client->email }}</td>
                                <td field-key='phone'>{{ $client->phone }}</td>
                                <td field-key='website'>{{ $client->website }}</td>
                                <td field-key='skype'>{{ $client->skype }}</td>
                                <td field-key='country'>{{ $client->country }}</td>
                                <td field-key='client_status'>{{ $client->client_status->title or '' }}</td>
                                                                <td>
                                    @can('client_view')
                                    <a href="{{ route('admin.clients.show',[$client->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('client_edit')
                                    <a href="{{ route('admin.clients.edit',[$client->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('client_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.clients.destroy', $client->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="14">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('client_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.clients.mass_destroy') }}';
        @endcan

    </script>
@endsection