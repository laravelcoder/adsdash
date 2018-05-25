<?php

namespace App\Http\Controllers\Api\V1;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContactsRequest;
use App\Http\Requests\Admin\UpdateContactsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ContactsController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Contact::all();
    }

    public function show($id)
    {
        return Contact::findOrFail($id);
    }

    public function update(UpdateContactsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $contact = Contact::findOrFail($id);
        $contact->update($request->all());
        

        return $contact;
    }

    public function store(StoreContactsRequest $request)
    {
        $request = $this->saveFiles($request);
        $contact = Contact::create($request->all());
        

        return $contact;
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return '';
    }
}
