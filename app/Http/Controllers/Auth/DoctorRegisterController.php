<?php

namespace App\Http\Controllers\Auth;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:doctor');
    }

    public function showRegisterForm()
    {
        return view('auth.doctor-register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:doctors'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $request['password'] = Hash::make($request->password);
        Doctor::create($request->all());

        return redirect()->intended(route('doctor.dashboard'));
    }
}