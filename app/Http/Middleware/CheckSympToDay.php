<?php

namespace App\Http\Middleware;

use App\Symp;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSympToDay
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authed=Auth::id();
         $user = User::find($authed);
         $date = date('Y-m-d');
         
         
         if(isset(Symp::where('patient_id',$user->id)->where('date',$date)->first()->date)){
            return redirect('home'); 
        }        
        return $next($request);
    }
}
