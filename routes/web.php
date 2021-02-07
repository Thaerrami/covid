<?php

use App\Http\Middleware\CheckSympToDay;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// handle word = post operation post data and method
///////////////////////////////////*\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
/////////////////////////////////*****\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
///////////////////////////*****welcome*******\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
/////////////////////////////////*****\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
///////////////////////////////////*\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

Auth::routes();
///////////////////////////// general routes \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
Route::get('/home', 'HomeController@index')->name('home');
Route::get('cov/nums','CasenumController@chart');
Route::get('cov/case','CasenumController@chart2');
Route::get('cov/sympnum','Users\Admin\AdminController@getsympcnt');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/addnewsymp','SympDegController@addnewsymp')->name('addnewsymp');
Route::get('/', 'PublicController@welcome');

///////////////////////////////////// patient routes \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

Route::middleware('auth')->group(function () {
Route::post('savesymp','SympDegController@save')->middleware('auth')->name('savesymp');
Route::get('savesymp','SympDegController@save')->middleware('auth')->name('savesymp');
Route::get('symptoday', 'SympController@index')->name('symptoday')->middleware(CheckSympToDay::class);
Route::get('updatepatientprofile',function(){ return view('patient.peditname');});
Route::post('edituserprofile','HomeController@update');
Route::get('edituserprofile','HomeController@update');
Route::put('edituserprofile','HomeController@update');
Route::get('home', 'HomeController@index')->name('home');
Route::get('symp.pist', 'HomeController@index');

/// patient profile edit (views)

Route::get('pie',function(){return view('patient.peditimg');} );//edit image view
Route::get('ppe', function(){return view('patient.pphone');}  );  //edit image phone
Route::get('pee', function(){return view('patient.peditemail');}  );  //edit image email
Route::get('pne', function(){return view('patient.peditname');}  );  //edit image name
Route::get('pbe', function(){return view('patient.editbirthdate');}  );  //edit image birthdate
Route::get('pase',function(){return view('patient.peditpass');}  ); //edit image password
Route::get('ple', 'PublicController@getCountries');//get all countries 
Route::post('/deleteImage', 'PublicController@deleteImage');

Route::get('mysymp',   'HomeController@mysymp')->name('mysymp');
Route::get('mydoctor', 'HomeController@mydoctor')->name('mydoctor');
Route::get('myreport', 'HomeController@myreport')->name('myreport');
Route::post('/maildoc', 'HomeController@maildoc')->name('maildoc');

});


/////////////
/////////////////////////// admin routes /////////////////////////////


Route::prefix('admin')->group(function(){
  Route::get('/', 'Users\Admin\AdminController@index')->name('admin.dashboard');
  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::get('/register', 'Auth\AdminRegisterController@showRegisterForm')->name('admin.register');
  Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');
  ///  admin patient part routs
  Route::get('/showuser', 'Users\Admin\AdminController@showpatient');
  Route::get('/patients', 'Users\Admin\AdminController@getpatient');
  Route::get('/showpat/{id}', 'Users\Admin\AdminController@showpatprof')->name('admin.showpat');

  Route::any('/remindpat', 'Users\Admin\AdminController@remindpat')->name('remindpat');
  Route::get('/adminfindpatient','Users\Admin\AdminController@adminfindpat')->name('admin.find.pat');
  ///  chart update part routs
  Route::get('/updatedaydata','Users\Admin\AdminController@updatedaydata');
  ///  admin edit profile part routs
  Route::get('/editadminview','Users\Admin\AdminController@editadminview')->name('admin.editprofileview');
  Route::post('/editadmin','Users\Admin\AdminController@editadmin')->name('admin.editprofile');
  Route::get('/editdata', 'Users\Admin\AdminController@editadminview')->name('admin.updatedata');
  Route::get('/editimage', 'Users\Admin\AdminController@updateimage')->name('admin.updateimage');
  Route::get('/editpass', 'Users\Admin\AdminController@updatepass')->name('admin.updatepass');
  Route::post('/editprofile', 'Users\Admin\AdminController@update')->name('admin.editprofile');///  admin post updated data
  ///  symp controll part routs
  Route::get('/sympcontroll', 'Users\Admin\AdminController@sympcontroll')->name('admin.sympcontroll');
  // doctors 
  Route::get('/admindoctors', 'Users\Admin\AdminController@getdocs')->name('admin.doctors');
  Route::get('/showadmindoc/{id}', 'Users\Admin\AdminController@getonedoc');
  Route::get('/addnewdoc', 'Users\Admin\AdminController@addnewdocview')->name('addnewdoc');
  Route::post('/adminadddoc','Users\Admin\AdminController@adminadddoc')->name('admin.adddoc');
  Route::get('/adminmaildocview', 'Users\Admin\AdminController@maildocview')->name('admin.maildocview');
  Route::post('/adminmaildoc', 'Users\Admin\AdminController@maildoc')->name('admin.maildoc');
  Route::delete('/deletead', 'Users\Admin\AdminController@deletead');
  Route::post('/updateadvice', 'PublicController@updataAdvice')->name('admin.updateadvice');
  Route::get('/updatedivces','PublicController@getAdvices');
  Route::get('/date/data','PublicController@getSympByDate');
  Route::post('/deleteImage', 'PublicController@deleteImage');
  ////////////////////////
  ////// filter //////////
  ////////////////////////
  Route::post('/filterpatient', 'PublicController@filterPatient');
  Route::post('/filterDoc', 'PublicController@filterDoc');
  
});


