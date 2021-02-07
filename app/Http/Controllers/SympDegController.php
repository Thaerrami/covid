<?php

namespace App\Http\Controllers;

use App\Patreport;
use App\Symp;
use App\Sympcont;
use App\SympDeg;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SympDegController extends Controller
{
    
    public function save(Request $r)
    {

        
        $authed=Auth::id();
         $user = User::find($authed);
         $date = date('Y-m-d');
        
// if there is a symptoms to day  thin seve thim

        if(request('symp') !== null ){
         $sympt = $r->toArray()['symp'];
         $status = max(array_keys($sympt)) ;
         
         $user->status=$status;
         $user->save();
         $allsymp=$r->input('symp');

// loop over symptomps to save thim

         foreach($allsymp as $key=>$d){
                       foreach($d as $p){
                           $inssymp=new Symp([
                             'symp_id'=>$p,
                             'Patient_id'=>$user->id,
                          ]);
                          $inssymp->save();
                        }
                    }
                }

//save daily report for patient


        $inssymp=new Patreport([
            'Patient_id'=>$user->id,
            'report'=>request('dayreport')??'nothing.'
     ]);
        
     $inssymp->save();
    


    
    
        # code...
        return redirect('home');
    }

    public function addnewsymp(Request $r){
        SympDeg::create($r->input());
        return redirect()->back();
    }

}
