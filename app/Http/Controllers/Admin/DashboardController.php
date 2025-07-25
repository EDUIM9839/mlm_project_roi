<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Image;
use App\Http\Controllers\BtreeController;
use Storage;
use App\Http\Controllers\MLMController;
class DashboardController extends Controller
{
   public function Dashboard()
    {
        $endDate=date("Y-m-d");
        $startDate=date('Y-m-d', strtotime('-7 days'));
        // echo $endDate; die;
        $data = User::where('role', '=', 'user')->get();
        $userData= DB::table('user')->where("role","user")->get();
        $last_sevenDays_user = DB::table('user')->whereBetween('created_at', ["$startDate", "$endDate"])->count();
        $last_sevenDays_userpackage = DB::table('user_package')->whereBetween('created_at', ["$startDate", "$endDate"])->count();
        $check_activeuser2 = DB::table('user_package')->where("status","approved")->groupBy('user_id')->get();
       $check_activeuser=count($check_activeuser2);
        $total_user=count($userData);
        $inactiveuser=$total_user-$check_activeuser;
        $last_sevenDays_inactiveuser=$last_sevenDays_user- $last_sevenDays_userpackage;
        $datas=compact('data','total_user','last_sevenDays_user','check_activeuser','last_sevenDays_userpackage','inactiveuser','last_sevenDays_inactiveuser');
        return view('admin/Dashboard')->with($datas);
    }
    public function weight()
    {
        return view('admin.weight');
    }
    
    
    public function approvedPackage(Request $request){
        
     $user_package_id=$request->id;
     $data['status']='approved';
     $data['activated_date']=date('Y-m-d H:i:s');
     $res=DB::table('user_package')->where('id', $user_package_id)->update($data);
     if($res>0){
            Session::flash('message', '<p class="alert alert-success" style="text-align:center">PURCHASE PACKAGE  has been successfully approved.</p>');
            return redirect()->route('purchase_package');  
     }else{
            Session::flash('message', '<p class="alert alert-success" style="text-align:center">PURCHASE PACKAGE has been failed approve to approval time.</p>');
            return redirect()->route('purchase_package');  
     }
    }
     // +++++++++++++++++code of  all user page
    public function user_list()
    {
        $data = DB::table('user')->where('role', '=', 'user')->get();
        // dd($data);
       
        return view('admin.user_list', compact('data'));
    }
    public function switch_status(Request $request){
        // dd($request->all());
        
            
        DB::table('user')->where('id', $request->id)->update(['block_withdrawl_wallet' => $request->block_status]);
       
        
    
      return redirect()->back();
        
    }
    
      public function only_inactive_user_list()
    {
        
       
        $data = DB::table('user')->where('role', '=', 'user')->get()->filter(function($value,$key) {
                           
                           if(DB::table('user_package')->where('user_id',$value->id)->where('status','approved')->exists()){
	                          return null;
                           }else{
                               return $value;
                           }
                 });

      
      
        
        
       
        return view('admin.inactive_user', compact('data'));
    }
      // +++++++++++++++++code of edit all user page
    
      public function user_edit(Request $request){
        $id=$request->id;
        // echo $id;die;
        $edit_user=DB::table('user')->where('id',"=",$id)->get();
        // dd($edit_user);
        return view('admin.user_edit',compact('edit_user'));
    }
     // +++++++++++++++++code of edit all user detials page
    public function user_details(Request $request)
    {
      
        $id=$request->id;
        $user_login=Auth::user();
        $user_details=DB::table('user')->where('id',"=",$id)->get();
         $user=DB::table('user')->find($id);
           $mlm=new MLMController;
       $mlm->recurseUserLevelListAll($user);
        
         $mlm->downline($user, false, true);
         $team = $mlm->getDownline();  
       
        $total_team=0;
        $total_active=0;
        $total_inactive=0;
        $total_team_investment=0;
        foreach($team as $teams){
            foreach($teams as $teams2){
                $total_team++;
              $check_count=DB::table("user_package")->where("user_id",$teams2->id)->where("status","approved")->count();
             $total_team_investment += DB::table("user_package")->where("user_id",$teams2->id)->where("status","approved")->sum("amount");
       
         if($check_count>0){
                  $total_active++;
              }else{
                  $total_inactive++;
              }
            }
        }
       
       
       
         $total_team=count($mlm->getLevelUsersAll());
        return view('admin.user_details',compact('user_details','total_team','total_team_investment','total_inactive','total_active','total_team', 'user'));
    }
    
    //Active User List
     public function active_User()
    {
         $data = DB::table('user_package')->join('user', 'user_package.user_id','=','user.id')->select('user_package.*','user.id as uid','user.userid','user.first_name','user.last_name','user.created_at')->where('user_package.status','=','approved')->where('user_package.active_status',1)->orderBy('user_package.id', 'desc')->get();
        return view('admin/active_user', compact('data'));
    }
    
    //Inactive User List
     public function inactive_user_list()
    {
        //  $inactive_user = DB::table('user')->where('role', '=', 'user')->where('package_status','=','pending')->get();
        // $data = DB::table('user_package')->join('user', 'user_package.user_id','=','user.id')->join('package', 'user_package.package_id','=','package.id')->select('user_package.*','user.userid','user.first_name','user.last_name','package.cost')->where('user_package.status','=','pending')->get();
        // dd($inactive_user);
        
        
        
        $inactive_user= DB::table('user')->where('role', '=', 'user')->get()->filter(function($value,$key) {
                           
                           if(DB::table('user_package')->where('user_id',$value->id)->where('status','approved')->exists()){
	                          return null;
                           }else{
                               return $value;
                           }
                 });

        return view('admin/inactive_user_list', compact('inactive_user'));
    }
    
    
    
    // active user conttroller

     public function active_user_list()
    {
    
        $active_user = DB::table('user_package')->join('user', 'user_package.user_id','=','user.id')->join('package', 'user_package.package_id','=','package.id')->select('user_package.*','user.id as uid','user.userid','user.first_name','user.last_name','package.cost')->where('user_package.status','=','approved')->get();
        dd($active_user);
        return view('admin/active_user', compact('active_user'));
    }
    
  
    
       public function profile(){
        return view('admin.profile');
    }
     
    public function joining_percentage()
    {
        // return view('joining_percentage');
        $jp = DB::table('app_config')->find(1);
        $data = compact('jp');
        return view('admin.joining_percentage')->with($data);
    }
    
    // ptop route start 
    public function p_to_p()
    {
        $id=Auth::user()->id;
        // dd($id);
         $ptop_transefer=DB::table('ptop_transefer')->join('user', 'ptop_transefer.receiver_id','=','user.id')->select('ptop_transefer.*','user.userid','user.first_name','user.last_name')->where('sender_id','=',$id)->get();
        //  dd($ptop_transefer);
        return view('admin.p_to_p',compact('ptop_transefer'));
    }
    public function admin_ptop_trancefer(Request $request){
          $sender_id=$request->sender_id;
                $receiver_id=$request->receiver_id;
                $amount=$request->amount;
                $data=array(
                        
                        'total_amount'=>$amount,
                        'sender_id'=>$sender_id,
                        'receiver_id'=>$receiver_id,
                        'date'=>date('Y-m-d'),
                        
                    );
                      if(Auth::user()->saving_wallet<$amount){
                        
                         $msg="!Insufficient fund.";
                             $request->session()->flash('error',$msg);
                            return redirect()->back(); 
                    }
                     $increment=DB::table('user')->where('id',$receiver_id)->increment('saving_wallet',$amount);
                $decrement=DB::table('user')->where('id',$sender_id)->decrement('saving_wallet',$amount);
                if(!empty($increment) and !empty($decrement)){
                $inserted=DB::table('ptop_transefer')->insert($data); 
                $msg="Fund has been successfully transfered.";
                $request->session()->flash('success',$msg);
                return redirect()->back();
                }else{
                  
                  $msg="Something went wrong.";
                  $request->session()->flash('success',$msg);
                  return redirect()->back(); 
                }
                   
    }
    
