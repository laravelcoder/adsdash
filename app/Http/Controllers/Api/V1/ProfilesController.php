<?php

namespace App\Http\Controllers\Api\V1;

use App\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProfilesRequest;
use App\Http\Requests\Admin\UpdateProfilesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ProfilesController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Profile::all();
    }

    public function show($id)
    {
        return Profile::findOrFail($id);
    }

    public function update(UpdateProfilesRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $profile = Profile::findOrFail($id);
        $profile->update($request->all());
        

        return $profile;
    }

    public function store(StoreProfilesRequest $request)
    {
        $request = $this->saveFiles($request);
        $profile = Profile::create($request->all());
        

        return $profile;
    }

    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();
        return '';
    }
}
