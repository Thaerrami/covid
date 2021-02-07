<?php



namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DocLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:doc')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.doc-login');
    }

    public function login(Request $request)
    {
        // Validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Attempt to log the user in
        if(Auth::guard('doc')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
        {
            return redirect()->intended(route('doc.dashboard'));
        }


        // if unsuccessful
        return redirect()->back()->withInput($request->only('email','remember'));
    
    }

}