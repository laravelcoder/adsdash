<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $contactcompanies = \App\ContactCompany::latest()->limit(5)->get(); 
        $contacts = \App\Contact::latest()->limit(5)->get(); 
        $agents = \App\Agent::latest()->limit(5)->get(); 

        return view('home', compact( 'contactcompanies', 'contacts', 'agents' ));
    }
}
