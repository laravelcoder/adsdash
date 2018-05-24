@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.client-projects.title')</h3>
    @can('client_project_create')
    <p>
        <a href="{{ route('admin.client_projects.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($client_projects) > 0 ? 'datatable' : '' }} @can('client_project_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('client_project_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.client-projects.fields.title')</th>
                        <th>@lang('global.client-projects.fields.client')</th>
                        <th>@lang('global.client-projects.fields.description')</th>
                        <th>@lang('global.client-projects.fields.date')</th>
                        <th>@lang('global.client-projects.fields.budget')</th>
                        <th>@lang('global.client-projects.fields.project-status')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($client_projects) > 0)
                        @foreach ($client_projects as $client_project)
                            <tr data-entry-id="{{ $client_project->id }}">
                                @can('client_project_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $client_project->title }}</td>
                                <td field-key='client'>{{ $client_project->client->first_name or '' }}</td>
                                <td field-key='description'>{!! $client_project->description !!}</td>
                                <td field-key='date'>{{ $client_project->date }}</td>
                                <td field-key='budget'>{{ $client_project->budget }}</td>
                                <td field-key='project_status'>{{ $client_project->project_status->title or '' }}</td>
                                                                <td>
                                    @can('client_project_view')
                                    <a href="{{ route('admin.client_projects.show',[$client_project->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('client_project_edit')
                                    <a href="{{ route('admin.client_projects.edit',[$client_project->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('client_project_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.client_projects.destroy', $client_project->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('client_project_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.client_projects.mass_destroy') }}';
        @endcan

    </script>
@endsection