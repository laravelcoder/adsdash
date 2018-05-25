@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.contacts.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.contacts.fields.company')</th>
                            <td field-key='company'>{{ $contact->company->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.first-name')</th>
                            <td field-key='first_name'>{{ $contact->first_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.last-name')</th>
                            <td field-key='last_name'>{{ $contact->last_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.phone1')</th>
                            <td field-key='phone1'>{{ $contact->phone1 }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.phone2')</th>
                            <td field-key='phone2'>{{ $contact->phone2 }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.email')</th>
                            <td field-key='email'>{{ $contact->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.skype')</th>
                            <td field-key='skype'>{{ $contact->skype }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.address')</th>
                            <td field-key='address'>{{ $contact->address }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.created-by')</th>
                            <td field-key='created_by'>{{ $contact->created_by->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.photo')</th>
                            <td field-key='photo'>@if($contact->photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $contact->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $contact->photo) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.created-by-team')</th>
                            <td field-key='created_by_team'>{{ $contact->created_by_team->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.about')</th>
                            <td field-key='about'>{!! $contact->about !!}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.contacts.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
