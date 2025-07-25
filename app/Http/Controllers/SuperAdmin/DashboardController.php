<?php

namespace App\Http\Controllers\SuperAdmin;
use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Image;
class DashboardController extends Controller
{
   public function dashboard()
    {
        $endDate=date("Y-m-d");
        $startDate=date('Y-m-d', strtotime('-7 days'));
        // echo $endDate; die;
        $data = User::where('role', '=', 'user')->get();
        $userData= DB::table('user')->where("role","user")->get();
        $last_sevenDays_user = DB::table('user')->whereBetween('created_at', ["$startDate", "$endDate"])->count();
        $last_sevenDays_userpackage = DB::table('user_package')->whereBetween('created_at', ["$startDate", "$endDate"])->count();
        $check_activeuser = DB::table('user_package')->where("status","approved")->count();
        // dd($last_sevenDays_user);die;
        $total_user=count($userData);
        $inactiveuser=$total_user-$check_activeuser;
        $last_sevenDays_inactiveuser=$last_sevenDays_user- $last_sevenDays_userpackage;
        $datas=compact('data','total_user','last_sevenDays_user','check_activeuser','last_sevenDays_userpackage','inactiveuser','last_sevenDays_inactiveuser');
        return view('superadmin.Dashboard')->with($datas);
    } 
    

    public function business_setup(){
        // return $req->input();
       
        $bs= DB::table('business_setup')->find(1);

        $data=compact('bs');
        
    return view('superadmin.business_setup')->with($data);
    }
    
     
    public function changeStatus(Request $request){
        
      //  return response()->json(['success'=>'ff'])
        
        $categories = categories::find($request->id);
        $categories->status = $request->status;
        $categories->save();
        return response()->json(['success'=>'Status change successfully.']);
        $id=$request->id;
        $table=$request->table;
        $redirectUrl=$request->redirectUrl;
        if($request->status==0){
            $data['status']=1;
            $res=DB::table($table)->where('id', $id)->update($data);
            if($res>0){
                 return redirect()->route($redirectUrl);
          }else{
                 return redirect()->route($redirectUrl);
            }
            
        }else{
            $data['status']=0;
            $res=DB::table($table)->where('id', $id)->update($data);
            if($res>0){
                return redirect()->route($redirectUrl);
                }else{
                  return redirect()->route($redirectUrl);
            }
            
        }
     }
 
    
    public function mail_config(){
        // return view('mail_config');
        $mc = DB::table('mail_config')->find(1);
        $data = compact('mc');
        return view('superadmin.mail_config')->with($data);
    }
    public function sms_config(){
        $sc = DB::table('sms_config')->find(1);
        $data = compact('sc');
        return view('superadmin.sms_config')->with($data);
    }
    public function social_media(){
        // return view('social_media');
        $sm = DB::table('social_media')->find(1);
        $data = compact('sm');
        return view('superadmin.social_media')->with($data);
        // return view('superadmin.social_media');
    }
    public function payment_config(){
        return view('superadmin.payment_method');
    }
     function plan_setting(){
        return view('superadmin.plan_setting');
    }
    public function welcome_letter_setting(){
         $welcomeletter = DB::table('welcome_letter_setting')->get();
         //dd( $welcomeletter );
        return view('superadmin.welcome_letter_setting',compact('welcomeletter'));
    }
    
   
    
    public function welcome_content(){
         $welcomeletter = DB::table('welcome_letter_setting')->get();
         //dd( $welcomeletter );
         
            return view('superadmin.welcome_content',compact('welcomeletter'));
    }
    
  
    
}












 