    // ptop route start 
    public function ptop_user(Request $request)
    {
        $userid=$request->userid;
        
       $user_table= DB::table('user')->where('userid',"=",$userid)->get();
       if(count($user_table)){
            return response()->json($user_table);
       }else{
            return response()->json("false");
       }
      
    }
    public function ptop_userrs(Request $request)
    {
        $userid=$request->userid;
        
       $user_table= DB::table('user')->where('userid',"=",$userid)->get();
       if(!empty($user_table[0])){
            return response()->json($user_table);
       }else{
            return response()->json(false);
       }
      
    }
    
    public function check_amount_ptops(Request $request){
        // print_r($request->all());
        $amount=$request->amount;
         $response = array();
        $saving_wallet=$request->saving_wallet;
        if($amount >$saving_wallet){
            $response['status'] =  201;
            $response['result'] = 'Insufficient Fund';
        }else if($amount <5){
            $response['status'] =  201;
            $response['result'] = 'Minmum withdrwal amount is 5';
        }
        return response()->json($response);
    }
    
    public function level(){
        return view('admin.level');
    }
    public function autopool(){
        return view('admin.autopool');
    }
    public function income_history(){
        $income_history =DB::table('income_history')->get();
        print_r($income_history);
        return view('admin.income_history', compact('income_history'));
    }
    public function withdrawl_request(Request $request){
        
        $currency = "dollar";
         
         if(!empty($request->query('currency'))){
             
             if($request->query('currency') == "dollar"){
                $currency = $request->query('currency'); 
             }else if($request->query('currency') == 'inr'){
                 $currency = "inr";
             }
        }
        
        $transaction=DB::table('withdrawl_request')->where('status','pending')->where('currency_type', $currency)->get();
        
        $totalDollarPaid = 0;
        $totalInrPaid = 0;
        
        if ($transaction->isNotEmpty()) {
            $totalDollarPaid = $transaction->pluck('amount')->sum();
            $totalInrPaid = $transaction->pluck('amount_inr')->sum();
        }

        return view('admin.withdrawl_request',compact('transaction', 'currency', 'totalDollarPaid', 'totalInrPaid'));
    }
    public function income_booster(){
        return view('admin.income_booster');
    }
  
    public function purchase_package(){
        $title='Packages';
        $subtitle='Purchase Package List';
        $packages=DB::table('user_package')->get();
        return view('admin.purchase-package-list' , compact('title', 'subtitle', 'packages'));
      
    }
    public function change_password(){
        return view('admin.change_password');
    }
    
    public function change_roi_percent(){
        return view('admin.change_roi_percent');
    }
    public function roi_on_off(){
         $all_user = DB::table('user')->join('user_package', 'user.id', '=', 'user_package.user_id')->where('user_package.status', 'approved')->select('user.*', 'user_package.status', 'user_package.created_at','user_package.amount','user_package.roi_status_on_off')->groupBy('user_package.user_id')->get();
         
        return view('admin.roi_on_off',compact('all_user'));
    }
    
    public function toggleROI(Request $request, $id)
        {
            DB::table('user_package')
                ->where('user_id', $id)
                ->update([
                    'roi_status_on_off' => $request->has('roi_status') ? 1 : 0
                ]);

        
            $status = $request->has('roi_status') ? 'on' : 'off';

return back()->with('success', 'ROI status ' . strtoupper($status) . ' successfully!');
        }
    public function change_roi_percent_by_admin(Request $request){
        $request->validate([
            "roi_percent"=>"required|numeric",
            ]);
         DB::table("business_setup")->update(["roi_percent"=>$request->roi_percent]);
          return redirect()->back()->with('success', 'Roi percent change successfully');
    }
    
    public function change_bfi_percent_by_admin(Request $request){
        $request->validate([
            "bfi_percent"=>"required|numeric",
            ]);
         DB::table("business_setup")->update(["bfi_percent"=>$request->bfi_percent]);
          return redirect()->back()->with('happy', 'BFI percent change successfully');
    }
    
    public function change_password_transaction(){
        return view('admin.change_password_transaction');
    }
    public function notification(){
        // return view('notification');
        $nt = DB::table('notification')->find(1);
        $data=compact('nt');
        return view('admin.notification')->with($data);
    } 
    public function add_banner(){
        // return view('notification');
        $nt = DB::table('settings')->find(1);
        $data=compact('nt');
        return view('admin.add_banner')->with($data);
    } 

    public function business_setup(){
        // return $req->input();
       
        $bs= DB::table('business_setup')->find(1);

        $data=compact('bs');
        
    return view('admin.business_setup')->with($data);
    }
    
    
    public function package_detail(){
        $title='Packages';
        $subtitle='Add Package';
        return view('admin.package_detail' , compact('title', 'subtitle'));
    }
    
    public function package_list(){
        $title='Packages';
        $subtitle='Package List';
        $packages=DB::table('package')->get();
        return view('admin.package-list' , compact('title', 'subtitle', 'packages'));
    }
    
     public function purchase_package_list(){
        
        $title='Packages';
        $subtitle='Purchase Package List';
        $packages=DB::table('user_package')->get();
        return view('admin.purchase-package-list' , compact('title', 'subtitle', 'packages'));
    }
    
    
    
    
    public function update_package(Request $request){

        $id=$request->id;

        $request->validate([
            'package_name'=>'required',
            'cost'=>'required|numeric',
         ]);
         
        if(empty($request->image)){
                $data=array(
                'name'=>$request->package_name,
                'cost'=>$request->cost,
                );
                
                $result=DB::table('package')->where('id', $id)->update($data);
                
                if($result>0){
                                    $request->session()->flash('success',"Package has been successfully updated."); 

//Session::flash('message', '<p class="alert alert-success" style="text-align:center">Package has been successfully updated.</p>');
                return redirect()->route('package_list');
                }else{
                
                return redirect()->route('package_list'); 
                }
         }else{
             
            $imageName = time().'.'.$request->image->extension();
            $deletedImage=public_path('assets/packageImages').'/'.$request->oldimage;
            $request->image->move(public_path('assets/packageImages'), $imageName);
            
            $data['name']=$request->package_name;
            $data['cost']=$request->cost;
            $data['img']=$imageName;
            unlink($deletedImage);
            $result=DB::table('package')->where('id', $id)->update($data);
            if($result>0){
                    $request->session()->flash('success',"Package has been successfully updated."); 
           // Session::flash('message', '<p class="alert alert-success" style="text-align:center">Package has been successfully updated.</p>');
            return redirect()->route('package_list');
            }else{
             $request->session()->flash('success',"Check error has not been uploaded while uploading package."); 
            //Session::flash('message', '<p class="alert alert-success" style="text-align:center">Check error has not been uploaded while uploading package.</p>');
            return redirect()->route('package_list'); 
            }
         }
        
    
        
    }
    
//   public function changeStatus(Request $request)
// {
//     $user = User::find($request->user_id);
//     $user->status = $request->status;
//     $user->save();

//     return response()->json(['success'=>'Status change successfully.']);
// }  
    
