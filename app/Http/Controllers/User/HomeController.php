<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;  
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    

    public function dashboard()
    {
        //return view('home');
        return view('user.main.dashboard');
    }

    /**
    public function submitProperty()
    {
        return view('theme.users.submit_property');
    }
    public function myProperties(Request $request)
    {
        $properties  = $request->user()->properties()->with('category', 'owner')->latest()->paginate(5);
        return view('theme.users.properties',compact('properties'));
    }
    */
}
