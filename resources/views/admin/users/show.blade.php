@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.users.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.users.fields.name')</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.email')</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.role')</th>
                            <td field-key='role'>
                                @foreach ($user->role as $singleRole)
                                    <span class="label label-info label-many">{{ $singleRole->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.team')</th>
                            <td field-key='team'>{{ $user->team->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#providers" aria-controls="providers" role="tab" data-toggle="tab">Providers</a></li>
<li role="presentation" class=""><a href="#clipdb" aria-controls="clipdb" role="tab" data-toggle="tab">ClipDB</a></li>
<li role="presentation" class=""><a href="#ads" aria-controls="ads" role="tab" data-toggle="tab">Ads</a></li>
<li role="presentation" class=""><a href="#user_base" aria-controls="user_base" role="tab" data-toggle="tab">User Base</a></li>
<li role="presentation" class=""><a href="#bottom_scripts" aria-controls="bottom_scripts" role="tab" data-toggle="tab">Bottom Scripts</a></li>
<li role="presentation" class=""><a href="#contacts" aria-controls="contacts" role="tab" data-toggle="tab">Contacts</a></li>
<li role="presentation" class=""><a href="#agents" aria-controls="agents" role="tab" data-toggle="tab">Agents</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="providers">
<table class="table table-bordered table-striped {{ count($providers) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.providers.fields.provider')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($providers) > 0)
            @foreach ($providers as $provider)
                <tr data-entry-id="{{ $provider->id }}">
                    <td field-key='provider'>{{ $provider->provider }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['providers.restore', $provider->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['providers.perma_del', $provider->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('providers.show',[$provider->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('providers.edit',[$provider->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['providers.destroy', $provider->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="clipdb">
<table class="table table-bordered table-striped {{ count($clipdbs) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.clipdb.fields.clip-label')</th>
                        <th>@lang('global.clipdb.fields.created-by-team')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($clipdbs) > 0)
            @foreach ($clipdbs as $clipdb)
                <tr data-entry-id="{{ $clipdb->id }}">
                    <td field-key='clip_label'>{{ $clipdb->clip_label }}</td>
                                <td field-key='created_by_team'>{{ $clipdb->created_by_team->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['clipdbs.restore', $clipdb->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['clipdbs.perma_del', $clipdb->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('clipdbs.show',[$clipdb->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('clipdbs.edit',[$clipdb->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['clipdbs.destroy', $clipdb->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="ads">
<table class="table table-bordered table-striped {{ count($ads) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.ads.fields.ad-label')</th>
                        <th>@lang('global.ads.fields.total-impressions')</th>
                        <th>@lang('global.ads.fields.total-networks')</th>
                        <th>@lang('global.ads.fields.total-channels')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($ads) > 0)
            @foreach ($ads as $ad)
                <tr data-entry-id="{{ $ad->id }}">
                    <td field-key='ad_label'>{{ $ad->ad_label }}</td>
                                <td field-key='total_impressions'>{{ $ad->total_impressions }}</td>
                                <td field-key='total_networks'>{{ $ad->total_networks }}</td>
                                <td field-key='total_channels'>{{ $ad->total_channels }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['ads.restore', $ad->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['ads.perma_del', $ad->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('ads.show',[$ad->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('ads.edit',[$ad->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['ads.destroy', $ad->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
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
<div role="tabpanel" class="tab-pane " id="user_base">
<table class="table table-bordered table-striped {{ count($user_bases) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.user-base.fields.name')</th>
                        <th>@lang('global.user-base.fields.value')</th>
                        <th>@lang('global.user-base.fields.created-by')</th>
                        <th>@lang('global.user-base.fields.created-by-team')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($user_bases) > 0)
            @foreach ($user_bases as $user_base)
                <tr data-entry-id="{{ $user_base->id }}">
                    <td field-key='name'>{{ $user_base->name }}</td>
                                <td field-key='value'>{{ $user_base->value }}</td>
                                <td field-key='created_by'>{{ $user_base->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $user_base->created_by_team->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['user_bases.restore', $user_base->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['user_bases.perma_del', $user_base->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('user_bases.show',[$user_base->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('user_bases.edit',[$user_base->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['user_bases.destroy', $user_base->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="bottom_scripts">
<table class="table table-bordered table-striped {{ count($bottom_scripts) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.bottom-scripts.fields.name')</th>
                        <th>@lang('global.bottom-scripts.fields.created-by')</th>
                        <th>@lang('global.bottom-scripts.fields.created-by-team')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($bottom_scripts) > 0)
            @foreach ($bottom_scripts as $bottom_script)
                <tr data-entry-id="{{ $bottom_script->id }}">
                    <td field-key='name'>{{ $bottom_script->name }}</td>
                                <td field-key='created_by'>{{ $bottom_script->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $bottom_script->created_by_team->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['bottom_scripts.restore', $bottom_script->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['bottom_scripts.perma_del', $bottom_script->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('bottom_scripts.show',[$bottom_script->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('bottom_scripts.edit',[$bottom_script->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['bottom_scripts.destroy', $bottom_script->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
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
<div role="tabpanel" class="tab-pane " id="contacts">
<table class="table table-bordered table-striped {{ count($contacts) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.contacts.fields.company')</th>
                        <th>@lang('global.contacts.fields.first-name')</th>
                        <th>@lang('global.contacts.fields.last-name')</th>
                        <th>@lang('global.contacts.fields.email')</th>
                        <th>@lang('global.contacts.fields.skype')</th>
                        <th>@lang('global.contacts.fields.address')</th>
                        <th>@lang('global.contacts.fields.created-by')</th>
                        <th>@lang('global.contacts.fields.created-by-team')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($contacts) > 0)
            @foreach ($contacts as $contact)
                <tr data-entry-id="{{ $contact->id }}">
                    <td field-key='company'>{{ $contact->company->name or '' }}</td>
                                <td field-key='first_name'>{{ $contact->first_name }}</td>
                                <td field-key='last_name'>{{ $contact->last_name }}</td>
                                <td field-key='email'>{{ $contact->email }}</td>
                                <td field-key='skype'>{{ $contact->skype }}</td>
                                <td field-key='address'>{{ $contact->address }}</td>
                                <td field-key='created_by'>{{ $contact->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $contact->created_by_team->name or '' }}</td>
                                                                <td>
                                    @can('view')
                                    <a href="{{ route('contacts.show',[$contact->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('contacts.edit',[$contact->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['contacts.destroy', $contact->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="15">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="agents">
<table class="table table-bordered table-striped {{ count($agents) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.agents.fields.company')</th>
                        <th>@lang('global.agents.fields.first-name')</th>
                        <th>@lang('global.agents.fields.last-name')</th>
                        <th>@lang('global.agents.fields.phone1')</th>
                        <th>@lang('global.agents.fields.phone2')</th>
                        <th>@lang('global.agents.fields.email')</th>
                        <th>@lang('global.agents.fields.skype')</th>
                        <th>@lang('global.agents.fields.address')</th>
                        <th>@lang('global.agents.fields.created-by')</th>
                        <th>@lang('global.agents.fields.created-by-team')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($agents) > 0)
            @foreach ($agents as $agent)
                <tr data-entry-id="{{ $agent->id }}">
                    <td field-key='company'>{{ $agent->company->name or '' }}</td>
                                <td field-key='first_name'>{{ $agent->first_name }}</td>
                                <td field-key='last_name'>{{ $agent->last_name }}</td>
                                <td field-key='phone1'>{{ $agent->phone1 }}</td>
                                <td field-key='phone2'>{{ $agent->phone2 }}</td>
                                <td field-key='email'>{{ $agent->email }}</td>
                                <td field-key='skype'>{{ $agent->skype }}</td>
                                <td field-key='address'>{{ $agent->address }}</td>
                                <td field-key='created_by'>{{ $agent->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $agent->created_by_team->name or '' }}</td>
                                                                <td>
                                    @can('view')
                                    <a href="{{ route('agents.show',[$agent->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('agents.edit',[$agent->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['agents.destroy', $agent->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="17">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
