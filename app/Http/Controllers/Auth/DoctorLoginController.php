<?php
namespace App\Http\Controllers\Auth;

use App\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:doctor')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.doctor-login');
    }

    public function login(Request $request)
    {
        // Validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        // dd(Auth::guard('doctor')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember));
        // dd($request->session()->all());
        // Attempt to log the user in
        if(Auth::guard('doctor')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
        {
            return redirect()->intended(route('doctor.dashboard'));
        }

        

        // if unsuccessful
        return redirect()->back()->withInput($request->only('email','remember'));
    }
}