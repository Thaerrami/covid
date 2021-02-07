<?php

namespace App\Http\Controllers;

use App\Casenum;
use App\Country as AppCountry;
use App\Doc;
use App\help;
use App\User;
use Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function welcome() {
        $faqall=DB::table('advice')->get()->toArray();
        $faq= array_rand ( $faqall);
        $faq=$faqall[$faq];
       //  dd($faq);
        $answer= explode('+',$faq->answer);
        $question=$faq->question;
     
       return view('welcome',['question'=>$question,'answer'=>$answer,'all'=>$faqall]);
     }

     public function updataAdvice() {
    
    
      if(request()->id !== null){
        $res=DB::table('advice')->where('id',request()->id)->update([
          'question'=>request()->question,
          'answer'=>request()->answer
        ]);      
        
      }
      else{
        $res =DB::table('advice')->insert([
          'question'=>request()->question,
          'answer'=>request()->answer
        ]);
      }
  
      $data=DB::table('advice')->get()->toArray();
     
      return response()->json($data);
    }

    ////////////////getting advicecs
    public function getAdvices(){

      $advices=DB::select('select * from advice ');
      // dd($advices);
      return view('admin.advice')->with(['advices'=>$advices]);
    }


     /////////////get help messages

    public function getHelpMessages() {
      $message=Help::all();
      return view('help.help')->with(['message'=>$message]);
    }

    //////////send helpup message
    
    public function sendHelp(Request $r) {
      Help::create([
        'message'=>$r->input('message'),
        'name'=>$r->input('name')
      ]);
  
      return redirect()->back();
  }

  ///get all countries '
  public function getCountries(){
    $Country =AppCountry::all()->toArray();
    
    return view('patient.location')->with(['location'=>$Country]);
  }


  public function getSympByDate(){
    $from=request('from');
    $to=request('to');
    $cases= Casenum::select(['daycase','recover','death','date'])->whereBetween('date',[$from,$to])->get();
    $state = Casenum::select(['norcase','midcase','dancase','date'])->whereBetween('date',[$from,$to])->get();
    $info=[$cases,$state];
    return response()->json($info);
  }

  ////delete profile image
  public function deleteImage() {
    $user='';
    if(Auth::guard('admin')->check()){
        $user = Auth::guard('admin')->user()->update(['image'=>'']);}
    else if(Auth::guard('doc')->check()){
        $user = Auth::guard('doc')->user()->update(['image'=>'']);;}
    else{
        $user = Auth::user()->update(['image'=>'']);;
    }

     
    
    return 'removed';
   }

   /////////////////////////////////////////
   public function getcurrentcase(){
     $d=DB::table('users')
     ->select(['users.id','users.name','users.email','users.phone','users.country','users.image','users.currentstate'])
     ->where('currentstate',2);

     if(Auth::guard('doc')->check()){
      $d->where('docid',Auth::guard('doc')->id());
    }

    return $d;
    // 
 }
   ///////////////////
   public function getfilleduser(){
    return DB::table('symps')->select('Patient_id')
         ->distinct('Patient_id')
         ->join('users', 'symps.Patient_id', '=', 'users.id')
         ->select(['users.id','users.name','users.phone','users.country','users.image','users.currentstate'])
         ->where('users.currentstate',2)
         ->where('symps.date','=',date('Y-m-d'))->select('users.id');

 }

/////////////////////
   public function notfilledpat($name){
    $filled = $this->getfilleduser()->get()->toArray();
    $users = $this->getcurrentcase()->get();
    
    if($name){
      $users->where('name','LIKE','%'.$name.'%');
    }

    if(!isset($filled)){
    $filledids=[];
    foreach($filled as $i){
        array_push($filledids,$i->id);
    }
    
    foreach($users->toArray() as $key=>$value){
        if(! in_array($value->id , $filledids)){
            array_push($patient,json_decode(json_encode($value),true));
        }
    }
}
else 
    $filledids = User::where('currentstate',2)->where('name','LIKE','%'.$name.'%')->get();

    return $filledids;
}
//////////////////
///////////////
public function filterDoc(){
  $name = request('name');
  $docs='';
  if($name!=''){
    $docs = Doc::where('name','LIKE','%'.$name.'%');
  }
  else{
    $docs = Doc::where('id','>',0);
  }
  
  return response()->json($docs->get());
}
////// filter patient search
public function filterPatient(){
  $state = request('state');
  $name = request('name');

  $user=new User();

   if($state > 0 && $state <= 3) {
     $users= $user::select(['id','name','email','phone','country','currentstate'])->where('currentstate',$state);
    }
    else if($state == 4 ){
      $res=$this->notfilledpat($name);
      return response()->json($res) ;
    }
    else{
      $users= $user::select(['id','name','email','phone','country','currentstate']);
    }
    if($name){
      $users->where('name','LIKE','%'.$name.'%');
    }
    if(Auth::guard('doc')->check()){
      $users->where('docid',Auth::guard('doc')->id());
    }
  
  $users=$users->get();

  $a=[$state,$name];
  return response()->json($users) ;
}

}