////////////////////////
///
////////////////////////////////////////////// doctor routes ###############################


Route::prefix('doc')->group(function(){
  Route::get('/', 'Users\Doc\DocController@index')->name('doc.dashboard'); // 
  Route::post('/changepatstate', 'Users\Doc\DocController@changestatus')->name('doc.changestatus'); 
  Route::get('/login', 'Auth\DocLoginController@showLoginForm')->name('doc.login');
  Route::post('/login', 'Auth\DocLoginController@login')->name('doc.login.submit');
  Route::get('/register', 'Auth\DocRegisterController@showRegisterForm')->name('doc.register');
  Route::post('/register', 'Auth\DocRegisterController@register')->name('doc.register.submit');
// update profile data => image , pass ,name .....
  Route::get('/editdata', 'Users\Doc\DocController@updateview'); // view 
  Route::post('/editdata', 'Users\Doc\DocController@update')->name('doc.updatedata');
  Route::get('/editimage', 'Users\Doc\DocController@updateimage')->name('doc.updateimage');
  Route::get('/editpass', 'Users\Doc\DocController@updatepass')->name('doc.updatepass');
// patient controlling
  Route::get('/showuser', 'Users\Doc\DocController@getpatient')->name('doc.showmyuser');
  Route::get('/showdocpat/{id}', 'Users\Doc\DocController@getonepatient');
  Route::get('/fillpat/{id}', 'SympController@fillpatsymp');//{view} fill my patient symptomes 
  Route::post('/docsavesymp','SympController@docsave')->name('docsavesymp'); //{post} handle symptoms
  Route::get('/changepatstate/{id}', 'Users\Doc\DocController@changestate')->name('doc.cps'); //{view} assign patient death/recover
  Route::post('/reassign', 'Users\Doc\DocController@reassign')->name('doc.reassign');
// docaddpat
// Route::get('/docfindpatient','Users\Doc\DocController@docfindpat')->name('doc.find.pat');//search for paitent name

  Route::get('/docaddpatientview','Users\Doc\DocController@docaddpatview')->name('doc.add.pat.view');//add paitent view
  Route::post('/docaddpatient','Users\Doc\DocController@docaddpat')->name('doc.add.pat');// post the new user data 
  Route::get('/filter', 'Users\Doc\DocController@filterpatient')->name('doc.filterpat');//filter
// messaging
  Route::post('/docreply/{pat_id}/{qus_id}','Users\Doc\DocController@reply')->name('doc.reply');
  Route::get('/docmessages','Users\Doc\DocController@docmessages')->name('doc.messages');
  Route::post('/filterpatient', 'PublicController@filterPatient');
  Route::post('/deleteImage', 'PublicController@deleteImage');
});


/////////
/////////////////////////////////////////*public routes not assosiated to user*\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
////////
Route::view('/about', 'about')->name('about');/// contains my cv
Route::get('/help', 'PublicController@getHelpMessages')->name('help');//get help messsages
Route::post('/helpquestion', 'PublicController@sendHelp')->name('helpquestion');///send help message