    public function changeStatus(Request $request)
    {
        
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

    
     public function delete_package(Request $request){
        $id=$request->id;
        // $cdata=DB::table('package')->where('id', $id)->get();
        // $cimage=$cdata['0']->category_image;
        // $deletedImage=public_path('assets/categoryImages').'/'.$cimage;
        // unlink($deletedImage);
        DB::table('package')->where('id', $id)->delete();
        $request->session()->flash('success',"Package has been successfully deleted."); 
        //Session::flash('message', '<p class="alert alert-success" style="text-align:center">Package has been successfully deleted.</p>');
        return redirect()->route('package_list');
    }

    public function AddPackages(Request $request){
        $request->validate([
           'package_name'=>'required',
           'cost'=>'required|numeric',
        ]);
       
        if(empty($request->image)){
                
                $data['name']=$request->package_name;
                $data['cost']=$request->cost;
                $result=DB::table('package')->insert($data);
                if($result==1){
                $request->session()->flash('success',"Package has been successfully deleted."); 

                   // Session::flash('message', '<p class="alert alert-success" style="text-align:center">Package has been successfully added.</p>');
                    return redirect()->route('package_list');
                }else{
                            $request->session()->flash('success',"Check error has not been uploaded while uploading package."); 

                    // Session::flash('message', '<p class="alert alert-success" style="text-align:center">Check error has not been uploaded while uploading package.</p>');
                    return redirect()->route('package_list'); 
                }
         }else{
            
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/packageImages'), $imageName);
            
            $data['name']=$request->package_name;
            $data['cost']=$request->cost;
            $data['img']=$imageName;
            $result=DB::table('package')->insert($data);
            if($result==1){
            $request->session()->flash('success',"Package has been successfully added."); 
    
            //Session::flash('message', '<p class="alert alert-success" style="text-align:center">Package has been successfully added.</p>');
            return redirect()->route('package_list');
            }else{
            $request->session()->flash('success',"Check error has not been uploaded while uploading package."); 
           // Session::flash('message', '<p class="alert alert-success" style="text-align:center">Check error has not been uploaded while uploading package.</p>');
            return redirect()->route('package_list'); 
            }
         }
      
    }
    
    
    
    
    public function suspended_user_list(){
        
        $suspended_user=User::where('suspend_status','suspend')->get();
        $data=compact('suspended_user');
        
        return view('admin.suspended_users')->with($data);
        
        
        
    }
    
       public function activate_suspend_user($id){
        $user=User::find($id);
        $user->suspend_status='active';
        $user->save();
        $suspended_user=User::where('suspend_status','suspend')->get();
         $i=1;
         $html="";
         $html.='<table id="example" class="table table-bordered table-striped" ><thead><tr><th  class="text-center" >S.no</th><th  class="text-center"  >User</th><th  class="text-center"  >Status</th><th  class="text-center"  >Action</th></tr></thead><tbody>';
                            
                            foreach($suspended_user as $su){
            $html.='<tr><td align="center" style="vertical-align: middle;" >'.$i.'</td><td align="center" style="vertical-align: middle;" ><img src="'.Storage::url("app/profileupload/").$su->image.'" alt="user" class="rounded-circle p-1 bg-primary" width="60" ><br>'.ucwords($su->first_name).' '.ucwords($su->last_name).' <br><span class="badge bg-gradient-ohhappiness text-white shadow-sm">'.$su->userid.'</span></td><td align="center" style="vertical-align: middle;"><i class="fa-solid fa-ban text text-danger" style="font-size:50px;"></i><br><b class="text text-danger">Suspended</b></td><td align="center" style="vertical-align: middle;">  <button class="btn btn-secondary" onclick="activate_user('.$su->id.');">   Activate </button> </td></tr>';
                                    $i++;
                                 }
            $html.='</tbody></table>';
            return response($html);
         
    }
    
    
    
    
    public function mail_config(){
        // return view('mail_config');
        $mc = DB::table('mail_config')->find(1);
        $data = compact('mc');
        return view('admin.mail_config')->with($data);
    }
    public function sms_config(){
        $sc = DB::table('sms_config')->find(1);
        $data = compact('sc');
        return view('admin.sms_config')->with($data);
    }
    public function social_media(){
        // return view('social_media');
        $sm = DB::table('social_media')->find(1);
        $data = compact('sm');
        return view('admin.social_media')->with($data);
    }
    public function payment_config(){
        return view('admin.payment_method');
    }
    
    public function withdrawl_history1(Request $request){
         
         $currency = "dollar";
         
         if(!empty($request->query('currency'))){
             
             if($request->query('currency') == "dollar"){
                $currency = $request->query('currency'); 
             }else if($request->query('currency') == 'inr'){
                 $currency = "inr";
             }
        }
         
        $transaction = DB::table('withdrawl_request')
            ->whereIn('status', ['Approved', 'canceled','processing','failed'])
            ->where('currency_type', $currency)
            ->get();
        
        $totalDollarPaid = 0;
        $totalInrPaid = 0;
        
        if ($transaction->isNotEmpty()) {
            $totalDollarPaid = $transaction->pluck('amount')->sum();
            $totalInrPaid = $transaction->pluck('amount_inr')->sum();
        }

        return view('admin.withdrawl_history',compact('transaction', 'currency', 'totalDollarPaid', 'totalInrPaid'));
    }
    
     public function change_status($id){
         
       
        $withdrawalRequest = DB::table('withdrawl_request')->where('id', $id)->first();
        $currency = $withdrawalRequest->currency_type;
        if($currency == "inr"){
            
            DB::table('withdrawl_request')->where('id', $id)->update(['status'=>'Approved']);
            // if($changestatus){
            //   $get_amount=DB::table('withdrawl_request')->where('id',$id)->first();
            // }
        }
        else if($currency == 'dollar'){
            $userId = $withdrawalRequest->user_id;
            $userTronAddress = DB::table('user')->where('id', $userId)->pluck('tron_address')->first();
            if(empty($userTronAddress)){
                return redirect()->back()->with('error', 'The USDT TRC20 Address is not set!');
            }
            if(str_starts_with(trim($userTronAddress), "0x")){
                
                // $transaction1 = new TransactionController();
                
                $transaction1 = new OxaPayoutController();
                $trackId = $transaction1->sendTransaction($userTronAddress, $withdrawalRequest->paying_amount_dollor);
                
                if($trackId){
                    $changestatus = DB::table('withdrawl_request')->where('id', $id)->update(['status'=>'processing', 'track_id' => $trackId]);
                    return redirect()->back()->with('success', 'Success! Amount paid on - '. $userTronAddress );
                }else{
                    return redirect()->back()->with('success', 'Transaction Failed the trackId is not generated!' );
                }

            }else{
                 return redirect()->back()->with('error', 'Invalid USDT TRC20 wallet address is given!');
            }
            
            
            return redirect()->back()->with('error', 'The USDT TRC20 Address is set!');
        }
        else{
            
                return redirect()->back()->with('error', "Invalid currency! " . $withdrawalRequest->currency_type);
        }
        
        return redirect()->route('withdrawl_history1')->with('success', "Paid Successfully!");
    }
    
    public function change_status_default($id){
        $withdrawalRequest = DB::table('withdrawl_request')->where('id', $id)->first();
        $currency = $withdrawalRequest->currency_type;
        $pending = $withdrawalRequest->status;
        // dd($id,$currency,$pending);
        
        if($pending=='pending'){
            if($currency == "inr"){
                DB::table('withdrawl_request')->where('id', $id)->update(['status'=>'Approved']);
            }else if($currency == 'dollar'){
                $userId = $withdrawalRequest->user_id;
                $userTronAddress = DB::table('user')->where('id', $userId)->pluck('tron_address')->first();
                if(empty($userTronAddress)){
                    return redirect()->back()->with('error', 'The USDT TRC20 Address is not set!');
                }
                if(str_starts_with(trim($userTronAddress), "0x")){
                    DB::table('withdrawl_request')->where('id', $id)->update(['status'=>'Approved','message' =>'Default Payment']);
                    $insert_default=[
                        "user_id"=>$userId,
                        "amount"=>$withdrawalRequest->amount,
                        "withdrawl_id"=>$id,
                    ];
                        DB::table("withdrawl_default_history")->insert($insert_default);
                    return redirect()->back()->with('success', 'Success! Amount paid on - '. $userTronAddress );
                    // return redirect()->back()->with('success', 'Amount Successfully Paid');
                }else{
                    return redirect()->back()->with('error', 'Invalid USDT TRC20 wallet address is given!');
                }
                return redirect()->back()->with('error', 'The USDT TRC20 Address is set!');
            }else{
                return redirect()->back()->with('error', "Invalid currency! " . $withdrawalRequest->currency_type);
            }
        }else{
             return redirect()->back()->with('error', "Invalid Status! " . $withdrawalRequest->status);
        }
        return redirect()->route('withdrawl_history1')->with('success', "Paid Successfully!");
    }
    
    public function total_collection(Request $request)
    {
         $fromdate=$request->fromdate;
        $todate=$request->todate;
        if(empty($fromdate) and empty($todate))
        {
        $total_collection = DB::table('user')
            ->join('user_package', 'user.id', '=', 'user_package.user_id')
            ->select('user.*', 'user_package.amount', 'user_package.activated_date')
            ->where('status', 'approved')
            ->orderBy('activated_date', 'ASC')
            ->get();

        return view('admin.total_collection', compact('total_collection','fromdate','todate'));
    }
}
    public function collection_filter(Request $request)
    {
        $request->validate([
            'fromdate' => 'required|date',
            'todate' => 'required|date',
        ]);

        $fromdate = $request->fromdate;
        $todate = $request->todate;

        $total_collection = DB::table('user')
            ->join('user_package', 'user.id', '=', 'user_package.user_id')->select('user.*', 'user_package.amount', 'user_package.activated_date')
            ->where('status', 'approved')->whereDate('activated_date', '>=', $fromdate)->whereDate('activated_date', '<=', $todate)
            ->orderBy('activated_date', 'ASC')->get();

        $total_amount = DB::table('user')
            ->join('user_package', 'user.id', '=', 'user_package.user_id')->where('status', 'approved')->whereDate('activated_date', '>=', $fromdate)
            ->whereDate('activated_date', '<=', $todate)->sum('user_package.amount');

        return view('admin.total_collection', compact('total_collection', 'fromdate', 'todate', 'total_amount'));
    }
 
// public function collection_filter(Request $request)
// {
//     $request->validate([
//         'fromdate' => 'nullable|date',
//         'todate' => 'nullable|date',
//     ]);

//     $fromdate = $request->fromdate;
//     $todate = $request->todate;

//     if ($fromdate && $todate) {
//         // If both fromdate and todate are provided, filter by date range
//         $total_collection = DB::table('user')
//             ->join('user_package', 'user.id', '=', 'user_package.user_id')
//             ->select('user.*', 'user_package.amount', 'user_package.activated_date')
//             ->where('status', 'approved')
//             ->whereDate('activated_date', '>=', $fromdate)
//             ->whereDate('activated_date', '<=', $todate)
//             ->orderBy('activated_date', 'ASC')
//             ->get();

//         $filtered_total_amount = DB::table('user')
//             ->join('user_package', 'user.id', '=', 'user_package.user_id')
//             ->where('status', 'approved')
//             ->whereDate('activated_date', '>=', $fromdate)
//             ->whereDate('activated_date', '<=', $todate)
//             ->sum('user_package.amount');
//     } else {
//         // If no date filter applied, fetch all records and total amount
//         $total_collection = DB::table('user')
//             ->join('user_package', 'user.id', '=', 'user_package.user_id')
//             ->select('user.*', 'user_package.amount', 'user_package.activated_date')
//             ->where('status', 'approved')
//             ->orderBy('activated_date', 'ASC')
//             ->get();

//         $filtered_total_amount = null; // Set to null when no filter is applied
//     }

//     $total_amount = DB::table('user')
//         ->join('user_package', 'user.id', '=', 'user_package.user_id')
//         ->where('status', 'approved')
//         ->sum('user_package.amount');

//     return view('admin.total_collection', compact('total_collection', 'fromdate', 'todate', 'total_amount', 'filtered_total_amount'));
// }

      
   
    
    
    public function pending_users(Request $request){
        
        $user_pending= DB::table('user_package')
                        ->where('status', 'pending')
                        ->whereNull('description')
                        ->get();

       
        return view('admin.pending_users',compact('user_pending'));
        
    }
    public function active_package(Request $request,$id){
        
        // die("This is not use for any work !");
        $activated_by=Auth::user()->id;
       $user_package=DB::table('user_package')->where('id',$id)->first();
       if($user_package->status=="pending"){
        $user_id=$user_package->user_id;
       $user_tbl= DB::table("user")->where("id",$user_id)->first();
       $pairent_user= DB::table("user")->where("userid",$user_tbl->referal)->first();
        $amount=$user_package->amount;
        $app_config=DB::table("app_config")->first();
        $pairent_amount=DB::table("user_package")->where("user_id",$pairent_user->id)->where("status","approved")->sum('amount');
        $paying_amount=$amount*$app_config->joining_percentage/100;
        $date=date('Y-m-d H:i:s');
        $data=array(
            'status'=>'approved',
            'activated_date'=>$date,
            'activated_by'=>$activated_by
            );
            if($pairent_amount>0){
                $enevest_amount3guna=$pairent_amount*3;
                $current_recived_direct=DB::table("income_history")->where("received_user",$pairent_user->id)->where("credit_debit","credit")->where("type","direct")->sum('amount');
                $current_recived_level=DB::table("income_history")->where("received_user",$pairent_user->id)->where("credit_debit","credit")->where("type","level")->sum('amount');
                $current_recived_roi=DB::table("income_history")->where("received_user",$pairent_user->id)->where("credit_debit","credit")->where("type","roi")->sum('amount');
                $current_recived_amount=$current_recived_direct+$current_recived_level+$current_recived_roi;
               $current_amount2=$current_recived_amount+$paying_amount;
               if($enevest_amount3guna>$current_recived_amount){
                   if($enevest_amount3guna>=$current_amount2){
                       $insert_income=[
                            "credit_debit"=>'credit',
                            "received_user"=>$pairent_user->id,
                            "joined_user"=>$user_id,
                            "laps_amount"=>0,
                            "amount"=>$paying_amount,
                            "type"=>'direct',
                            "invest_amount"=>$amount,
                           
                           ];
                             DB::table("income_history")->insert($insert_income);
                             DB::table("user")->where("id",$pairent_user->id)->increment("incentive_wallet",$paying_amount);
                   }else{
                       $paying_amount2=$enevest_amount3guna-$current_recived_amount;
                       $laps_amount=$paying_amount-$paying_amount2;
                        $insert_income=[
                            "credit_debit"=>'credit',
                            "received_user"=>$pairent_user->id,
                            "joined_user"=>$user_id,
                            "laps_amount"=>$laps_amount,
                            "amount"=>$paying_amount2,
                            "type"=>'direct',
                             "invest_amount"=>$amount,
                           
                           ];
                             DB::table("income_history")->insert($insert_income);
                             DB::table("user")->where("id",$pairent_user->id)->increment("incentive_wallet",$paying_amount2);
                   }
               }else{
                    $insert_income=[
                            "credit_debit"=>'laps',
                            "received_user"=>$pairent_user->id,
                            "joined_user"=>$user_id,
                            "laps_amount"=>$paying_amount,
                            "amount"=>0,
                            "type"=>'direct',
                             "invest_amount"=>$amount,
                           ];
                   DB::table("income_history")->insert($insert_income);
               }
            }else{
                 $insert_income=[
                            "credit_debit"=>'inactive',
                            "received_user"=>$pairent_user->id,
                            "joined_user"=>$user_id,
                            "laps_amount"=>$paying_amount,
                            "amount"=>0,
                            "type"=>'direct',
                            "invest_amount"=>$amount,
                           
                           ];
                           DB::table("income_history")->insert($insert_income);
            }
        DB::table('user_package')->where('id',$id)->update($data);
        $request->session()->flash('success','Approved Successfully');
       return redirect()->back();
       }else{
            $request->session()->flash('error','Already Approved This  Package');
            return redirect()->back();
       }
    }
    
    
    
        public function calculation_income($user_id){
         
                   
                    $user=DB::table('user')->find($user_id);
                    $parent_user=DB::table('user')->where('userid',$user->referal)->first();
                    
                    
        if($user->global_star_status=='yes'){
                        
                                  $array=array(
                                        'type'=>'direct',
                                        'joined_user'=>$user->id,
                                        'received_user'=>$parent_user->id,
                                        'amount'=>10,
                                        'date'=>date('Y-m-d'),
                                        'date_time'=>date("Y-m-d H:i:s"),
                                        'credit_debit'=>'credit',
                                        'global_star_status'=>'yes'
                                 );
                                
                                 DB::table('income_history')->insert($array);
                                 
                                 $income_history_direct_sum=DB::table('income_history')->where('type','direct')->where('received_user',$parent_user->id)->sum('amount');
                                 
                        if($income_history_direct_sum==20){
                                
 
                   
                   $global_star_plan=DB::table("global_star_plan")->get();
                    $mlm=new MLMController;
                     $mlm->autopool_placement($parent_user);
                     $autopool_user=DB::table('autopool_user')->where('userid',$parent_user->id)->first();
                     
                     
                     $mlm->recurseUserReferaCheckForAutopool($autopool_user);
                     
                    
                     $upline=$mlm->getAutoPoolUserList();
                    
                            // $mlm->upline($user);
                            // $upline= $mlm->getUpline();
                            // echo "<pre>";
                            // print_r($mlm->getUpline());
                            // echo "</pre>";
                            
                   foreach($global_star_plan as $gsp){
                       
                      if(isset($upline[$gsp->upper_level_given_id])){
                               
                                 $array=array(
                                        'type'=>'global_star',
                                        'joined_user'=>$user->id,
                                        'received_user'=>$upline[$gsp->upper_level_given_id]->userid,
                                        'amount'=>$gsp->helping_amount,
                                        'level_no'=>$gsp->id,
                                        'date'=>date('Y-m-d'),
                                        'date_time'=>date("Y-m-d H:i:s"),
                                        'credit_debit'=>'credit',
                                        'global_star_status'=>'yes'
                                        );
                                
                                  DB::table('income_history')->insert($array);
                                   
                                  //global sponser
                                  
                                     $this_user=DB::table('user')->find($upline[$gsp->upper_level_given_id]->userid);
                                     $global_sponser=DB::table('user')->where('userid',$this_user->referal)->where('role','user')->first();
                                     
                                     if($gsp->sponser_income>0){
                                     
                                             if($global_sponser){
                                          
                                               $array=array(
                                                'type'=>'global_sponser',
                                                'joined_user'=>$user->id,
                                                'received_user'=>$global_sponser->id,
                                                'amount'=>$gsp->sponser_income,
                                                'level_no'=>$gsp->id,
                                                'date'=>date('Y-m-d'),
                                                'date_time'=>date("Y-m-d H:i:s"),
                                                'credit_debit'=>'credit',
                                                'global_star_status'=>'yes'
                                                );
                                                
                                                
                                                DB::table('income_history')->insert($array);
                                             } 
                                             
                                              
                                  
                                     }
                                  
                                  //global sponser end
                                  
                                   //global level
                                   $mlm=new MLMController;
                                $mlm->recurseUserReferaCheckForAutopool($upline[$gsp->upper_level_given_id]);
                                   $global_current_upline= $mlm->getAutoPoolUserList();
                                   
                                   for($i=0; $i<5; $i++){
                                       
                                       
                                       if($gsp->level_income>0){
                                               if(isset($global_current_upline[$i])){
                                                   
                                                    $array=array(
                                                'type'=>'global_level',
                                                'joined_user'=>$user->id,
                                                'received_user'=>$global_current_upline[$i]->userid,
                                                'amount'=>$gsp->level_income,
                                                'level_no'=>$gsp->id,
                                                'date'=>date('Y-m-d'),
                                                'date_time'=>date("Y-m-d H:i:s"),
                                                'credit_debit'=>'credit',
                                                'global_star_status'=>'yes',
                                                 'global_star_level'=>$i+1
                                                );
                                                
                                                
                                                DB::table('income_history')->insert($array);
                                                   
                                                   
                                               }
                                       }
                                   }
                                   
                                   
                                   
                                   //global_level_end
                                  
                                  
                                   
                                   
                       }
                             
                       
                       
                    }
                    
            }  //income_history_direct_sum_end
 
        }else{
                     $array=array(
                            'type'=>'direct',
                            'joined_user'=>$user->id,
                            'received_user'=>$parent_user->id,
                            'amount'=>5,
                            'date'=>date('Y-m-d'),
                            'date_time'=>date("Y-m-d H:i:s"),
                            'credit_debit'=>'credit'
                            );
                     DB::table('income_history')->insert($array);
                     
                      //level
                                   $mlm=new MLMController;
                                $mlm->upline($user);
                                $upline= $mlm->getUpline();
                                
                                $levels=DB::table('levels')->get();
                                
                     foreach($levels as $l){
                         
                         
                         if(isset($upline[$l->id-1])){
                                     $array=array(
                                        'type'=>'level',
                                        'joined_user'=>$user->id,
                                        'received_user'=>$upline[$l->id-1]->id,
                                        'level_no'=>$l->id,
                                        'amount'=>$l->amount,
                                        'date'=>date('Y-m-d'),
                                        'date_time'=>date("Y-m-d H:i:s"),
                                        'credit_debit'=>'credit'
                                        );
                                        
                                        
                            if(DB::table('user')->leftJoin('user_package','user.id','=','user_package.user_id')->where('user.id',$upline[$l->id-1]->id)->where('user_package.status','approved')->count()>=2){
                       
                                    DB::table('income_history')->insert($array);
                               
                            }
                
                
                         }
                         
                     }
                     
                     
        }
                            
                
  
         
     }
     
     public function self_fund(Request $request){
     
         return view('admin.add_self_fund');
     }
     public function add_self_fund(Request $request){
    //  dd($request->all());
    $date=date('Y-m-d');
     DB::table('user')->where('id',Auth::user()->id)->increment('saving_wallet',$request->amount);
     $data=array(
         'amount'=>$request->amount,
         'created_at'=>$date,
         );
     DB::table('admin_fund_self')->insert($data);
         return redirect()->back();
     }
      public function update_upi(Request $request){
     
         return view('admin.update_upi');
     }
      public function update_barcode(Request $request){
         
          if(isset($request->image)){
                $imageName = 'USDT_'.time().'.'.$request->image->extension();
            // $deletedImage=public_path('upibarcode').'/'.$request->oldimage;
            $request->image->move(public_path('upibarcode'), $imageName);
    
              $data=array(
                      'image'=>$imageName,
                      'address'=>$request->address
                      );
             DB::table('crypto_type')->where('id','4')->update($data);
          }else{
               $data=array(
                      'address'=>$request->address
                      );
             DB::table('crypto_type')->where('id','4')->update($data);
          }
         $request->session()->flash('success','Update Successfully');
         return redirect()->back();
     
}

public function cto_achievers(){
     
    $cto=DB::table('rank_achivers')->select('rank_achivers.*','user.first_name','user.last_name','user.userid','user.contact')->join('user','user.id','=','rank_achivers.userid')->get();
    
   
    $data=compact('cto');
   return view('admin.cto_achievers')->with($data);
}


public function global_star_user_list(){
    $autopool_user=DB::table('autopool_user')->select('user.*')->join('user','autopool_user.userid','=','user.id')->get();
    $data=compact('autopool_user');
    return view('admin.global_star_user_list')->with($data);
}

public function user_login(Request $request){
    if (DB::table('user')->where('userid', $request->id)->exists()) {
        $user = DB::table('user')->where('userid', $request->id)->first();
       
        $user = User::find($user->id);
        
        if ($user->role == 'user') {
           $request->session()->put('admin_session', 'admin_session');
          
            Auth::login($user);
        return redirect()->route('user-dashboard')->with([ 'login_user_id'=>$user->id ]);
        }
    }
    dd("NO");
}
 
 public function reward_achiever_user(){
     $reward_vip=DB::table("reward_vip")->get();
     return view('admin.reward_achiever_user',compact('reward_vip'));
 }
 public function view_reward_achiver_user_list($id){
     $reward_vip=DB::table("reward_vip")->where("id",$id)->first();
   $reward_achieved_user=DB::table("reward_achieved_user")->where("level_no",$id)->get();
    return view('admin.view_reward_achiver_user_list',compact('reward_achieved_user','reward_vip'));
 }
 public function change_reward_status($id){
     DB::table("reward_achieved_user")->where("id",$id)->update(['delivery_status'=>"delivered"]);
      session()->flash('success','Delivered Successfully');
      return redirect()->back();
 }
 public function club_achiever_user(){
     $club_level=DB::table("club_level")->get();
     return view('admin.club_achiever_user',compact('club_level'));
 }


public function admin_invest_amount(){
    return view("admin.admin_invest_amount");
}

public function activate_user_invest(Request $request){
   $id=Auth::user()->id;
   $tbl_user=DB::table("user")->where("userid",$request->user_id)->first();
   $package=DB::table("package")->where("id",$request->package_id)->first();
               
   if(!empty($tbl_user)){
       if(!empty($package)){
            $user_id=$tbl_user->id;
            $recived_roi_percent=$package->roi_percent;
             $insert_package=[
               "payment_type"=>"Cash",
               "amount"=>$package->cost,
               "user_id"=>$user_id,
               "status"=>'approved',
               "activated_by"=>$id,
               "recived_roi_percent" =>$recived_roi_percent,
             ];
                 DB::table("user_package")->insert($insert_package);
                 $last_save_id=DB::getPdo()->lastInsertId();
                $mlm=new MLMController;
                $mlm->upline($tbl_user);
                $upline= $mlm->getUpline();
                
                
              
                    foreach ($upline as $key=>$uplines){
                                    if($key==0){
                                        continue;
                                    }
                                    
                                    $total_level=DB::table("levels")->count();
                                    if($total_level>$key){
                                    $level_id=$key+1;
                                    $levels=DB::table("levels")->where("id",$level_id)->first();
                                    $check_active=DB::table('user_package')->where("user_id",$uplines->id)->where("status","approved")->where('active_status',1)->count();
                                     $mlm2=new MLMController;
                                     $total_direct=$mlm2->getActiveDirect($uplines);
                                    //  echo $total_direct." ||| $key User Id=".$uplines->userid."<br>";
                                     $paying_amount=$package->cost*$levels->percent/100;
                                     
                                     $totalInvestment = DB::table('user_package')->where('user_id',$uplines->id)->where('active_status', 1)->sum('amount');
                 
                                     if($totalInvestment < 100){
                                         $insert_income=[
                                                   "type"=>'level',
                                                   "level_no"=>$level_id,
                                                   "amount"=>0,
                                                   "laps_amount"=>$paying_amount,
                                                   "invest_amount"=>$package->cost,
                                                   "joined_user"=>$user_id,
                                                   "received_user"=>$uplines->id,
                                                   "credit_debit"=>"credit",
                                                   "up_id"=>$last_save_id,
                                                   "discription"=>'investment less than $100',
                                                  ]; 
                                            DB::table("income_history")->insert($insert_income);
                                          
                                          continue;
                                     }
                                     
                                     
                                     if($check_active>0){
                                           if($total_direct>=$levels->direct){
                                                 $insert_income=[
                                                        "type"=>'level',
                                                        "level_no"=>$level_id,
                                                        "amount"=>$paying_amount,
                                                        "laps_amount"=>0,
                                                        "invest_amount"=>$package->cost,
                                                        "joined_user"=>$user_id,
                                                        "received_user"=>$uplines->id,
                                                        "credit_debit"=>"credit",
                                                        "up_id"=>$last_save_id,
                                                        "discription"=>"Successfully",
                                                         ]; 
                                                    DB::table("income_history")->insert($insert_income);
                                                    DB::table('user')->where('id',$uplines->id)->increment('withdrawl_wallet',$paying_amount);
                                             }else{
                                                 $insert_income=[
                                                           "type"=>'level',
                                                           "level_no"=>$level_id,
                                                           "amount"=>0,
                                                           "laps_amount"=>$paying_amount,
                                                           "invest_amount"=>$package->cost,
                                                           "joined_user"=>$user_id,
                                                           "received_user"=>$uplines->id,
                                                           "credit_debit"=>"credit",
                                                           "up_id"=>$last_save_id,
                                                           "discription"=>"direct condition false",
                                                          ]; 
                                                  DB::table("income_history")->insert($insert_income);
                                             }
                                     }else{
                                        $insert_income=[
                                                "type"=>'level',
                                                "level_no"=>$level_id,
                                                "amount"=>0,
                                                "laps_amount"=>$paying_amount,
                                                "invest_amount"=>$package->cost,
                                                "joined_user"=>$user_id,
                                                "received_user"=>$uplines->id,
                                                "credit_debit"=>"credit",
                                                "up_id"=>$last_save_id,
                                                "discription"=>"received user inactive current time",
                                            ]; 
                                         DB::table("income_history")->insert($insert_income);
                                     }
                                  }
                             }
                
                   $request->session()->flash('success','Amount Add Successfully');
                   return redirect()->route("active_user_list");
           }else{
              return redirect()->back()->with('error','Package Not Fund');
           }
      }else{
        return redirect()->back()->with('error','User Not Fund');
      }
    
}

public function withdrawal_request_manually_by_admin(){
     return view('admin.withdrawal_request_manually_by_admin');
}

public function withdrawal_request_manually_by_admin2(Request $request){
     $request->validate([
            'amount'=>'required',
            'wallet'=>'required',
            'user_id'=>'required',
            'currency'=>'required',
           
        ]);
         $datetime = date('Y-m-d H:i:s');
        $currency=$request->currency;
        $wallet=$request->wallet;
        $user_id=$request->user_id;
        $amount=$request->amount;
        $user_tbl=DB::table("user")->where("role","user")->where("userid",$user_id)->first();
        if(!empty($user_tbl)){
            
            if($request->currency == "dollar" ){
                if(empty($user_tbl->tron_address)){
                    return redirect()->back()->with('error', 'The USDT TRC20 Address is not set on your profile');
                }else if(!str_starts_with($user_tbl->tron_address, "0x")){
                    return redirect()->back()->with('error', 'Invalid USDT TRC20 Address is set on your profile');
                }
            }
            
             if($request->wallet=="club_wallet"){
                     $withdrawl_wallet=$user_tbl->club_wallet;
                     $wallet_name="club_wallet";
               }else if($request->wallet=="roi_wallet"){
                   $withdrawl_wallet=$user_tbl->withdrawl_wallet;
                   $wallet_name="withdrawl_wallet";
                   
               }elseif($request->wallet=="incentive_wallet"){
                    $withdrawl_wallet=$user_tbl->incentive_wallet;
                     $wallet_name="incentive_wallet";
               }
               if($amount>$withdrawl_wallet){
                   $request->session()->flash('error',"Insufficient Balance");
                   return redirect()->back();
                    }else{
                            $inr=$amount*90;
                            $inr_less=$inr*10/100;
                            $paying_amount_inr=$inr-$inr_less;
                            $less=$amount*10/100;
                            $paying_amount_dollor=$amount-$less;
                            
                             $insert_data=[
                                 'user_id'=>$user_tbl->id,
                                 'amount'=>$amount,
                                 'amount_inr'=>$inr,
                                 "currency_type"=>$request->currency,
                                 "wallet_type"=>$request->wallet,
                                 "paying_amount_inr"=>$paying_amount_inr,
                                 "paying_amount_dollor"=>$paying_amount_dollor,
                                 'status'=>'pending',
                                 "cut_point"=>0,
                              ];
                            DB::table('withdrawl_request')->insert($insert_data);
                            DB::table('user')->where('id',$user_tbl->id)->decrement($wallet_name,$amount); 
                          
                            // ----------------------------------------
                            // start : pay to user by admin
                            // ----------------------------------------
                                // $userId = $user_tbl->id;
                                // $userTronAddress = DB::table('user')->where('id', $userId)->pluck('tron_address')->first();
                                // if(empty($userTronAddress)){
                                //     return redirect()->back()->with('error', 'The USDT TRC20 Address is not set!');
                                // }
                                // if(str_starts_with(trim($userTronAddress), "0x")){
                                    
                                //     $transaction1 = new TransactionControllerNew();
                                //     $data = $transaction1->sendTransaction($userTronAddress, $paying_amount_dollor);
                                   
                                    
                                //      if(count($data) > 0){
                          
                                //           if(isset($data['status']) && isset($data['hash'])){
                                              
                                //               if(!empty($data['hash'])){
                                                  
                                //                   if($data['status'] == "success"){
                                                      
                                //                         $insert_data=[
                                //                              'user_id'=>$user_tbl->id,
                                //                              'sender_id'=>Auth::user()->id,
                                //                              'amount'=>$amount,
                                //                              'amount_inr'=>$inr,
                                //                              "currency_type"=>$request->currency,
                                //                              "wallet_type"=>$request->wallet,
                                //                              "paying_amount_inr"=>$paying_amount_inr,
                                //                              "paying_amount_dollor"=>$paying_amount_dollor,
                                //                              'created_at'=> $datetime,
                                //                              'status'=>'Approved',
                                //                              "cut_point"=>0,
                                //                              "transaction_hash" => $data['hash']
                                //                         ];
                                //                         DB::table('withdrawl_request')->insert($insert_data);
                                //                         DB::table('user')->where('id',$user_tbl->id)->decrement($wallet_name,$amount); 
                                                        
                                //                         return redirect()->back()->with('success', 'Withdrawal Successful! To Your Account !');
                                //                   }else if($data['status'] == "error"){
                                //                       $insert_data=[
                                //                              'user_id'=>$user_tbl->id,
                                //                              'sender_id'=>Auth::user()->id,
                                //                              'amount'=>$amount,
                                //                              'amount_inr'=>$inr,
                                //                              "currency_type"=>$request->currency,
                                //                              "wallet_type"=>$request->wallet,
                                //                              "paying_amount_inr"=>$paying_amount_inr,
                                //                              "paying_amount_dollor"=>$paying_amount_dollor,
                                //                              'created_at'=> $datetime,
                                //                              'status'=>'failed',
                                //                              "cut_point"=>0,
                                //                              "transaction_hash" => $data['hash']
                                //                         ];
                                //                         DB::table('withdrawl_request')->insert($insert_data);
                                                        
                                //                         return redirect()->back()->with('error', 'Transaction Failed! - ' . $data['hash']);
                                                        
                                //                   }
                                                  
                                                    
                                //               }
                                              
                                              
                                //           }
                                //           elseif(isset($data['message']) && $data['status'] == "error"){
                                //               return redirect()->back()->with('error', $data['message']);
                                //           }
                                          
                                //       }
                                //      return redirect()->back()->with('error', 'Something went wrong! No Transaction made!');
                                   
                    
                                // }else{
                                //      return redirect()->back()->with('error', 'Invalid Users USDT TRC20 wallet address is given!');
                                // }
                                
                                
                                // return redirect()->back()->with('error', 'The USDT TRC20 Address is Invalid!');
                            // ----------------------------------------
                            // end : pay to this user by admin
                            // ----------------------------------------
                        
                        $request->session()->flash('success',"Request Sent Successfully"); 
                        return redirect()->back();
                    } 
        }else{
            $request->session()->flash('error',"User Not Found"); 
             return redirect()->back();
            
        }
}

    public function block_user(){
        $blockUser = User::where('user_status', 'block')->get();
        return view('admin.block_user', compact('blockUser'));
    }
     public function blockUserStore(Request $request){
        $request->validate([
           'user_id'=>'required',
        ]);
        try {
        // dd($request->all());
            $user =  User::where('userid', $request->user_id)->update(['user_status' => $request->user_status]);
            
                $id= User::where('userid', $request->user_id)->value('id');
            if($request->user_status=='unblock'){
                
                DB::table('user_package')->where('user_id',$id)->update(['status' => 'approved']);
            }else{
                DB::table('user_package')->where('user_id',$id)->update(['status' => 'pending']);
                
            }
            
            if($user == 0){
                  $msg="User Not Found";
                  $request->session()->flash('error',$msg);
                  return redirect()->back();
            }
            if($user > 0){
                // return view('admin.block_user', compact('user'));
                  $msg = "User status updated successfully.";
                  $request->session()->flash('success',$msg);
                  return redirect()->back(); 
            }else{
              $msg="Something went wrong.";
              $request->session()->flash('error',$msg);
              return redirect()->back(); 
            }
        } catch (Exception $ex) {
            Log::error('Error Updating user status', $ex->getMessage());
        }
        
    }



// add on controller code start - code by ajendra

 public function joining_date_update(){
        
        return view('admin.joining_date_update');
    }
    
 public function getRefererUser(Request $request)
{
    if (!$request->has('referralId')) {
        return response()->json([
            'status' => 'error',
            'message' => 'Missing referral ID'
        ]);
    }

    $userObj = DB::table('user')->where('userid', $request->referralId)->first();

    if ($userObj) {
        $userName = $userObj->first_name . ' ' . $userObj->last_name;
        $joiningdate = $userObj->created_at;
        $getreferal = $userObj->referal;

        // Optional check if referral is active (uncomment if needed)
        // if (!DB::table('user_package')->where('user_id', $userObj->id)->where('status', 'approved')->exists()) {
        //     return response()->json([
        //         'status' => 'warning',
        //         'message' => 'Referral is inactive!',
        //         'user' => $userName
        //     ]);
        // }

        return response()->json([
            'status' => 'success',
            'message' => 'User Found',
            'user' => $userName ,
            'date' => $joiningdate ,
            'referal' => $getreferal
        ]);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'User not found!'
    ]);
}

