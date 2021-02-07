<?php

namespace App\Http\Controllers;

use App\Country;
use App\Doc;
use App\Mail\AdminToPat;
use App\Message;
use App\Patreport;
use App\Symp;
use App\SympDeg;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Cast\Array_;

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

    

    public function index()
    {
// //////////////////////////////////
        $userdata = Auth::user();
        $uname = $userdata->name;
        $bof = $userdata->birthdate;
        $uemail = $userdata->email;
        $uphone = $userdata->phone;
        $ucity = $userdata->city; 
        $ucountry = $userdata->country;
        $ucity = $userdata->city;
        $uc=$userdata->currentstate;
        $ustatus='';
        $current='';
        

        if($userdata->status == 1){   //check user status 1=normal 2=stable 3=in danger zone 
            $ustatus='Normal';   
        }
        else if($userdata->status == 2){
            $ustatus='In stable condition';
        }
        else{
            $ustatus='Danger';
        }


        if($uc == 1){
            $current='Recovered';
        }
        else if($uc == 2){
            $current='Case';
        }
        else{
            $current='Dead';
        }

        $uimage=$userdata->image;
        

        $isfilled=false;    // data assigned flage

        $authed=Auth::id();
        $user = User::find($authed);

        $date = date('Y-m-d'); //date to day used to check today data
        
// check if data asigned today
      
         if(isset(Symp::where('patient_id',$user->id)->where('date',$date)->first()->date)||isset(Patreport::where('patient_id',$user->id)->where('date',$date)->first()->date)){
            $isfilled=true;
               }
         
// return patient data to his profile

        return view('home',
                            [
            'name'=>$uname, 'email'=>$uemail , 'phone'=>$uphone ,'city'=>$ucity ,
            'country'=>$ucountry,'city'=>$ucity ,'status'=>$ustatus,'image'=>$uimage,
            'start'=>explode(' ',$userdata->created_at)[0],'current'=>$current,
            'filled'=>$isfilled,'bof'=>$bof
                            ]
            );
    }

///////////////////////////////////////////////////////////////

    public function update(Request $request){

        // return request();

        $userid = Auth::User()->id;
        $resopnse='successed process';

 //check if request contains image
 if(null !== request('image')){
        
    $image = request('image')->store('uploads','public');
    $d=User::find(Auth::id());
    $d->image=$image;
    $d->save();

    return response()->json($image);

}

 //check if request contains username
        if(null !== request('username')){
            User::find($userid)->update([
                'name'=>request('username')
            ]);
            return view('patient.peditname')->with(['success'=>'username updated successfully']);
                                        }
        else{
            $resopnse = 'fill username plaeas';
            }

 //check if request contains email

        if(null !== request('email')){
            User::find($userid)->update([
                'email'=>request('email')
            ]);
            return view('patient.peditemail')->with(['success'=>'email updated successfully']);
        }
        else{
            $resopnse = 'fill email fileald please';
        }
/////    check if request contains birth of date

if(null !== request('birthdate')){
    User::find($userid)->update([
        'birthdate'=>request('birthdate')
    ]);
    return view('patient.editbirthdate')->with(['success'=>'email updated successfully']);
}
else{
    $resopnse = 'fill email fileald please';
}

 //check if request contains phone

        if(null !== request('phone')){
            User::find($userid)->update([
                'phone'=>request('phone')
            ]);
            return view('patient.pphone')->with(['success'=>'phone updated successfully']);
        }
        else{
            $resopnse='fill phone fileld please';
        }

 //check if request contains country

        if(null !== request('city') && null !== request('country')){
            User::find($userid)->update([
                'city'=>strtolower(request('city')),
                'country'=>request('country')
            ]);
            $Country =Country::all()->toArray();
            return view('patient.location')->with(['success'=>'location updated successfully','location'=>$Country]);
        }
        else{
            $resopnse='fill all filelds please';
        }

 //delete  image 
        if(null !== request('delete')){
            User::find($userid)->delete([
                'image'
            ]);
            return view('patient.location')->with(['success'=>'location updated successfully']);
        }
        else{
            $resopnse='fill all filelds please';
        }

 //check if request contains password

        if(null !== request('password') && null !== request('confirm') ){
            if(request('password')!==request('confirm'))
            {
                return view('patient.peditpass')->with(['fail'=>'pasword dose not match']);
            }else{
                User::find($userid)->update([
                    'password'=>Hash::make(request('password')),
                ]);
                return view('patient.peditpass')->with(['success'=>'pasword updated successfully']);
            }
        }
        else{
            $resopnse = 'password not match';
        }

        
        
        return redirect()->back()->with(['response'=>$resopnse]);
    }

//////////////////////////////////////////

    public function mydoctor(){
        $user= Auth::user();
        $docid=$user->doc()->get()->toArray()[0]['id'];
        $docdata=Doc::find($docid);
        $nop= $docdata->Patient()->count();
        $messages=Message::select(['message','sender','created_at'])->orderBy('created_at','desc')->limit(30)->where('Patient_id',$user->id)->get()->toArray();
    
        return view('patient.mydoctor')->with(['mydoctor'=>$docdata->toArray(),'nop'=>$nop,'message'=>$messages]);

    }
////////////////////////////////////////////
    public function mysymp(){ 
        $symp = DB::table('symps')->orderBy('date','desc')
        ->join('symp_degs', 'symps.symp_id', '=', 'symp_degs.id')
        ->where('Patient_id',Auth::id())
        ->select(['title','date'])
        ->get()->toArray();
       
        $array=[];

        $data[]=[];
        foreach($symp as $i){
           $data[$i->date]=array();
        }


        foreach($symp as $i){
            array_push($data[$i->date],$i->title);;
        }

        array_shift($data);

        return view('patient.mysymp')->with(['symp'=>$data]);
    }

////////////////////////////////////////////

    public function myreport(){
        $reports=Auth::user()->Patreport()->select(['report','date'])->get()->toArray();
        return view('patient.myreport')->with(['reports'=>$reports]);
    }


///////////////////////////////////

    public function maildoc(Request $r){
        $email=request('emailtodoc')??' .';
        $patid=Auth::id();
        $docid=Auth::user()->doc()->get()->toArray()[0]['id'];

        Message::create([
            'Patient_id'=>$patid,
            'Doc_id'=>$docid,
            'message'=>$email,
            'sender'=>1
        ]);

        return redirect()->back();
    }
    public function mail()
    {
        Mail::to('therichposts@gmail.com')->send(new AdminToPat());
        return 'Email was sent';
    }
    
    
}
