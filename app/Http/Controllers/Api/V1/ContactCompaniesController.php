<?php

namespace App\Http\Controllers\Api\V1;

use App\ContactCompany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContactCompaniesRequest;
use App\Http\Requests\Admin\UpdateContactCompaniesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ContactCompaniesController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return ContactCompany::all();
    }

    public function show($id)
    {
        return ContactCompany::findOrFail($id);
    }

    public function update(UpdateContactCompaniesRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $contact_company = ContactCompany::findOrFail($id);
        $contact_company->update($request->all());
        
        $phones           = $contact_company->phones;
        $currentPhoneData = [];
        foreach ($request->input('phones', []) as $index => $data) {
            if (is_integer($index)) {
                $contact_company->phones()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentPhoneData[$id] = $data;
            }
        }
        foreach ($phones as $item) {
            if (isset($currentPhoneData[$item->id])) {
                $item->update($currentPhoneData[$item->id]);
            } else {
                $item->delete();
            }
        }

        return $contact_company;
    }

    public function store(StoreContactCompaniesRequest $request)
    {
        $request = $this->saveFiles($request);
        $contact_company = ContactCompany::create($request->all());
        
        foreach ($request->input('phones', []) as $data) {
            $contact_company->phones()->create($data);
        }

        return $contact_company;
    }

    public function destroy($id)
    {
        $contact_company = ContactCompany::findOrFail($id);
        $contact_company->delete();
        return '';
    }
}