    public function updateJoiningDate(Request $request)
    {
    $request->validate([
        'referal' => 'required|string|exists:user,userid',
        'joiningDate' => 'required|date',
    ]);

    $user = DB::table('user')->where('userid', $request->referal)->first();

    if (!$user) {
        return redirect()->back()->withErrors(['referal' => 'User not found.']);
    }

    $activatedDate = DB::table('user_package')
        ->where('user_id', $user->id)
        ->whereNotNull('activated_date')
        ->orderBy('activated_date', 'asc')
        ->value('activated_date');

    if ($activatedDate && $request->joiningDate > $activatedDate) {
        return redirect()->back()->withErrors([
            'joiningDate' => 'Joining date cannot be later than the activated package date: ' . date('Y-m-d', strtotime($activatedDate))
        ]);
    }

    $updated = DB::table('user')
        ->where('id', $user->id)
        ->update(['created_at' => $request->joiningDate]);

    if ($updated) {
        DB::table('joining_date_history')->insert([
            'userid' => $user->id,
            'beforeDate' => $user->created_at,
            'updateDate' => $request->joiningDate,
            'created_at' => now()
        ]);
    }

    return redirect()->back()->with('success', 'Joining date updated successfully.');
}


    public function tree_swap()
    {
        return view('admin.tree_swap');
    }

    

