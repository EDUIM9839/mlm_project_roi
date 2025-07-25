<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Validator;
use App\Models\User;
use DB;
use Mail;
use App\Mail\DemoMail;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\BtreeController;
class UserController extends Controller
{
public function login_validate(Request $request){


    $status=201;
     $data=array('status'=>$status,
    'msg'=>'Something went wrong / Wrong credentials');
    $credentials = $request->only('userid', 'password','id');
    
    if (Auth::attempt($credentials)) {

        if(Auth::user()->role=='user'){
                $status=200;
              $data['status']=$status;
            $data['msg']='Login Successfully';
            $data['data']=Auth::user();
            $data['token']=Auth::user()->createToken('myToken')->plainTextToken;
        }
    }

    return response()->json($data,$status);

}
public function user_list(){
  $user=User::where('role','user')->get();
  return response()->json($user);
}
 public function userId($prefix='ABC')
    {
        $rand = rand(10000, 99999);
        $userid = str_replace(" ", "_", $prefix) . $rand;
        return $userid;
    }
public function register(Request $request){
    
        $validator = Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' =>'required',
        ]);
        
        

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response , 404);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input ['password']);
        $prefix=DB::table('business_setup')->first()->id_prefix;
        $userid=$this->userId($prefix);
        $input['userid']=$userid;
        $user = User::create($input);
       
        $data['token'] = $user->createToken('myToken ')->plainTextToken;
            
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Registered Successfully'
            ];
            return response()->json($response , 200);
    }
    public function forget_password(Request $request)
    
        {
            
       $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

       if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response , 404);
        }

        $user = User::Where(['email' => $request['email']])->get();
     
        if (!empty($user[0]->id)) {
           
            $mailData = [
            'otp'=>rand(10000,99999),
        
        ];
        $get_email = $user[0]->email;
        DB::table('user')->where('email',$get_email)->update($mailData);
           Mail::to($user[0]->email)->send(new DemoMail($mailData));
            // Mail::to($user['email'])->send(new \App\Mail\PasswordResetMail($token));
            return response()->json(['otp' =>"Your OTP is: " .$mailData['otp'] , 'message' => 'Email sent successfully.'], 200);
            
        }
        return response()->json(['errors' => [
            ['code' => 'not-found', 'message' => 'Email not found!']
        ]], 404);
    }
    
    
     public function verify_otp(Request $request)
    
        {
            // die("test");
       $validator = Validator::make($request->all(), [
            'email' => 'required',
            'otp' =>'required',
        ]);

       if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response , 404);
        }
            
        $user = User::Where(['email' => $request['email']])->where(['otp' => $request['otp']])->get();
     
        if (!empty($user[0]->id)) {
          
         return response()->json(['message' => 'Verified Successfully.'], 200);
          
            
        }else{
            return response()->json(['errors' => [
            ['code' => 'not-found', 'message' => 'Verification Failed!']
        ]], 404);
        }
        
    }
    
    
    public function reset_password(Request $request){
        // die("test");
        $validator = Validator::make($request->all(),[
            'userid' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
           
            ]);
            if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response , 404);
        }
                $hashedpassword=Hash::make($request->password);
                $password=$hashedpassword;
        $userid = $request['userid'];
        $user = User::Where(['userid' => $request['userid']])->get();
        if(!empty($user[0]->id)){
            $data = [
                'password'=> $password,
                'decrypted_password'=>$request->password,
                ];
                
                DB::table('user')->where('userid',$userid)->update($data);
                 return response()->json(['message' => 'Password Changed'], 200);
        }else{
            return response()->json(['errors' => [
            ['code' => 'not-found', 'message' => 'Invalid Credentials!']
        ]], 404);
        }
    }
    public function userdetail(Request $request){
          $user=User::where('role','user')->where('id' ,$request->user_id)->get();
          return response()->json($user);
    }
    
    public function activeinactiveuser(Request $request){
        
         $userid=$request->userid;
         $user = DB::table('user')->where('userid',"=",$userid)->first();
         $id=$user->id;
         $star_user=DB::table('star_user')->where('userid',"=",$id)->get();
        foreach($star_user as $user){}
        $btree=new BtreeController;
        $left_right_user= $btree->getLeftRightUsers($user,$user);
        
        
        $count_right = count($left_right_user['right']);
        $count_left = count($left_right_user['left']);
         $total_count_left_right = $count_right + $count_left;
        
        
    
    $left_active=0;
    $left_inactive_users=0;
    $right_active=0;
    $right_inactive_users=0;
    
    $left_user_status=0;
    $right_user_status=0;
        for ($i = 0; $i < count($left_right_user['left']); $i++) {
                $left_user_id = $left_right_user['left'][$i];
            if ($left_user_id > 0) {
                $left_user_status+=DB::table('user_package')->where('user_id',$left_user_id)->where('status',"=",'approved')->count();
               
            } else{
                $left_user_status=0;
            }
            }
            
        for($i=0; $i< count($left_right_user['right']); $i++){
            $right_user_id=$left_right_user['right'][$i];
            if($right_user_id > 0){
                $right_user_status+=DB::table('user_package')->where('user_id',$right_user_id)->where('status',"=",'approved')->count();
               
        }
      }
    $total_dairect=DB::table('user')->where('referal',"=",$userid)->count();
    
    
            $total_active_user= $left_user_status + $right_user_status;
            $total_inactive_user = $total_count_left_right-$total_active_user;
            
           $get_total_bv=DB::table('orders')->where('user_id',$id)->sum('total_bv');
      $get_total_r_order_bv=DB::table('r_orders')->where('user_id',$id)->sum('total_bv');
      
       $get_total_order=DB::table('orders')->where('user_id',$id)->sum('total');
      $get_total_r_order=DB::table('r_orders')->where('user_id',$id)->sum('total');
      
      $total_bv=$get_total_bv+$get_total_r_order_bv; 
      $total=$get_total_order+$get_total_r_order;
           
        $response = [
                'active_user' => $total_active_user,
                'inactive_user' => $total_inactive_user,
                'total_team' => $total_count_left_right,
                'total_direct' => $total_dairect,
                 'total_bv' => $total_bv,
                 'total_order' =>$total
                
            ];
            return response()->json($response , 200);
        
    } 
    
    
         
     
}
