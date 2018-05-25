@extends('layouts.app')

@section('content')
    <div class="row">
         <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added contactcompanies</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.contact-companies.fields.name')</th> 
                            <th> @lang('global.contact-companies.fields.website')</th> 
                            <th> @lang('global.contact-companies.fields.email')</th> 
                            <th> @lang('global.contact-companies.fields.address')</th> 
                            <th> @lang('global.contact-companies.fields.city')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($contactcompanies as $contactcompany)
                            <tr>
                               
                                <td>{{ $contactcompany->name }} </td> 
                                <td>{{ $contactcompany->website }} </td> 
                                <td>{{ $contactcompany->email }} </td> 
                                <td>{{ $contactcompany->address }} </td> 
                                <td>{{ $contactcompany->city }} </td> 
                                <td>

                                    @can('contact_company_view')
                                    <a href="{{ route('admin.contact_companies.show',[$contactcompany->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('contact_company_edit')
                                    <a href="{{ route('admin.contact_companies.edit',[$contactcompany->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('contact_company_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.contact_companies.destroy', $contactcompany->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added contacts</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.contacts.fields.first-name')</th> 
                            <th> @lang('global.contacts.fields.last-name')</th> 
                            <th> @lang('global.contacts.fields.phone1')</th> 
                            <th> @lang('global.contacts.fields.phone2')</th> 
                            <th> @lang('global.contacts.fields.email')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($contacts as $contact)
                            <tr>
                               
                                <td>{{ $contact->first_name }} </td> 
                                <td>{{ $contact->last_name }} </td> 
                                <td>{{ $contact->phone1 }} </td> 
                                <td>{{ $contact->phone2 }} </td> 
                                <td>{{ $contact->email }} </td> 
                                <td>

                                    @can('contact_view')
                                    <a href="{{ route('admin.contacts.show',[$contact->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('contact_edit')
                                    <a href="{{ route('admin.contacts.edit',[$contact->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('contact_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.contacts.destroy', $contact->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added agents</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.agents.fields.first-name')</th> 
                            <th> @lang('global.agents.fields.last-name')</th> 
                            <th> @lang('global.agents.fields.phone1')</th> 
                            <th> @lang('global.agents.fields.phone2')</th> 
                            <th> @lang('global.agents.fields.email')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($agents as $agent)
                            <tr>
                               
                                <td>{{ $agent->first_name }} </td> 
                                <td>{{ $agent->last_name }} </td> 
                                <td>{{ $agent->phone1 }} </td> 
                                <td>{{ $agent->phone2 }} </td> 
                                <td>{{ $agent->email }} </td> 
                                <td>

                                    @can('agent_view')
                                    <a href="{{ route('admin.agents.show',[$agent->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('agent_edit')
                                    <a href="{{ route('admin.agents.edit',[$agent->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('agent_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.agents.destroy', $agent->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>


    </div>
@endsection