    // Recursive check if new referal is in the user's downline 


    public function updatereferal(Request $request)
    {
        $request->validate([
            'referal' => 'required|string|exists:user,userid',
            'updatereferal' => 'required|string|exists:user,userid',
        ]);

        $user = DB::table('user')->where('userid', $request->referal)->first();
        $newReferal = DB::table('user')->where('userid', $request->updatereferal)->first();

        if (!$user || !$newReferal) {
            return redirect()->back()->withErrors(['referal' => 'User or new referral not found.']);
        }

        if ($request->referal === $request->updatereferal) {
            return redirect()->back()->withErrors(['updatereferal' => 'A user cannot refer themselves.']);
        }

        // 🛡️ Check for referral loop
        if ($this->isDownline($user->userid, $newReferal->userid)) {
            return redirect()->back()->withErrors(['updatereferal' => 'Cannot assign a downline as the new referrer.']);
        }

        $oldReferal = $user->referal;

        $updated = DB::table('user')
            ->where('id', $user->id)
            ->update(['referal' => $newReferal->userid]);

        if ($updated) {
            DB::table('tree_swap_history')->insert([
                'userid' => $user->id,
                'old_referal' => $oldReferal,
                'new_referal' => $newReferal->userid,
                'created_at' => now()
            ]);
        }

        return redirect()->back()->with('success', 'Referral ID updated successfully.');
    }

