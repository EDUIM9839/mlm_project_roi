<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IncomeHistory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Auth;
use Hash;

class ProfileController extends Controller
{
   
    public function profile(Request $request){
 
        $id=$request->id;
        $ps= DB::table('user')->where('id',"=",$id)->get();
 
        return view('user.profile',compact('ps'));
    }
    public function idcard(Request $request){
         return view("user.id-card");
    }
     public function profile_update(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());die;
        $userId = Auth::id();
        // dd($userId);die;
    //   $userid=$request->input('userid');
       $first_name=$request->input('first_name');
       $last_name=$request->input('last_name');
       $contact=$request->input('contact');
       $password=$request->input('password');
       $email=$request->input('email');
       $bank_name=$request->input('bank_name');
       $tron_address=$request->input('tron_address');
       $account_no=$request->input('account_no');
       $ifsc_code=$request->input('ifsc_code');
       $account_holder_name=$request->input('account_holder_name');
       $nomini_name=$request->input('nomini_name');
       $nomini_contact=$request->input('nomini_contact');
       $nomini_relation=$request->input('nomini_relation');
       $pan=$request->input('pan');
       $g_pay=$request->input('g_pay');
       $paytm_no=$request->input('paytm_no');
       $phone_pay=$request->input('phone_pay');
       $branch_details=$request->input('branch_detail');
       $city=$request->input('city');
       $state=$request->input('state');
       $country=$request->input('country');
       $pincode=$request->input('zip');
       $address=$request->input('address');
       $id=$request->input('id');
             
        if($request->file('pan_img') && $request->file('file')){
                 
            $pan_img=$request->file('pan_img');
            $file = $request->file('file');
            
         $filenames = 'IMG_'.time(). "." .$pan_img->getClientOriginalExtension();
         $filename = 'IMG_'.time(). "." .$file->getClientOriginalExtension();
        //  dd($filenames,$filename);
        $path='profileupload/';
        $request->file('pan_img')->storeAs($path, $filenames);
        $request->file('file')->storeAs($path, $filename);
        
            DB::table('user')->where('id',$userId)->update(array('first_name' => $first_name, 'last_name' => $last_name,'contact'=>$contact, 'email'=>$email, 'bank_name'=>$bank_name, 'account_no'=>$account_no,'ifsc_code'=>$ifsc_code, 'account_holder_name'=>$account_holder_name,'tron_address'=> $tron_address, 'nomini_name'=>$nomini_name, 'nomini_contact'=>$nomini_contact, 'nomini_relation'=>$nomini_relation,'g_pay'=>$g_pay,'paytm_no'=>$paytm_no,'phone_pay'=>$phone_pay,'branch_detail'=>$branch_details,'image'=>$filename,'pan'=>$pan ,'pan_img'=>$filenames, 'city'=>$city, 'state'=>$state,'country'=>$country,'zip'=>$pincode,'address'=>$address));
       }elseif($request->file('pan_img')){
        $pan_img=$request->file('pan_img');
        $filenames = 'IMG_'.time(). "." .$pan_img->getClientOriginalExtension();
        $path='profileupload/';
        $request->file('pan_img')->storeAs($path, $filenames);
           // $file->move(public_path("upload/userprofile/"), $filename);
         DB::table('user')->where('id',$userId)->update(array('first_name' => $first_name, 'last_name' => $last_name,'contact'=>$contact, 'email'=>$email,  'bank_name'=>$bank_name, 'account_no'=>$account_no,'ifsc_code'=>$ifsc_code, 'account_holder_name'=>$account_holder_name, 'tron_address'=> $tron_address,'nomini_name'=>$nomini_name, 'nomini_contact'=>$nomini_contact, 'nomini_relation'=>$nomini_relation,'g_pay'=>$g_pay,'paytm_no'=>$paytm_no,'phone_pay'=>$phone_pay,'branch_detail'=>$branch_details,'pan'=>$pan,'pan_img'=>$filenames, 'city'=>$city, 'state'=>$state,'country'=>$country,'zip'=>$pincode,'address'=>$address ));
       }elseif($request->file('file')) {
        $file = $request->file('file');
        $filename = 'IMG_'.time(). "." .$file->getClientOriginalExtension();
        $path='profileupload/';
        $request->file('file')->storeAs($path, $filename);
        
        // $file->move(public_path("upload/userprofile/"), $filename);
         DB::table('user')->where('id',$userId)->update(array('first_name' => $first_name, 'last_name' => $last_name,'contact'=>$contact, 'email'=>$email, 'bank_name'=>$bank_name, 'account_no'=>$account_no,'ifsc_code'=>$ifsc_code, 'account_holder_name'=>$account_holder_name,'tron_address'=> $tron_address, 'nomini_name'=>$nomini_name, 'nomini_contact'=>$nomini_contact, 'nomini_relation'=>$nomini_relation,'g_pay'=>$g_pay,'paytm_no'=>$paytm_no,'phone_pay'=>$phone_pay,'branch_detail'=>$branch_details,'image'=>$filename,'pan'=>$pan, 'city'=>$city, 'state'=>$state,'country'=>$country,'zip'=>$pincode,'address'=>$address ));
       }
       else{
           DB::table('user')->where('id',$userId)->update(array('first_name' => $first_name, 'last_name' => $last_name,'contact'=>$contact, 'email'=>$email, 'bank_name'=>$bank_name, 'account_no'=>$account_no,'ifsc_code'=>$ifsc_code, 'account_holder_name'=>$account_holder_name,'tron_address'=> $tron_address, 'nomini_name'=>$nomini_name, 'nomini_contact'=>$nomini_contact, 'nomini_relation'=>$nomini_relation,'g_pay'=>$g_pay,'paytm_no'=>$paytm_no,'phone_pay'=>$phone_pay,'branch_detail'=>$branch_details,'pan'=>$pan, 'city'=>$city, 'state'=>$state,'country'=>$country,'zip'=>$pincode,'address'=>$address)); 
       } 
       if($request->password){
           $password = Hash::make($request->password);
        //   dd($password);
          $data=DB::table('user')->where('id',$userId)->update(array('password' => $password)); 
          if($data){
              $msg="Password Updated Successfully";
              $request->session()->flash('success',$msg); 
          }else{
              $msg1="Password Not Updated Successfully";
             $request->session()->flash('error',$msg1);
          }
        }
        $msg="Profile Updated Successfully";
       $request->session()->flash('success',$msg);
       
        return redirect()->back();
    }
}

