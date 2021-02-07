<?php

namespace App\Http\Controllers\Users\Admin;

use App\Casenum;
use App\Death;
use App\Doc;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Recovered;
use App\Symp;
use App\SympDeg;
use App\User;
use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Util\Json;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $this->updatedaydata();
        $todaynews = Casenum::where('date',date('Y-m-d'))->get()->toArray()[0];
        $allcases  =User::all()->count();
        $allrecover=User::where('currentstate',1)->count();
        $alldeaths =User::where('currentstate',3)->count();
        $count = count(User::all()->toArray());
        return view('admin')->with(['count'=>$count,'breaf'=>$todaynews,'c'=>$allcases,'r'=>$allrecover,'d'=>$alldeaths]);
    }

    // cases charts data

    public function updatecharts(){

        $nump= User::where('date','=',date('Y-m-d'))->count();
        $good=User::where('date','=',date('Y-m-d'))->where('status','=',1)->count();
        $mid=User::where('date','=',date('Y-m-d'))->where('status','=',2)->count();
        $bad=User::where('date','=',date('Y-m-d'))->where('status','=',3)->count();
        $recover=User::where('currentstate','=',1)->count();
        $good=dd(User::where('date','>','2020-11-21')->where('status','=',1)->count());

    }

// show patient assosiated with system

    public function showpatient(){

        $allpat=User::select(['id','name','email','phone','country','image','currentstate'])->orderBy('created_at', 'desc')->get()->toArray();
        $patient=User::select(['id','name','email','phone','country','image','currentstate'])->orderBy('created_at', 'desc')->get()->toArray();
        $cnt=count($patient);
        return view('admin.showuser')->with(['patient'=>$patient,'allpat'=>$allpat,'cnt'=>$cnt]);
    }

    public function  adminfindpat(){
        $patname=request('patname');
        
        $allpat=User::select(['id','name','email','phone','country','image','currentstate'])->orderBy('created_at', 'desc')->get()->toArray();
        $patient=User::select(['id','name','email','phone','country','image','currentstate'])->where('name','LIKE','%'.$patname.'%')->orderBy('created_at', 'desc')->get()->toArray();
        $c=count($patient);
        return view('admin.showuser')->with(['patient'=>$patient,'allpat'=>$allpat,'cnt'=>$c]);
    }

    public function showpatprof($id){
        $reports =User::find($id)->Patreport()->select(['report','date'])->get()->toArray();

        $patient=User::where('id',intval($id))->first()->toArray();
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
       
        if(User::where('id',intval($id))->first()->currentstate==1){
            $finalreport=User::find($id)->Recover()->get()[0]->toArray();
        }
        if(User::where('id',intval($id))->first()->currentstate==3){
            $finalreport=User::find($id)->Death()->get()[0]->toArray();
        }


        $uimage=$patient['image'];
        $isfilled=false;
        $date = date('Y-m-d');
        
         if(isset(Symp::where('patient_id',$patient['id'])->where('date',$date)->first()->date)){
            $isfilled=true;
         }



        return view('admin.showpat')->with(['name'=>$uname, 'email'=>$uemail , 'phone'=>$uphone ,'city'=>$ucity ,
        'country'=>$ucountry,'city'=>$ucity ,'status'=>$ustatus,'image'=>$uimage,
        'start'=>explode(' ',$userdata->created_at)[0],'current'=>$current,
        'filled'=>$isfilled,'bof'=>$bof,'id'=>$id,'reports'=>$reports,'finalreport'=>$finalreport
        ]);

    }

    // adminaddpat

////////////////////////////////filter patient
   

// not used function to get data
 

public function deletead(Request $r){
    DB::table('advice')->where('id',$r->deleteid )->delete();
    return  'delete successfuly';
}


//////


    public function getpatient(){
        $patient=User::select(['name','email','phone','country','image','currentstate']);
        
        exit;
      
    }

// update data for today manually
    
    public function updatedaydata(){
        $newcases = User::where('date',date('Y-m-d'))->count(); 
        $norcase=User::where('currentstate',2)->where('status',1)->count();
        $midcase=User::where('currentstate',2)->where('status',2)->count();
        $dangercase=User::where('currentstate',2)->where('status',3)->count();
        $recovered=Recovered::where('date',date('Y-m-d'))->count();
        $death=Death::where('date',date('Y-m-d'))->count();
        $date=date('Y-m-d');

//create or update today data

        Casenum::updateOrCreate(
            ['date'=>date('Y-m-d')],
        [
            'daycase'=>$newcases,
            'norcase'=>$norcase,
            'midcase'=>$midcase,
            'dancase'=>$dangercase,
            'death'=>$death,
            'recover'=>$recovered,
            'date'=>$date
        ]);

/// end of function and return to back

        return redirect()->back();
    }

    public function editadminview(){
        $prof=Admin::find(Auth::id())->get()->toArray();
      
        return view('admin.editdata')->with(['data'=>$prof[0]]);  
    }

    public function editadmin(){
        dd(Admin::find(Auth::id())->get()->toArray());
    }


    public function updateimage(){

        $user =Auth::user();
        $image=$user->image;
        $un=$user->name;

        return view('admin.editimage')->with([
            'name'=>$un,
            'image'=>$image
            ]);;
    }

    public function updatepass(){

        $user =Auth::user();
        $image=$user->image;
        $un=$user->name;

        return view('admin.editpass')->with([
            'name'=>$un,
            'image'=>$image
            ]);;
    }

