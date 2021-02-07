<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Admin;
use App\Doc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DocRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:doc');
    }

    public function showRegisterForm()
    {
        return view('auth.doc-register');
    }

    public function register(Request $request)
    {
        // dd('awehaweohge');
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:docs'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $request['password'] = Hash::make($request->password);
        Doc::create($request->all());

        return redirect()->intended(route('doc.dashboard'));
    }
}