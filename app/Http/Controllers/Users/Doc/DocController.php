<?php

namespace App\Http\Controllers\Users\Doc;

use App\Country;
use App\Death;
use App\Doc;
use App\Http\Controllers\Controller;
use App\Message;
use App\Patreport;
use App\Recovered;
use App\Symp;
use App\SympDeg;
use App\User;
use Carbon\Carbon;
use DateTime;
use Dotenv\Validator;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Util\Json;

class DocController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:doc');
    }

    public function index()
    {
        $user =Auth::user();
        $un=$user->name;
        $up=$user->phone;
        $ue=$user->email;
        $unum=$user->Patient()->count();
        $utitle=$user->title;
        $image=$user->image;
        $city=$user->city;
        $country=$user->country;
        $startAt=$user->startwork;
        $endAt=$user->endwork;
        $desc=$user->description;

return view('doc')->with([
  'uname'=>$un,'uphone'=>$up,'uemail'=>$ue,
  'nofp'=>$unum,'title'=>$utitle,'image'=>$image,
  'city'=>$city,'country'=>$country,'start'=>$startAt,
  'end'=>$endAt,'desc'=>$desc,
  ]);
    }

    public function updateview(){
       
        $user =Auth::user();
        $un=$user->name;
        $up=$user->phone;
        $ue=$user->email;
        $unum=$user->numofpat;
        $utitle=$user->title;
        $image=$user->image;
        $city=$user->city;
        $country=$user->country;
        $startAt=$user->startwork;
        $endAt=$user->endwork;
        $desc=$user->description;
        $Countrys =Country::all()->toArray();

        return view('doctor.editdata')->with([
            'name'=>$un,'phone'=>$up,'email'=>$ue,
            'nofp'=>$unum,'title'=>$utitle,'image'=>$image,
            'city'=>$city,'country'=>$country,'start'=>$startAt,
            'end'=>$endAt,'location'=>$Countrys,'desc'=>$desc
            ]);;
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function docaddpatview(){
        $country = Country::all();

        return view('doctor.createnewpatient')->with(['country'=>$country]);
    }
    
    public function docaddpat(Request $request){
        try{
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:10|numeric',
            'password' => 'required|min:6',
        ]);


        $docid=Auth::id();
        $password=Hash::make(request('password'));
        // Attempt to log the user in
        User::updateOrCreate([
            'name'=>request('name'),
            'email'=>request('email'),
            'phone'=>request('phone'),
            'country'=>strtolower(request('Country')),
            'city'=>strtolower(request('City')),
            'birthdate'=>request('birthdate'),
            'password'=>$password,
            'docid'=>$docid,
        ]);
    }
        catch(Error $e){
            return 'error';
        }

        // if unsuccessful

        return 'User created successfully';
    
    }
   


