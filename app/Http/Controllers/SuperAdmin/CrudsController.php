<?php
 namespace App\Http\Controllers\SuperAdmin;
 use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class CrudsController extends Controller 

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

     $bs= Crud::find($id);  
     return view('edit', compact('bs'));  
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
         
       
        $request->validate([   //  validating the name field.  
        'email'=>'required|email|max:255', 
        'business_name'=>'required|max:255',
         'phone'=>'required| min:10',
          'country'=>'required ',
           'time_zone'=>'required',
            'time_format'=>'required',
             'currency_symbol'=>'required ',
              'id_prefix'=>'required ',
               'address'=>'required ',
                'footer_text'=>'required',
                 'tax_amount'=>'required',
                //   'logo'=>'required ',
                //   'fav_icon'=>'required ',
                  'closing_time'=>'required',
                   'opening_day'=>'required',
                    'closing_day'=>'required',
                    'business_unit'=>'required',
        
        ]);  
         if(isset($request['pending_user_all_page_access'])){
            
            $parul='active';
            
        }else{
            
            $parul='inactive';
            
        }
        
       
         $business_setuptable= DB::table('business_setup')->get();
        $oldlogo=$business_setuptable['0']->logo;
        $oldfav_icon=$business_setuptable['0']->fav_icon;
        $e_sign=$business_setuptable['0']->e_sign;
        // dd($request->all());
        $business_name = $request->input('business_name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $country = $request->input('country');
        $time_zone = $request->input('time_zone');
        $time_format = $request->input('time_format');
        $currency_symbol = $request->input('currency_symbol');
        $id_prefix = $request->input('id_prefix');
        $address = $request->input('address');
        $footer_text = $request->input('footer_text');
        $tax_amount = $request->input('tax_amount');
        $opening_time = $request->input('opening_time');
        $opening_day = $request->input('opening_day');
        $closing_day = $request->input('closing_day');
        $closing_time = $request->input('closing_time');
        $business_unit = $request->input('business_unit');
        
        $pending_user_all_page_access = 'parul';
        
        if ($request->file('logo') && $request->file('fav_icon') && $request->file('e_sign')) {
        
        Storage::delete("logo/{$oldlogo}");
        Storage::delete("logo/{$oldfav_icon}");
        Storage::delete("logo/{$e_sign}");
        $e_sign = $request->file('e_sign');
        $fav_icons = $request->file('fav_icon');
        $file = $request->file('logo');
        $filename = 'LOGO_'.time() . "." . $file->getClientOriginalExtension();
        $fav_icon = 'FAV_'.time() . "." . $fav_icons->getClientOriginalExtension();
         $e_sign = 'E_Sign_'.time() . "." . $e_sign->getClientOriginalExtension();
        $path='logo/';
        $request->file('logo')->storeAs($path, $filename);
        $request->file('fav_icon')->storeAs($path, $fav_icon);
        DB::update('update business_setup set business_name = ?,email=?,country=?,phone=?,time_zone=?,time_format=?,currency_symbol=?,id_prefix=?, business_unit=?,address=?,footer_text=?,tax_amount=?,logo=?,fav_icon=?,opening_time=?,opening_day=?,closing_day=?,closing_time=?,pending_user_all_page_access=?,e_sign=? where id = 1',
        [$business_name,$email,$country,$phone,$time_zone,$time_format,$currency_symbol,$id_prefix,$business_unit,$address,$footer_text,$tax_amount,
        $filename,$fav_icon,$opening_time,$opening_day,$closing_day,$closing_time,$parul,$e_sign]);
        
        
        
        }elseif($request->file('logo')){
           Storage::delete("logo/{$oldlogo}");
        $file = $request->file('logo');
        $filename = 'LOGO_'.time() . "." . $file->getClientOriginalExtension();
        $path='logo/';
        $request->file('logo')->storeAs($path, $filename);
        DB::update('update business_setup set business_name = ?,email=?,country=?,phone=?,time_zone=?,time_format=?,currency_symbol=?,id_prefix=?,business_unit=?, address=?,footer_text=?,tax_amount=?,logo=?,opening_time=?,opening_day=?,closing_day=?,closing_time=?,pending_user_all_page_access=? where id = 1',
        [$business_name,$email,$country,$phone,$time_zone,$time_format,$currency_symbol,$id_prefix,$business_unit,$address,$footer_text,$tax_amount,
        $filename,$opening_time,$opening_day,$closing_day,$closing_time,$parul]);
        }elseif($request->file('fav_icon')){
        Storage::delete("logo/{$oldfav_icon}");
        $fav_icons = $request->file('fav_icon');
        $fav_icon = 'FAV_'.time() . "." . $fav_icons->getClientOriginalExtension();
        $path='logo/';
        $request->file('fav_icon')->storeAs($path, $fav_icon);
        DB::update('update business_setup set business_name = ?,email=?,country=?,phone=?,time_zone=?,time_format=?,currency_symbol=?,id_prefix=?,business_unit=?, address=?,footer_text=?,tax_amount=?,fav_icon=?,opening_time=?,opening_day=?,closing_day=?,closing_time=?,pending_user_all_page_access=? where id = 1',
        [$business_name,$email,$country,$phone,$time_zone,$time_format,$currency_symbol,$id_prefix,$business_unit,$address,$footer_text,$tax_amount,$fav_icon,$opening_time,$opening_day,$closing_day,$closing_time,$parul]);
            
        }elseif($request->file('e_sign')){
          Storage::delete("logo/{$e_sign}");
        $file = $request->file('e_sign');
        $filename = 'E_Sign_'.time() . "." . $file->getClientOriginalExtension();
        $path='logo/';
        $request->file('e_sign')->storeAs($path, $filename);
        DB::update('update business_setup set business_name = ?,email=?,country=?,phone=?,time_zone=?,time_format=?,currency_symbol=?,id_prefix=?,business_unit=?, address=?,footer_text=?,tax_amount=?,e_sign=?,opening_time=?,opening_day=?,closing_day=?,closing_time=?,pending_user_all_page_access=? where id = 1',
        [$business_name,$email,$country,$phone,$time_zone,$time_format,$currency_symbol,$id_prefix,$business_unit,$address,$footer_text,$tax_amount,
        $filename,$opening_time,$opening_day,$closing_day,$closing_time,$parul]);
        }else{
            //  dd("sanchit");
            DB::update('update business_setup set business_name = ?,email=?,country=?,phone=?,time_zone=?,time_format=?,currency_symbol=?,id_prefix=?,business_unit=?, address=?,footer_text=?,tax_amount=?,opening_time=?,opening_day=?,closing_day=?,closing_time=?,pending_user_all_page_access=?,e_sign=? where id = 1',
        [$business_name,$email,$country,$phone,$time_zone,$time_format,$currency_symbol,$id_prefix,$business_unit,$address,$footer_text,$tax_amount,$opening_time,$opening_day,$closing_day,$closing_time,$parul,$e_sign]);
        }
        
        $msg=" Updated Successfully";
       $msgs=session()->flash('success',$msg);
       
        return redirect()->route('business_setup');
        // return redirect('business_setup');

} 
    
    //Plan Setting
    public function rank_store(Request $request)
    {
        // dd($request->all());
         
        $name=$request->input('name');
        $target=$request->input('target');
        $percent=$request->input('percent');
        $file = $request->file('rank_image');
        $filename = 'LOGO_'.time() . "." . $file->getClientOriginalExtension();
        // dd($request->all());die;
        $path='rankImages/';
         $request->file('rank_image')->storeAs($path, $filename);
       
        DB::insert('insert into reward_vip (name, target, percent, medals) values(?,?,?,?)',[$name,$target,$percent,$filename]);
        return redirect()->back()->with('status','Added Successfully');
    }
     public function update_rank(Request $request){
        $rank= DB::table('reward_vip')->get();
        $id=$request->input('id');
        $name = $request->input('name');
        $target = $request->input('target');
        $percent = $request->input('percent');      
        if($request->file('rank_image')){
        $file = $request->file('rank_image');
        $filename = 'LOGO_'.time() . "." . $file->getClientOriginalExtension();
        $path='rankImages/';
        $request->file('rank_image')->storeAs($path, $filename);
        DB::update('update reward_vip set name=?,percent=?,target=?,medals=? where id='.$id.'',[$name,$percent,$target,$filename]);
    }else{
    DB::update('update reward_vip set name=?,percent=?,target=? where id='.$id.'',[$name,$percent,$target]);

    } 
     Session::flash('message', "<p class='alert alert-success'>Record has been successfully Updated</p><br>");
        return redirect()->route('rank_commission');
    }
    // end plan setting
    
    public function updatemail(Request $request){
        $mailer_name = $request->input('mailer_name');
        $host = $request->input('host');
        $driver = $request->input('driver');
        $port = $request->input('port');
        $username = $request->input('username');
        $email = $request->input('email');
        $encryption = $request->input('encryption');
        $password = $request->input('password');
        DB::update('update mail_config set mailer_name = ?, host=?, driver=?, port=?, username=?, email=?, encryption=?, password=? where id=1',[$mailer_name,$host,$driver,$port,$username,$email,$encryption,$password]);
        // return redirect('mail_config');
        return redirect()->route('mail_config');
    }
    public function updatesocial(Request $request){
        $name = $request->input('name');
        $social_url = $request->input('social_url');
        DB::update('update social_media set name=?, social_url=? where id=1',[$name,$social_url]);
        // return redirect('social_media');
        return redirect()->route('social_media');
    }
    public function updatetwilio(Request $request){
        $sid = $request->input('sid');
        $messaging_service_sid = $request->input('messaging_service_sid');
        $token = $request->input('token');
        $from_twilio = $request->input('from_twilio');
        $otp_template_twilio = $request->input('otp_template_twilio');
        
        DB::update('update sms_config set sid=?,messaging_service_sid=?,token=?,from_twilio=?,otp_template_twilio=? where id=1',[$sid,$messaging_service_sid,$token,$from_twilio,$otp_template_twilio]);
        // return redirect('sms_config');
        return redirect()->route('sms_config');
    }
    public function updatenexmo(Request $request){
         $api_key_nexmo = $request->input('api_key_nexmo');
        $api_secret = $request->input('api_secret');
        $from_nexmo = $request->input('from_nexmo');
        $otp_template_nexmo = $request->input('otp_template_nexmo');
        DB::update('update sms_config set api_key_nexmo=?,api_secret=?,from_nexmo=?,otp_template_nexmo=? where id=1',[$api_key_nexmo,$api_secret,$from_nexmo,$otp_template_nexmo]);
        return redirect()->route('sms_config');
    }
    public function updatetwofactor(Request $request){
        $api_key_factor = $request->input('api_key_factor');
        DB::update('update sms_config set api_key_factor=? where id=1',[$api_key_factor]);
        return redirect()->route('sms_config');
    }
    public function updatemsg(Request $request){
        $template_id_msg = $request->input('template_id_msg');
        $auth_key = $request->input('auth_key');
        DB::update('update sms_config set template_id_msg=?,auth_key=? where id=1',[$template_id_msg,$auth_key]);
        // return redirect('sms_config');
        return redirect()->route('sms_config');
    }
    public function update_joining_percentage(Request $request){
        $joining_percentage = $request->input('joining_percentage');
        $star_joining_pkg = $request->input('star_joining_pkg');
        $status = $request->input('status');
        DB::update('update app_config set joining_percentage=?, star_joining_pkg=?, status=? where id=1', [$joining_percentage,$star_joining_pkg,$status]);
        // return redirect('joining_percentage');
        return redirect()->route('joining_percentage');
    }
    public function update_notification(Request $request){
        $notification = $request->input('description');
        DB::update('update notification set description=? where id=1',[$notification]);
        // return redirect('notification');
        return redirect()->route('notification');
    }

  // code of All user edit 
    
     public function user_update(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());die;
       $userid=$request->input('userid');
       $first_name=$request->input('first_name');
       $last_name=$request->input('last_name');
       $contact=$request->input('contact');
       $email=$request->input('email');
       $city=$request->input('city');
       $state=$request->input('state');
       $country=$request->input('country');
       $address=$request->input('address');
       $aadhar_no=$request->input('aadhar_no');
       $bank_name=$request->input('bank_name');
       $account_no=$request->input('account_no');
       $ifsc_code=$request->input('ifsc_code');
       $account_holder_name=$request->input('account_holder_name');
       $nomini_name=$request->input('nomini_name');
       $nomini_contact=$request->input('nomini_contact');
       $nomini_relation=$request->input('nomini_relation');
       $pan=$request->input('pan');
       $id=$request->input('id');
    //   dd($request->file('image'));
       if ($request->file('image')) {
        $file = $request->file('image');
        $filename = 'IMG_'.time() . "." . $file->getClientOriginalExtension();
        $path='profileupload/';
        $request->file('image')->storeAs($path, $filename);
        // $file->move(public_path("upload/userprofile/"), $filename);
         DB::table('user')->where('id',$id)->update(array('first_name' => $first_name, 'last_name' => $last_name,'contact'=>$contact, 'email'=>$email, 'city'=>$city, 'state'=> $state, 'country'=>$country,'address'=>$address, 'aadhar_no'=>$aadhar_no, 'bank_name'=>$bank_name, 'account_no'=>$account_no,'ifsc_code'=>$ifsc_code, 'account_holder_name'=>$account_holder_name, 'nomini_name'=>$nomini_name, 'nomini_contact'=>$nomini_contact, 'nomini_relation'=>$nomini_relation,'image'=>$filename,'pan'=>$pan));
       }else{
           DB::table('user')->where('id',$id)->update(array('first_name' => $first_name, 'last_name' => $last_name,'contact'=>$contact, 'email'=>$email, 'city'=>$city, 'state'=> $state, 'country'=>$country,'address'=>$address, 'aadhar_no'=>$aadhar_no, 'bank_name'=>$bank_name, 'account_no'=>$account_no,'ifsc_code'=>$ifsc_code, 'account_holder_name'=>$account_holder_name, 'nomini_name'=>$nomini_name, 'nomini_contact'=>$nomini_contact, 'nomini_relation'=>$nomini_relation,'pan'=>$pan)); 
       }
         Session::flash('message', "<p class='alert alert-success'>Record has been successfully Updated</p><br>");
        return redirect()->route('user-list');
        
    }
    
    
    // public function getEditData(Request $request)
    // {
        
    //     $id=$request->editid;
    //     $res=DB::table('reward_vip')->where('id' , $id)->get();
    //     $data['name']=$res['0']->name;
    //     $data['target']=$res['0']->target;
    //     $data['percent']=$res['0']->percent;
    //     $data['medals']=$res['0']->medals;
    //     echo json_encode($data);

    //  }

    public function getEditData(Request $request)
    {
        $id=$request->editid;
        // dd($id);die;
        $res=DB::table('reward_vip')->where('id' , $id)->get();
        $data['name']=$res['0']->name;
        $data['target']=$res['0']->target;
        $data['percent']=$res['0']->percent;
        $data['medals']=$res['0']->medals;
        echo json_encode($data);
     }

    
    public function change_password (request $request)
    {
        //  dd($request->user_id);
        $userid=$request->user_id;
        $pass=$request->password;
        $password = Hash::make($pass);
        $data = User::where('userid',$userid)->update(['password'=>$password]);   
        // dd($data);
        if($data)
        {
        $msg='Password has been successfully Updated';
         $request->session()->flash('success',$msg);
        }
        else{
            $msg='Password Not Update Successfully';
            $request->session()->flash('error',$msg);
        }
        return redirect()->route('change_password');
       
        
        
    }
     public function add_product(){
        
        $title='Add Product';
        $bussiness_setup=DB::table('business_setup')->get();
        $category = DB::table('categories')->get();
        return view('superadmin.add-product', compact('title', 'category', 'bussiness_setup'));
        
    }
}