    /**
     * Recursively check if $targetId is in the downline of $userId.
     */
    private function isDownline($userId, $targetId)
    {
        $children = DB::table('user')->where('referal', $userId)->pluck('userid');

        foreach ($children as $childId) {
            if ($childId === $targetId) {
                return true;
            }
            if ($this->isDownline($childId, $targetId)) {
                return true;
            }
        }

        return false;
    }


    // ******************************************** Add Function for Group By Afzal (Start) ***********************************************************************
    public function checkUser(Request $request){
        $user = DB::table('user')->where('userid', $request->user_id)->first();
        if (!$user) {
            return response()->json(['error' => 'User ID not found']);
        }
        $check_exists = DB::table('user_groups')->where('user_id',$user->id)->exists();
        if ($check_exists) {
            return response()->json(['error' => 'User is already assigned']);
        }
        return response()->json([
            'user' => $user
        ]);
    }
    public function add_group(){
        $groups = DB::table('groups')->get();
        return view('admin.add-group',compact('groups'));
    }

    public function group_wise(){
        $userGroups = DB::table('user_groups')
            ->join('user', 'user_groups.user_id', '=', 'user.id')
            ->join('groups', 'user_groups.group_id', '=', 'groups.id')
            ->select('user_groups.id', 'user.userid as user_id', 'groups.group_name', 'groups.group_percentage')
            ->get();
        return view('admin.group_wise', compact('userGroups'));
    }
    public function addGroup(Request $request){
        $groups_data=[
            "group_name"=>$request->group_name,
            "group_percentage"=>$request->group_percentage,
        ];
         DB::table("groups")->insert($groups_data);
         return redirect()->back()->with('success', 'Group Add Successfully');
    }
    
