<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class NetworkDashboardsController extends Controller
{
    public function index()
    {
        if (! Gate::allows('network_dashboard_access')) {
            return abort(401);
        }
        return view('admin.network_dashboards.index');
    }
}
