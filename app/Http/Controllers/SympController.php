<?php

namespace App\Http\Controllers;

use App\Patreport;
use App\Symp;
use App\SympDeg;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Location;
use PHPUnit\Util\Json;

class SympController extends Controller
{
    public function index()
    {
        

        $symps = SympDeg::select('*')->orderBy('symp_deg')->get()->toArray();
        return view('symp.inssymp',['syms'=>$symps]);
    }

    

    public function fillpatsymp($id){

        $user = User::find($id);
        $date = date('Y-m-d');
        
        if(isset(Symp::where('patient_id',$user->id)->where('date',$date)->first()->date) || isset(Patreport::where('patient_id',$user->id)->where('date',$date)->first()->date) ){
           return redirect()->back(); 
       }        

        $symps = SympDeg::select('*')->orderBy('symp_deg')->get()->toArray();
        return view('symp.docfillsymp',['syms'=>$symps,'id'=>$id]);
    }

    public function docsave(Request $r){
        $arr=[];

        $arr = json_decode(
            request()->symps
        );
        // sympdeg

        $sympdeg = request()->sympdeg;
        
        // $allsymp=$arr;
        $report=request()->dayreport??'nothing today.';
        
        $id=request()->input('id');
        $user = User::find($id);
      

        // return var_dump(json_encode(request()));
    if($sympdeg !== null) 
        if($sympdeg > 0 ){

            if(isset($arr))
            $this->pushsymptoms($arr,$user);

            $this->changestatus($sympdeg,$user);

            $this->addreport($report,$user);

        }
         else{
            return 'no data today ? thats good news ';   
         }

       
    
    
        # code...
        
        return 'data inserted successfuly';
   
    }

    public function pushsymptoms($allsymp,$user){
        foreach($allsymp as $d){
            $inssymp=new Symp([
              'symp_id'=>$d,
              'Patient_id'=>$user->id,
           ]);
           $inssymp->save();
          
      }
    }

    public function changestatus($status,$user){
        $user->status=$status;
        $user->save();

        return $status;
    }

    public function addreport($report,$user){
        $inssymp=new Patreport([
            'Patient_id'=>$user->id,
            'report'=>$report
            ]);
        
      $inssymp->save();
    
    }

}