    public function assignGroup(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:user,userid',
            'group_id' => 'required|exists:groups,id'
        ]);
        $id = DB::table('user')->where('userid', $request->user_id)->value('id');
        
        // dd($request->all(),$id);
        $userGroup=[
            "user_id"=>$id,
            "group_id"=>$request->group_id
        ];
        DB::table("user_groups")->insert($userGroup);
        
        return redirect()->back()->with('success', 'Group assigned successfully!');
    }
    
    public function getGroupDetails($id){
        $group = DB::table('groups')->where('id', $id)->first();
        if (!$group) {
            return response()->json(['message' => 'Group not found'], 404);
        }
        return response()->json([
            'group_name' => $group->group_name,
            'group_percentage' => $group->group_percentage
        ]);
    }
    
    public function updateGroup(Request $request, $id)
    {
        $validated = $request->validate([
            'group_name' => 'required|string|max:255',
            'group_percentage' => 'required|numeric|min:0|max:100',
        ]);
        DB::table('groups')
            ->where('id', $id)
            ->update([
                'group_name' => $validated['group_name'],
                'group_percentage' => $validated['group_percentage'],
            ]);
        return redirect()->route('add-group')->with('success', 'Group updated successfully');
    }
    
    public function getUserGroupDetails($id){
        $userGroup = DB::table('user_groups')
            ->join('user', 'user_groups.user_id', '=', 'user.id')
            ->where('user_groups.id', $id)
            ->select('user_groups.id', 'user.userid as user_id','group_id')
            ->first();
        return response()->json($userGroup);
    }
    
    public function updateUserGroup(Request $request, $id){
        $validated = $request->validate([
        'group_id' => 'required|exists:groups,id',
    ]);
    $usergroup = DB::table('user_groups')->where('id', $id)->first();
    DB::table('user_groups')
        ->where('id', $id)
        ->update([
            'group_id' => $validated['group_id']
        ]);
    $userGroup = [
        "user_id" => $usergroup->user_id,
        "previous_group_id" => $usergroup->group_id,
        "update_group_id" => $validated['group_id']
    ];
    DB::table("user_groups_history")->insert($userGroup);

    return redirect()->route('group_wise')->with('success', 'Group assignment updated successfully!');
}
    
    
    // ******************************************** Add Function for Group By Afzal (End) ***********************************************************************




}




















 