///////////////////////////////update profile admin
    public function update(Request $request){

        $userid = Auth::User()->id;
        
        if(null !== request('image')){
        
        $image = request('image')->store('uploads','public');
        $d=Admin::find(Auth::id());
        $d->image=$image;
        $d->save();

        return response()->json($image);

    }
        
        if(null !== request('username')){
            
        Admin::find($userid)->update([
                'name'=>request('username')
            ]);
            // return view('patient.peditname')->with(['success'=>'username updated successfully']);
        }

        if(null !== request('email')){
        
        Admin::find($userid)->update([
                'email'=>request('email')
            ]);   
        }

        if(null !== request('phone')){
        
        Admin::find($userid)->update([
                'phone'=>request('phone')
            ]);
        }


        if(null !== request('delete')){
            Admin::find($userid)->delete([
                'image'
            ]);
        }
       
       

        if(null !== request('password') && null !== request('confirm') ){
            if(request('password')!==request('confirm'))
            {
                return redirect()->back()->with(['fail'=>'pasword dose not match']);
            }else{
                Admin::find($userid)->update([
                    'password'=>Hash::make(request('password')),
                ]);
            }
        }

        return redirect()->back();
    }


/////////////////////edit add symptoms

    public function sympcontroll(){
        $symp =
        DB::select('SELECT COUNT(*) as num,symp_degs.title as title FROM symps, symp_degs WHERE symps.symp_id = symp_degs.id GROUP BY symps.symp_id');

        return view('admin.editsymp')->with(['symps'=>$symp]);
    }

/////////////////////////////////
    public function getsympcnt(){
        $result=
        DB::select('SELECT COUNT(*) as num,symp_degs.title as title FROM symps, symp_degs WHERE symps.symp_id = symp_degs.id GROUP BY symps.symp_id');
        
        return response()->json($result);
    }

/////////////////show docs 
    public function getdocs(){
        $docs=Doc::all();
        $count=count($docs);
        return view('admin.doctors')->with(['docs'=>$docs,'cnt'=>$count]);
    }

/////////////////// show doc profile
    public function getonedoc($id){

        $user=Doc::where('id',intval($id))->first()->toArray();
        // dd($patient);
        
        $un=$user['name'];
        $up=  $user['phone'];
        $ue=  $user['email'];
        $unum=Doc::where('id',intval($id))->first()->Patient()->count();
        $utitle=$user['title'];
        $image=$user['image'];
        $city=$user['city'];
        $country=$user['country'];
        $startAt=$user['startwork'];
        $endAt=$user['endwork'];
        $desc=$user['description'];

        return view('doctor.showonedoc')->with([
          'uname'=>$un,'uphone'=>$up,'uemail'=>$ue,
          'nofp'=>$unum,'title'=>$utitle,'image'=>$image,
          'city'=>$city,'country'=>$country,'start'=>$startAt,
          'end'=>$endAt,'desc'=>$desc,
          ]);
    }
//////////////////////////////////////////////////////add doctor
    public function addnewdocview(){
        $country = Country::all();
        return view('admin.adddoc')->with(['country'=>$country]);
    }

//////////////////////////create new doctor
    public function adminadddoc(Request $request){
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:10|numeric',
            'password' => 'required|min:6',
        ]);


        $docid=Auth::id();
        $password=Hash::make(request('password'));
        // Attempt to log the user in
        Doc::updateOrCreate([
            'name'=>request('name'),
            'email'=>request('email'),
            'phone'=>request('phone'),
            'country'=>strtolower(request('Country')),
            'city'=>strtolower(request('City')),
            'startwork'=>request('startwork'),
            'endwork'=>request('endwork'),
            'password'=>$password,
        ]);
        
        

        return view('admin.adddoc')->with(['success'=>'Doctor created successfully','country'=>Country::all()]);
    
    }


//////////////////////////////// my mailer
public function mailtopat($name,$email,$mesg,$template){
    $to_name = $name;
  $to_email = $email;
  $data = array('name'=>$name, "body" => $mesg);
    Mail::send($template, $data, function($message) use ($to_name, $to_email) {
      $message->to($to_email, $to_name)
      ->subject('Graduation project thaer');
      $message->from('mailer.laravel.php@gmail.com','Covida');
      });
}
////////////////////admin mail pats



////////////////////////////////////////////

public function remindpat(){
$mesg="Please make sure to fill your daily symptoms today";
$template ='emails.mail';

$users=$this->notfilledpat();
// 'emails.mail'
foreach($users as $user){
  $this->mailtopat($user['name'],$user['email'],$mesg,$template);
  }

return redirect()->back();
}


/////////////////doc amil view

public function maildocview(){
return view('admin.maildocview');
}

public function maildoc(Request $r){
    $mesg=$r->input('email');
    $template='emails.mail';
    foreach(Doc::all() as $doc){
        $this->mailtopat($doc->name,$doc->email,$mesg,$template);   
    }
    return redirect()->back()->with(['success'=>'message sent successfuly']);
}

//************end of class**************//
}