////////////////////////////
    public function getpatient(){
        $user =Auth::user();
        $patient=[];
        $patient=array_merge($user->Patient()->select(['id','name','email','phone','country','image','currentstate','status'])->where('currentstate',2)->get()->toArray(),
        $user->Patient()->select(['id','name','email','phone','country','image','currentstate','status'])->where('currentstate',3)->get()->toArray()
        ,$user->Patient()->select(['id','name','email','phone','country','image','currentstate','status'])->where('currentstate',1)->get()->toArray()
    );

    $messcnt=Message::where('Doc_id',$user->id)->where('replied',0)->where('sender',1)->get()->count();

        $allpat=$user->Patient()->select(['id','name','email','phone','country','image','currentstate'])->orderBy('currentstate', 'desc')->get()->toArray();

        $cnt=count($patient);
        return view('doctor.showuser')->with(['patient'=>$patient,'allpat'=>$allpat,'cnt'=>$cnt,'msgcnt'=>$messcnt]);
    }


    public function getonepatient($id){
        /// report
        $reports =User::find($id)->Patreport()->select(['report','date'])->get()->toArray();

        $patient=User::where('id',intval($id))->first()->toArray();
        // dd($patient);
        $userdata = Auth::user();
        $uname = $patient['name'];
        $bof = $patient['birthdate'];
        $uemail = $patient['email'];
        $uphone = $patient['phone'];
        $ucity = $patient['city']; 
        $ucountry = $patient['country'];
        $ucity = $patient['city'];
        $uc=$patient['currentstate'];
        $ustatus='';
        $current='';
        $id=$patient['id'];
        
        if($patient['status'] == 1){
            $ustatus='Normal';   
        }

        else if($patient['status'] == 2){
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

        $finalreport=null;
        // dd(User::find($id)->Death()->get()[0]->toArray());
        if(User::where('id',intval($id))->first()->currentstate==1){
            $finalreport=User::find($id)->Recover()->get()[0]->toArray();
        }
        if(User::where('id',intval($id))->first()->currentstate==3){
            $finalreport=User::find($id)->Death()->get()[0]->toArray();
        }

        $uimage=$patient['image'];
        $isfilled=false;
        $date = date('Y-m-d');
        
        if(isset(Symp::where('patient_id',$patient['id'])->where('date',$date)->first()->date) || isset(Patreport::where('patient_id',$patient['id'])->where('date',$date)->first()->date)){
            $isfilled=true;
        } 


        $symps = SympDeg::select('*')->orderBy('symp_deg')->get()->toArray();
        

        return view('doctor.showonepat')->with(['name'=>$uname, 'email'=>$uemail , 'phone'=>$uphone ,'city'=>$ucity ,
        'country'=>$ucountry,'city'=>$ucity ,'status'=>$ustatus,'image'=>$uimage,
        'start'=>explode(' ',$userdata->created_at)[0],'current'=>$current,
        'filled'=>$isfilled,'bof'=>$bof,'id'=>$id,'reports'=>$reports,'finalreport'=>$finalreport
        ,'syms'=>$symps
        ]);
    }

    
    public function updateimage(){

        $user =Auth::user();
        $image=$user->image;
        $un=$user->name;

        return view('doctor.editimage')->with([
            'name'=>$un,
            'image'=>$image
            ]);;
    }

////////////////////
    
public function updatepass(){
        $user =Auth::user();
        $image=$user->image;
        $un=$user->name;

        return view('doctor.editpass')->with([
            'name'=>$un,
            'image'=>$image
            ]);;
    }


    public function diff_days($id){
        $fdate = User::find($id)->date;
    $tdate = date('Y-m-d');
    $datetime1 = new DateTime($fdate);
    $datetime2 = new DateTime($tdate);
    $interval = $datetime1->diff($datetime2);
    $days = $interval->format('%a');//now do whatever you like with $days
    return $days;
    }

    public function changestate($id){
        $pat=User::where('id',$id)->get()->toArray()[0];
        $fdate = $pat['date'];
        $tdate = date('Y-m-d');
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');//now do whatever you like with $days
        // $patdata=User::find()select(['name','phone','city','country','email'])->get()->toArray();
        return view('doctor.changepatstate')->with(['patdata'=>$pat]);
    }

////////////////////////////////////////

    public function reassign(){
        $user=User::find(request()->id);
        if($user->currentstate===1){
            $user->currentstate=2;
            $user->save();
            return 'reassigned';
        }
        return 'con\'t assgined death as reassigned';

        
    }

/////////////////////////////////
    public function changestatus(Request $r){
        $r=$r->toArray();
        $user=User::find(intval($r['id']));
        if($r['state']==1){
            $user->currentstate=intval($r['state']);
            $user->save();

            Recovered::create([
                'Patient_id'=>intval($user->id),
                'recoverreport'=>$r['finalreport'],
                'date'=>date('Y-m-d')
            ]);
        }
        else{
            $user->currentstate=3;
            $user->save();

            Death::create([
                'Patient_id'=>intval($user->id),
                'deathreport'=>$r['finalreport'],
                'date'=>date('Y-m-d')
            ]);
        }

        return redirect()->route('doc.showmyuser')->with(['enduser'=>'patient data changed successfully']);
    }



    public function update(Request $request){
       
        $Countrys =Country::all()->toArray();

        $userid = Auth::User()->id;
        
        if(null !== request('image')){
        
            $image = request('image')->store('uploads','public');
            $d=Doc::find(Auth::id());
            $d->image=$image;
            $d->save();
    
            return response()->json($image);
    
        }
        
        if(null !== request('username')){
            
            Doc::find($userid)->update([
                'name'=>request('username')
            ]);
            // return view('patient.peditname')->with(['success'=>'username updated successfully']);
        }
       
        if(null !== request('title')){
            
            Doc::find($userid)->update([
                'title'=>request('title')
            ]);
            // return view('patient.peditname')->with(['success'=>'username updated successfully']);
        }


        if(null !== request('description')){
            
            Doc::find($userid)->update([
                'description'=>request('description')
            ]);
        }

        if(null !== request('email')){
            Doc::find($userid)->update([
                'email'=>request('email')
            ]);   
        }
    


        if(null !== request('phone')){
            Doc::find($userid)->update([
                'phone'=>request('phone')
            ]);
        }

        if(null !== request('StartAt')){
            Doc::find($userid)->update([
                'startwork'=>request('StartAt')
            ]);
        }

        if(null !== request('EndAt')){
            Doc::find($userid)->update([
                'endwork'=>request('EndAt')
            ]);
        }

        if(null !== request('city') && null !== request('country')){
            Doc::find($userid)->update([
                'city'=>strtolower(request('city')),
                'country'=>request('country')
            ]);
            
        }

        if(null !== request('password') && null !== request('confirm') ){
            if(request('password')!==request('confirm'))
            {
                return redirect()->back()->with(['fail'=>'pasword dose not match']);
            }else{
                Doc::find($userid)->update([
                    'password'=>Hash::make(request('password')),
                ]);
            }
        }
        return 'success';
    }

    // docmessages 
    public function docmessages(){
        $user=Auth::id();

        $messages=DB::table('messages')
        ->join('users', 'messages.Patient_id', '=', 'users.id')
        ->join('docs', 'messages.Doc_id', '=', 'docs.id')
        ->select('messages.id as id', 'users.id as Patient_id', 'docs.id as Doc_id','sender','message','replied','messages.created_at','users.name as uname','users.image as uimg')
        ->where('sender',1)->where('replied',0)->
        where('messages.Doc_id','=',$user)
        ->orderBy('created_at','desc')
        ->get();

        return view('doctor.docmessages')->with(['messages'=>$messages]);
    }

    ///reply

    public function reply(Request $r){
        $ques=$r->qus_id;
        $pat_id = $r->pat_id;
        $docid=Auth::id();
        $reply=$r->input('reply');
        Message::create(['Patient_id'=>$pat_id,'Doc_id'=>$docid,'sender'=>0,'message'=>$reply]);
// change replied status
        $d=Message::find($ques);
        $d->replied=1;
        $d->save();

        return redirect()->back();
    }

   
}
