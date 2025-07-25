<?php

namespace App\Http\Controllers\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BtreeController;
use App\Http\Controllers\MLMController;
use DateTime ;
use Carbon\Carbon;
use App\Models\User;
class DashboardController extends Controller
{
 
    public function testing1(){
        $mlm = new MLMController;
        //   dd($mlm->getLegBusiness());
        //  $powerweekleg=$mlm->GetPowerWeekLeg();
        //  dd(Auth::user()->id);
        //  dd($powerweekleg);
    }
    
    public function bfi_amount_by_user(Request $request)
    {
        $user_id = Auth::user()->id;
        $today = Carbon::now()->toDateString();
        $alreadyClicked = DB::table('user_clicks')->where('user_id', $user_id)->where('click_date', $today)->exists();
        if ($alreadyClicked) {
            return back()->with('error', 'You can only click once per day!');
        }
        $package = DB::table('package')->where('cost', $request->amount)->first();
        $business_setup = DB::table("business_setup")->first();
        $bfi_percent = $business_setup->bfi_percent;
        $calculation_bfi = $package->cost * $bfi_percent / 100;
        
        DB::table('user_clicks')->insert([
            'user_id' => $user_id,
            'amount' => $calculation_bfi,
            'type' => 'mini_bfi',
            'up_id' => $request->amount,
            'click_date' => $today,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        $insert_income = [
            "credit_debit" => 'credit',
            "received_user" => $user_id,
            "joined_user" => $user_id,
            "amount" => $calculation_bfi,
            "type" => 'mini_bfi',
            "up_id" => $request->amount,
        ];
        DB::table("income_history")->insert($insert_income);
    
       return redirect()->back()->with('success', 'Congratulations! You have successfully mined your BFI amount for today.');
    }
 
    public function index(Request $request){
        $id=Auth::user()->id;
        $user_login=Auth::user();
        
        // dd($id);
        
        $mlm = new MLMController;
        $mlm->downline($user_login, false, true);
        $team = $mlm->getDownline();
        $mlm->PowerWeekLeg($user_login);
        $powerweekleg=$mlm->getLegBusiness(Auth::user()->id);
        $total_team=0;
        $total_active=0;
        $total_inactive=0;
       
        $total_team_investment=0;
         $startOfMonth = (new DateTime())->modify('first day of this month')->setTime(0, 0, 0);
         $endOfMonth = (new DateTime())->modify('last day of this month')->setTime(23, 59, 59);
        $total_team_investment_monthly = 0;
        
        
        
        foreach($team as $teams){
            foreach($teams as $teams2){
              $total_team++;
              $check_count=DB::table("user_package")->where("user_id",$teams2->id)->where("status","approved")->count();
              $total_team_investment += DB::table("user_package")->where("user_id",$teams2->id)->where("status","approved")->sum("amount");
           

              if($check_count>0){
                    $total_team_investment_monthly += DB::table('user_package')
                        ->where('user_id', $teams2->id)
                        ->where('status', 'approved')
                        ->where('activated_date', '>=', $startOfMonth)
                        ->sum('amount');
                  $total_active++;
              }else{
                  $total_inactive++;
              }
              
            }
            
            
        }
        
        $star_user=DB::table('star_user')->where('userid',"=",$id)->get();
    
        foreach($star_user as $user){}
        
        $user=Auth::user();
        $btree=new BtreeController;
        $left_right_user= $btree->getLeftRightUsers($user,$user);
        
        // dd($left_right_user);
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
    
            $total_active_user= $left_user_status + $right_user_status;
            $total_inactive_user = $total_count_left_right-$total_active_user;
            

        $get_total_bv=0;// you can change value or delete according to uncomment 62 no line
        $get_total_r_order_bv=0;// you can change value or delete according to uncomment 63 no line
        $get_total_order=0;// you can change value or delete according to uncomment 65 no line
        $get_total_r_order=0;// you can change value or delete according to uncomment 66 no line
        $total_order_amount=0;// you can change value or delete according to uncomment 73 line
        
    //      $get_total_bv=DB::table('orders')->where('user_id',$id)->sum('total_bv');
    //   $get_total_r_order_bv=DB::table('r_orders')->where('user_id',$id)->sum('total_bv');
      
    //   $get_total_order=DB::table('orders')->where('user_id',$id)->sum('total');
    //   $get_total_r_order=DB::table('r_orders')->where('user_id',$id)->sum('total');
      
      $total_bv=$get_total_bv+$get_total_r_order_bv; 
      $total=$get_total_order+$get_total_r_order;
      
        // $total_order_amount=DB::table('orders')->where('user_id',$id)->sum('total');
        
        $data = User::where('role', '=', 'user')->get();
     
        $from = date('Y-m-d h:i:s', strtotime('-7days'));
        $to = date('Y-m-d h:i:s');
        $last_7days=DB::table('user')->whereBetween('created_at', [$from, $to])->count();
        $total_dairect=DB::table('user')->where('referal',"=",Auth::user()->userid)->count();
        
        $last_7days_total_dairect=DB::table('user')->where('referal',"=",Auth::user()->userid)->whereBetween('created_at', [$from, $to])->count();
        // $last_7ays_total_team=
         $u_id=Auth::user()->id;
        $active=DB::table('user_package')->where('user_id', $u_id )->where('status', '=', 'approved') ->exists();
        
          $userid= Auth::user()->id; 
           
        //  $dash = DB::table('orders')->where('user_id',$userid)->orderBy('id','DESC')->take(6)->get();
        $dash=0;
         //dd( $dash);
        //  $credit_amount=DB::table('income_history')->where('received_user',Auth::user()->id)->where('status','paid')->sum('amount');
         $credit_amount=0;
        
        
        
        $mlm=new MLMController;
       $mlm->recurseUserLevelListAll($user);
         $total_count_left_right=count($mlm->getLevelUsersAll());
         
        $user_package_id = DB::table("user_package")->where("user_id", $userid)->orderBy('created_at', 'desc')->pluck('amount')->first();
        $today = Carbon::now()->toDateString();
        $alreadyClicked = DB::table('user_clicks')->where('user_id', $userid)->where('click_date', $today)->exists();
        $bfi_amount=DB::table('income_history')->where('received_user',Auth::user()->id)->where('type','mini_bfi')->sum('amount');
        $business_setup = DB::table("business_setup")->first();
        $bfi_percent = $business_setup->bfi_percent;
        
        //  Lottery Code
    
        $currentYear = Carbon::now()->year;
        $previousYear = $currentYear - 1;
        $currentWeek = Carbon::now()->format('W');
        $formattedString= "{$currentYear}-{$currentWeek}";
    
        $lottery_weeks = DB::table('lottery_entries')
                ->join('user', 'user.id', '=', 'lottery_entries.user_id')
                ->select('user.userid', 'user.first_name', 'user.last_name','user.create_date', 'lottery_entries.status', 'lottery_entries.investment_amount')
                ->where('week_year',  $formattedString)
                ->groupBy('user_id')
                ->take(11)
                ->get();
        $lottery_weeks_users_count = count(DB::table('lottery_entries')
                ->join('user', 'user.id', '=', 'lottery_entries.user_id')
                ->select('lottery_entries.investment_amount')
                ->where('week_year',  $formattedString)
                ->groupBy('user_id')
                ->get());
                
        $topEarners = $this->lottery_winner_list_index();
        // dd($topEarners) ;
        
        $week = Carbon::now()->startOfWeek()->format('Y') . '-W' . Carbon::now()->format('W');
        $weekFormatted = str_replace('-W', '-',$week);
        
        $percentage = DB::table('weekly_distributions')
            ->where('week_year', $weekFormatted)
            ->select('first_winner_percent', 'second_winner_percent', 'third_winner_percent','fourth_winner_percent','fifth_winner_percent','sixth_winner_percent','seventh_winner_percent','eighth_winner_percent','ninth_winner_percent','tenth_winner_percent')
            ->first();
            
        return view('user.Dashboard', compact('lottery_weeks','data','last_7days','total_dairect','total_active_user','total_inactive_user','get_total_bv','total_bv','total','total_order_amount','total_count_left_right','last_7days_total_dairect','active','dash','credit_amount','total_inactive','total_active','total_team','total_team_investment','total_team_investment_monthly','powerweekleg','user_package_id','alreadyClicked','bfi_amount','bfi_percent','topEarners','percentage', 'lottery_weeks_users_count'));
        
        
        
       }
    
    
    
    // testing lottery
    public function index_test(Request $request){
        $id=Auth::user()->id;
        $user_login=Auth::user();
        
        // dd($id);
        
        $mlm = new MLMController;
        $mlm->downline($user_login, false, true);
        $team = $mlm->getDownline();
        $mlm->PowerWeekLeg($user_login);
        $powerweekleg=$mlm->getLegBusiness(Auth::user()->id);
        $total_team=0;
        $total_active=0;
        $total_inactive=0;
       
        $total_team_investment=0;
         $startOfMonth = (new DateTime())->modify('first day of this month')->setTime(0, 0, 0);
         $endOfMonth = (new DateTime())->modify('last day of this month')->setTime(23, 59, 59);
        $total_team_investment_monthly = 0;
        
        
        
        foreach($team as $teams){
            foreach($teams as $teams2){
              $total_team++;
              $check_count=DB::table("user_package")->where("user_id",$teams2->id)->where("status","approved")->count();
              $total_team_investment += DB::table("user_package")->where("user_id",$teams2->id)->where("status","approved")->sum("amount");
           

              if($check_count>0){
                    $total_team_investment_monthly += DB::table('user_package')
                        ->where('user_id', $teams2->id)
                        ->where('status', 'approved')
                        ->where('activated_date', '>=', $startOfMonth)
                        ->sum('amount');
                  $total_active++;
              }else{
                  $total_inactive++;
              }
              
            }
            
            
        }
        
        $star_user=DB::table('star_user')->where('userid',"=",$id)->get();
    
        foreach($star_user as $user){}
        
        $user=Auth::user();
        $btree=new BtreeController;
        $left_right_user= $btree->getLeftRightUsers($user,$user);
        
        // dd($left_right_user);
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
    
            $total_active_user= $left_user_status + $right_user_status;
            $total_inactive_user = $total_count_left_right-$total_active_user;
            

        $get_total_bv=0;// you can change value or delete according to uncomment 62 no line
        $get_total_r_order_bv=0;// you can change value or delete according to uncomment 63 no line
        $get_total_order=0;// you can change value or delete according to uncomment 65 no line
        $get_total_r_order=0;// you can change value or delete according to uncomment 66 no line
        $total_order_amount=0;// you can change value or delete according to uncomment 73 line
        
    //      $get_total_bv=DB::table('orders')->where('user_id',$id)->sum('total_bv');
    //   $get_total_r_order_bv=DB::table('r_orders')->where('user_id',$id)->sum('total_bv');
      
    //   $get_total_order=DB::table('orders')->where('user_id',$id)->sum('total');
    //   $get_total_r_order=DB::table('r_orders')->where('user_id',$id)->sum('total');
      
      $total_bv=$get_total_bv+$get_total_r_order_bv; 
      $total=$get_total_order+$get_total_r_order;
      
        // $total_order_amount=DB::table('orders')->where('user_id',$id)->sum('total');
        
        $data = User::where('role', '=', 'user')->get();
     
        $from = date('Y-m-d h:i:s', strtotime('-7days'));
        $to = date('Y-m-d h:i:s');
        $last_7days=DB::table('user')->whereBetween('created_at', [$from, $to])->count();
        $total_dairect=DB::table('user')->where('referal',"=",Auth::user()->userid)->count();
        
        $last_7days_total_dairect=DB::table('user')->where('referal',"=",Auth::user()->userid)->whereBetween('created_at', [$from, $to])->count();
        // $last_7ays_total_team=
         $u_id=Auth::user()->id;
        $active=DB::table('user_package')->where('user_id', $u_id )->where('status', '=', 'approved') ->exists();
        
          $userid= Auth::user()->id; 
           
        //  $dash = DB::table('orders')->where('user_id',$userid)->orderBy('id','DESC')->take(6)->get();
        $dash=0;
         //dd( $dash);
        //  $credit_amount=DB::table('income_history')->where('received_user',Auth::user()->id)->where('status','paid')->sum('amount');
         $credit_amount=0;
        
        
        
        $mlm=new MLMController;
       $mlm->recurseUserLevelListAll($user);
         $total_count_left_right=count($mlm->getLevelUsersAll());
         
        $user_package_id = DB::table("user_package")->where("user_id", $userid)->orderBy('created_at', 'desc')->pluck('amount')->first();
        $today = Carbon::now()->toDateString();
        $alreadyClicked = DB::table('user_clicks')->where('user_id', $userid)->where('click_date', $today)->exists();
        $bfi_amount=DB::table('income_history')->where('received_user',Auth::user()->id)->where('type','mini_bfi')->sum('amount');
        $business_setup = DB::table("business_setup")->first();
        $bfi_percent = $business_setup->bfi_percent;
        
        //  Lottery Code
    
        $currentYear = Carbon::now()->year;
        $previousYear = $currentYear - 1;
        $currentWeek = Carbon::now()->format('W');
        $formattedString= "{$currentYear}-{$currentWeek}";
    
        $lottery_weeks = DB::table('lottery_entries')
                ->join('user', 'user.id', '=', 'lottery_entries.user_id')
                ->select('user.userid', 'user.first_name', 'user.last_name','user.create_date', 'lottery_entries.status')
                ->where('week_year',  $formattedString)
                ->groupBy('user_id')
                ->get();
                
        $topEarners = $this->lottery_winner_list_index();
        // dd($topEarners) ;
        
        $week = Carbon::now()->startOfWeek()->format('Y') . '-W' . Carbon::now()->format('W');
        $weekFormatted = str_replace('-W', '-',$week);
        
        $percentage = DB::table('weekly_distributions')
            ->where('week_year', $weekFormatted)
            ->select('first_winner_percent', 'second_winner_percent', 'third_winner_percent')
            ->first();
            
        return view('user.Dashboard_demo_test', compact('lottery_weeks','data','last_7days','total_dairect','total_active_user','total_inactive_user','get_total_bv','total_bv','total','total_order_amount','total_count_left_right','last_7days_total_dairect','active','dash','credit_amount','total_inactive','total_active','total_team','total_team_investment','total_team_investment_monthly','powerweekleg','user_package_id','alreadyClicked','bfi_amount','bfi_percent','topEarners','percentage'));
        
        
        
    }
    
    public function lottery_winner_list_index(){
        $lottery = DB::table('lottery_results')->orderBy('id', 'DESC')->first();
        $topEarners = [];
        if ($lottery && $lottery->winners) {
            $winnerPairs = explode(',', trim($lottery->winners, '{}'));
            $winnerIds = [];
            // $pointsMap = [];
    
            foreach ($winnerPairs as $pair) {
                [$userId, $points] = explode(':', $pair);
                $userId = trim($userId);
                $winnerIds[] = $userId;
                // $pointsMap[$userId] = $points; 
            }
    
            if (!empty($winnerIds)) {
                $topEarners = DB::table('lottery_entries as le')
                    ->join('user as u', 'u.id', '=', 'le.user_id')
                    ->select(
                        'u.userid',
                        'u.first_name',
                        'u.last_name',
                        'u.image',
                        'le.winning_amount',
                        'le.id'
                    )
                    ->where('le.week_year', $lottery->week_year)
                    ->whereIn('le.id', $winnerIds)
                    ->groupBy('le.user_id')
                    ->get();
                // foreach ($topEarners as $winner) {
                //     $winner->points = $pointsMap[$winner->id] ?? 0;
                // }
                $topEarners = $topEarners->sortBy(function ($item) use ($winnerIds) {
                            return array_search($item->id, $winnerIds);
                        })->values();
                // $topEarners = $topEarners->values();
            }
        }
        return $topEarners;
    }
    public function test(){
        
       return view('user.index');
    }
   
    public function direct_user(){
        return view('user.direct_user');
    }
     public function id_card(){
       $idcard = DB::table('idcard_setting')->get();
       //dd($idcard);
        return view('user.id_card',compact('idcard'));
    }
     public function welcome_letter(){
         
          $welcomeletter = DB::table('welcome_letter_images')
                ->join('welcome_letter_setting', 'welcome_letter_images.content_id', '=', 'welcome_letter_setting.id')
                ->select('welcome_letter_images.*', 'welcome_letter_setting.*', 'welcome_letter_images.id')  
                ->Where('welcome_letter_images.is_applied' , '1')
                ->first();
          
          if(!$welcomeletter){
             
              $DefaultWelcomeLetter = DB::table('welcome_letter_setting')->first();
                return view('user.welcome_letter',[
                    'welcomeletter' => null, 
                    'DefaultWelcomeLetter' => $DefaultWelcomeLetter
                    ]);
              
          }
          
         //dd('$welcomeletter');
        return view('user.welcome_letter',compact('welcomeletter'));
    }
    
    public function signup($userid){

    $arr=[];

    foreach($userid as $row){
        $res=DB::table('user')->where('referal',  $row)->get();
        foreach($res as $f_child)
        {
        $arr[] = $f_child->userid;
        }
    }

    return $arr;

    }

   
  public function FindAllReferalUserUnderAuser(Request $request){
           
            $levelid=$request->level;
            $uid=$request->userid;
            $userid=array($uid);
            for($i=1;$i<=$levelid;$i++){
                $userid=$this->signup($userid); // level 1 
            }
            return view('user.searchLevelUser', compact('userid'));
        
   }


    public function downline(Request $request){
         $id=Auth::user()->id;
    
        $userid = $request->userid;
        if($userid){
            $userid = $request->userid;
           }
           else{
            $userid= Auth::user()->userid;
           }
      
   $referal = DB::table('user')->where('referal',$userid)->get();
   
   
        // dd($id);
        $star_user=DB::table('star_user')->where('userid',"=",$id)->get();
        foreach($star_user as $users){}
        $btree=new BtreeController;
        $left_right_user= $btree->getLeftRightUsers($users,$users);
        $count_right = count($left_right_user['right']);
        $count_left = count($left_right_user['left']);
        $total_downline = $count_right + $count_left;
        // dd($total_downline);
//    $level_count=count($referal);
         $date=date("Y-m-d");
     $left_right_business=$btree->getLeftRightBusiness($left_right_user);
    
       $today_left_right_business=$btree->getTodaysLeftRightBusiness($left_right_user,$date);

     $total_left_business=$left_right_business['left'];
     $total_right_business=$left_right_business['right'];
     $today_total_left_business=$today_left_right_business['left'];
     $today_total_right_business=$today_left_right_business['right'];
         
        return view ('user.downline', compact('referal','total_downline','count_left','count_right','left_right_business','total_left_business','total_right_business','today_total_left_business','today_total_right_business'));
    }
       
        public function activate_user(){
             $crypto_type=DB::table('crypto_type')->first();
            //  dd($crypto_type);
            
            $receiverAddress = DB::table('dapp_settings')->where('setting_key', 'reciever_address')->pluck('setting_value')->first();
            
        return view('user.activate_user',compact('crypto_type', 'receiverAddress'));
    }
      public function activation_fund_history(){
             $user_id= Auth::user()->id;
          $user_package=DB::table("user_package")->where("user_id",$user_id)->where("active_status",1)->get();
        return view('user.activation_fund_history',compact('user_package'));
    }
    
  
    
    public function add_fund(Request $request){
        $user_id= Auth::user()->id;

           $get_data = DB::table('add_fund')->where('unique_id',$user_id)->get();
           
           

   if(!empty($get_data['0']->id)){
       $amt=$get_data['0']->amount;
   }else{
       $amt=0;
   }

         return view('user.add_fund', compact('amt','get_data'));
    }
    

    
     public function addfund(Request $request){
         
        // dd($request->all());
         $unique_id=Auth::user()->id;
          $userid= Auth::user()->userid;
          $get_data = DB::table('add_fund')->where('user_id',$userid)->where('status',"=",'pending')->get();
            $request->validate([
             
            'amount'=>'required',
            'proof_of_payment'=>'required',
         ]);
        //   dd($get_data);
         $get_data_count = count($get_data);
         if($get_data_count>0){
               
             $request->session()->flash('error','You are already requested');  
              return redirect()->back();
         }else{
           
       
         if ($request->file('proof_of_payment')) {
        $file = $request->file('proof_of_payment');
       
        $filename = 'IMG_'.time() . "." . $file->getClientOriginalExtension();
        
        $path='profileupload/';
        $request->file('proof_of_payment')->storeAs($path, $filename);
          $data=array(
               
              'unique_id'=>$unique_id,
            'user_id'=>$userid,
            'crypto_type'=>$request->crypto_type,
            'amount'=>$request->amount,
            'proof_of_payment'=>$filename,
            );
        //  dd($data);die;
          $value = DB::table('add_fund')->insert($data);
         }else{
              $value = DB::table('add_fund')->insert($data);
         }
         
         
          $request->session()->flash('success','Successfully Requested Fund');  
        return  redirect()->back();
    }
     }
    public function crypto_data(Request $request){
        if(!($request->crypto_type)){
            $id = $request->input('crypto_type');
           $value= DB::table('crypto_type')->where('id',$id)->get();
            $crypto = count($value);
            if($crypto>0){
              echo "hello";  
            }
        }
       
    }
    
     public function fund_history(){
         $userid = Auth::user()->userid;
         $data = DB::table('add_fund')->where('user_id',$userid)->get();
        return view('user.fund_history', compact('data'));
    }
     public function ptop_transefer(){
         
       
        return view('user.ptop_transefer');
    }
    public function transfer_history(){
         $id=Auth::user()->id;
        //  dd($id);
          $ptop_transeferr=DB::table('ptop_transefer')
                ->join('user as ru', 'ptop_transefer.receiver_id','=','ru.id')
                ->join('user as su', 'ptop_transefer.sender_id','=','su.id')
                ->select('ptop_transefer.*','ru.userid as ruserid','ru.first_name as rfirst_name','ru.last_name as rlast_name', 'su.userid as suserid','su.first_name as sfirst_name','su.last_name as slast_name')
                ->where('sender_id','=',$id)
                ->orWhere('receiver_id','=',$id)
                ->get();
        //  $ptop_transeferr=DB::table("ptop_transefer")->where("receiver_id","=",$id)->get();
        //  dd($ptop_transefer);
        return view('user.transfer_history',compact('ptop_transeferr'));
    }
 
     public function withdrawl_to_fund_history(){
        return view('user.withdrawl_to_fund_history');
    } 
    public function add_withdrawal_to_fund(Request $request){
        $id=Auth::user()->id;
        if($request->password==Auth::user()->transaction_password){
            $withdrawl_wallet = "";
            if($request->from_wallet ==null || $request->to_wallet == null){
               $request->session()->flash('error',"Please Select Wallet Type");
               return redirect()->back();
            }elseif($request->from_wallet == "withdrawl_wallet" && $request->to_wallet == "saving_wallet"){
                $withdrawl_wallet=Auth::user()->withdrawl_wallet;
            }elseif($request->from_wallet == "saving_wallet" && $request->to_wallet == "withdrawl_wallet"){
                $request->session()->flash('error',"You will not transfer from activation wallet to withdrawal wallet !");
                return redirect()->back();
                // $withdrawl_wallet=Auth::user()->saving_wallet;
            }else{
                $request->session()->flash('error',"Invalid Wallet address selected!");
               return redirect()->back();
            }
            //   else{
            //       if($request->select_wallet=="club_wallet"){
            //           $currentd=date("d");
            //         $withdrawl_wallet=Auth::user()->club_wallet;
            //   }else if($request->select_wallet=="incentive_wallet"){
            //         $withdrawl_wallet=Auth::user()->incentive_wallet;
            //   }elseif($request->select_wallet=="withdrawl_wallet"){
            //         $currentd=date("d");
            //         $withdrawl_wallet=Auth::user()->withdrawl_wallet;
            //   }elseif($request->select_wallet=="reward_wallet"){
                   
            //         $withdrawl_wallet=Auth::user()->reward_wallet;
            //   }elseif($request->select_wallet=="from_wallet"){
            //       $currentd=date("d");
            //         $withdrawl_wallet=Auth::user()->withdrawl_wallet;
            //   }
            if(empty($withdrawl_wallet)){
                $request->session()->flash('error',"Withdrawal wallet is not selected !");
                return redirect()->back();
            }
            $amount=$request->amount;
            if ($amount < 20) {
                $request->session()->flash('error', 'The minimum amount for transfer should be more than $20.');
                return redirect()->back();
            }
            $recieve_amount = $amount;
            if($request->to_wallet == "saving_wallet"){
                $recieve_amount=$amount-($amount*5/100);
            }
            $transaction_type=$request->transaction_type;
            $description=$request->description;
            $user_id=$request->user_id;
            if($amount > $withdrawl_wallet){
                //   echo "insufficient balance";
                $request->session()->flash('error',"Insufficient Balance");
                return redirect()->back();
            }else{
                DB::table('transaction')->insert([
                    'amount'=>$amount,
                    'recieve_amount'=> $recieve_amount,
                    'transaction_type'=> $transaction_type,
                    'description'=>$description,
                    'from_id'=>$id,
                    'to_id'=>$id,
                    'wallet_type'=>$request->from_wallet,
                    'to_wallet'=>$request->to_wallet
                ]);
                DB::table('user')->where('id',$id)->decrement($request->from_wallet,$amount);
                DB::table('user')->where('id',$id)->increment($request->to_wallet, $recieve_amount); 
                $request->session()->flash('success',"Transfer Successfully"); 
                return redirect()->back();
            }
        }else{
            $request->session()->flash('error',"Please enter correct password");
            return redirect()->back();
        }
       
       
    }
     public function withdrawl_to_fund(){
        return view('user.withdrawl_to_fund');
    }
    
        public function products(){
        return view('user.products');
    }
    
        public function order_history(){ 
          $id=Auth::user()->id;
          $data = DB::table('orders')->join('user', 'orders.user_id','=','user.id')->select('orders.*','user.userid','user.first_name','user.last_name')->where('user_id',$id)->get(); 
        //  $total_order_amount=DB::table('orders')->where('user_id',$id)->sum('total');

         // dd($total_order_amount);
        return view('user.order_history',compact('data' ));
    }
    
        public function mywallet(){
        return view('user.mywallet');
    }
    
      public function r_order_history(){
          $id=Auth::user()->id;
         $data = DB::table('r_orders')->join('user', 'r_orders.user_id','=','user.id')->select('r_orders.*','user.userid','user.first_name','user.last_name')->where('user_id',$id)->orderBy('id','DESC')->get(); 
         
        // dd($data); die;
        return view('user.r_order_history',compact('data'));
    }
    public function r_orders(Request $request){
            
        $id=$request->id; 
        $result=DB::table('r_orders')->where('id', $id)->get();
        $data=$result;
        $data=json_decode($result['0']->products);
        $qty=0;
        $price=0;
        $totaldp=0;
        $totalmrp=0;
        $totalbv=0;
        foreach($data as $row){
             $product=DB::table('products')->where('id', $row->id)->get();
             $qty+=$row->quantity;
             $totaldp+=($row->r_price-($row->r_price*$product['0']->discount)/100)*$row->quantity;
             $totalbv+=($product['0']->business_value)*$row->quantity;
             $totalmrp+=($row->r_price)*$row->quantity;
        ?>
         <tr>
             <td><?php echo $row->name; ?></td>
             <td><?php echo $row->quantity; ?> </td>
             <td><?php echo $row->r_price; ?> * <?php echo $row->quantity ;?> </td>
             <td><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo ($row->r_price-($row->r_price*$product['0']->discount)/100)*$row->quantity; ?></td>
             <td><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo ($row->r_price-($row->r_price*$product['0']->discount)/100)*$row->quantity; ?></td>
             <td><?php echo $product['0']->business_value; ?> * <?php echo $row->quantity ;?> </td>
            
         </tr>
        <?php }?>
           
         
         <tr class="table-dark">
             <td>Total</td>
             <td><?php echo $qty; ?> </td>
             <td><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo $totalmrp; ?></td>
              <td><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo $totaldp; ?></td>
              <td><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo $totaldp;?> </td>
             <td><?php echo $totalbv; ?></td>
          
         </tr>
        <?php
    }
    
      public function generateInvoice(Request $request){
    
        $id=Auth::user()->id;
        $OrderId=$request->id;
        $data=DB::table('business_setup')->get();
        $r_orders=DB::table('r_orders')->where('id' , $OrderId)->get();
        return view('user.generateInvoice', compact('data', 'r_orders'));
        
    }
     
    
      public function wallet_details(){
        return view('user.wallet_details');
    }
    
      public function payout_summary(){
        return view('user.payout_summary');
    }
    
      public function support(){
          $result=DB::table('business_setup')->get();
        //   dd($result);
        return view('user.support', compact('result'));
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
        public function ptop_receive_transfer(){
         $id=Auth::user()->id;
        //  dd($id);
          $ptop_transeferr=DB::table('ptop_transefer')->join('user', 'ptop_transefer.sender_id','=','user.id')->select('ptop_transefer.*','user.userid','user.first_name','user.last_name')->where('receiver_id','=',$id)->get();
        //  $ptop_transeferr=DB::table("ptop_transefer")->where("receiver_id","=",$id)->get();
        //  dd($ptop_transeferr);
        return view('user.ptop_receive_transfer',compact('ptop_transeferr'));
    }
    
     public function check_amount_transfer(Request $request){
        $amount=$request->amount;
         $response = array();
         
        
        if($request->wallet!=null){
            if($request->wallet=="club_wallet"){
                   $withdrawl_wallet=Auth::user()->club_wallet;
            }elseif($request->wallet=="withdrawl_wallet"){
                   $withdrawl_wallet=Auth::user()->withdrawl_wallet;
            }elseif($request->wallet=="incentive_wallet"){
                   $withdrawl_wallet=Auth::user()->incentive_wallet;
            }elseif($request->wallet=="reward_wallet"){
                   $withdrawl_wallet=Auth::user()->reward_wallet;
            }elseif($request->wallet=="saving_wallet"){
                   $withdrawl_wallet=Auth::user()->saving_wallet;
            }
            
     
        if($amount>$withdrawl_wallet){
            $response['status'] =  201;
            $response['result'] = 'Insufficient Fund';
        }else if($amount<5){
            $response['status'] =  201;
            $response['result'] = 'Minimum Transfer Amount is 5';
        }else{
            $response['status'] =  200;
            $response['result'] = 'Success';
        }
        }else{
             $response['status'] =  201;
            $response['result'] = 'Please Select Wallet Type';
        }
       
        return response()->json($response);
    }
    
     public function check_amount_aadfund(Request $request){
        // print_r($request->all());
        $amount=$request->amount;
         $response = array();
        $saving_wallet=$request->saving_wallet;
        if($amount >$saving_wallet){
            $response['status'] =  201;
            $response['result'] = 'Insufficient Fund';
        } 
        return response()->json($response);
    }
     public function withdrawl_history(Request $request){
         $id=Auth::user()->id;
         
           $currency = "dollar";
         
         if(!empty($request->query('currency'))){
             
             if($request->query('currency') == "dollar"){
                $currency = $request->query('currency'); 
             }else if($request->query('currency') == 'inr'){
                 $currency = "inr";
             }
        }
          
         $transaction=DB::table('withdrawl_request')->join('user', 'withdrawl_request.user_id','=','user.id')->select('withdrawl_request.*','user.userid')->where('withdrawl_request.currency_type', $currency)->where('user_id','=',$id)->get();
         $title= "withdrawl to fund history";
         
           $totalDollarPaid = 0;
        $totalInrPaid = 0;
        
        if ($transaction->isNotEmpty()) {
            $totalDollarPaid = $transaction->pluck('amount')->sum();
            $totalInrPaid = $transaction->pluck('amount_inr')->sum();
        }
         
        // print_r($transaction);die;
        return view('user.withdrawl_history',compact('transaction','title', 'currency', 'totalDollarPaid', 'totalInrPaid'));
    }
    
    public function withdrawl_income()
    {
      return view('user.withdrawl_income');
    }


    public function withdrawl_income1(Request $request)
    { 
        
       
        // dd($request->all());
           $cdate=date("d");
           ini_set('max_execution_time', 6000);
          date_default_timezone_set("Asia/Calcutta"); 
         $user_tbl = Auth::user();
         
         $request->validate([
             'amount'=>'required|min:20|numeric',
             'wallet'=>'required',
             'currency'=>'required',
             'transaction_password'=>'required',
             
            ]);
          $datetime = date('Y-m-d H:i:s');
             //dd($datetime);
             
          
        $id=Auth::user()->id;
        if(Auth::user()->block_withdrawl_wallet==1){
            $request->session()->flash('error','Your withdrawal wallet is temporarily blocked  ');
            return redirect()->back();
        }else{
        if($request->currency != "inr" && $request->currency != "dollar" ){
              
             $request->session()->flash('error',"Invalid payment currency!"); 
             return redirect()->back();
        }
        
        if($request->currency == "dollar" ){
            
            if(empty(Auth::user()->tron_address)){
                return redirect()->back()->with('error', 'The USDT TRC20 Address is not set on your profile');
            }else if(!str_starts_with(Auth::user()->tron_address, "0x")){
                return redirect()->back()->with('error', 'Invalid USDT TRC20 Address is set on your profile');
            }
            
        }
        
    
        
        if(Auth::user()->transaction_password!=$request->transaction_password){
            
             $request->session()->flash('error',"Please enter Correct Transaction Password"); 
             return redirect()->back();
        }
        
      
         if($request->amount<10){
            
             $request->session()->flash('error',"Minimum withdrawl amount is 25"); 
             return redirect()->back();
        }
        
        $withdrawl_request = DB::table('withdrawl_request')->where('user_id',$id)->where('status',"=",'pending')->count();
        if($withdrawl_request>0){
        
            $request->session()->flash('error','Your previous request already pending?');
            return redirect()->back();
            
        }
        $wallet_name =$request->wallet;
        if($request->wallet=="club_wallet"){
            $withdrawl_wallet=Auth::user()->club_wallet;
            $wallet_name="club_wallet";
            
             $request->session()->flash('error',"This wallet is not supported for withdrawal!");
             return redirect()->back();
            // if($cdate>2){
            //      $request->session()->flash('error',"You Can Withdrawl between Dates from 1-2 in Every Month");
            //       return redirect()->back();
            // }
        }else if($request->wallet=="roi_wallet"){
            $withdrawl_wallet=Auth::user()->withdrawl_wallet;
            $wallet_name="withdrawl_wallet";
             if($cdate>2){
                 $request->session()->flash('error',"You Can Withdrawl between Dates from 1-2 in Every Month");
                 return redirect()->back();
            }
        }elseif($request->wallet=="incentive_wallet"){
             $withdrawl_wallet=Auth::user()->incentive_wallet;
              $wallet_name="incentive_wallet";
        
        }elseif($request->wallet=="withdrawl_wallet"){
             $withdrawl_wallet=Auth::user()->withdrawl_wallet;
              $wallet_name="withdrawl_wallet";
        }else{
            $withdrawl_wallet=Auth::user()->withdrawl_wallet;
              $wallet_name="withdrawl_wallet";
        }
        
        // dd($withdrawl_wallet);
        //   dd($request->all());
        
        $amount=$request->amount;
        $message=$request->message;
        $status=$request->status;
        $created_at= $datetime;
        
        if($amount>$withdrawl_wallet){
            //   echo "insufficient balance";
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
                        // $userId = Auth::user()->id;
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
                        //                              'user_id'=>$userId,
                        //                              'sender_id'=>DB::table('user')->where('role', 'admin')->pluck('id')->first(),
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
        }
    }
    
    public function withdrawl_request_history(){
          $id=Auth::user()->id;
         //dd($id);
          $withdrawl_request=DB::table('withdrawl_request')->where('user_id',$id)->get();
         $title= "withdrawl request history";
        // print_r($withdrawl_request);die;
        return view('user.withdrawl_request_history',compact('withdrawl_request','title'));
         
         
    
    }
    
    public function welcomepages(Request $request){
        $tabid=' ';
        $id=Auth::user()->id;
        $user=DB::table('user')->where('id',$id)->get();
        $package=DB::table('package')->get();
        $bussiness_setup=DB::table('business_setup')->get();
        return view('user.welcome_product', compact('user', 'bussiness_setup', 'package', 'tabid'));
    }
    
    public function payment(Request $request){
        $tabid=$request->id;
        $id=Auth::user()->id;
        $user=DB::table('user')->where('id',$id)->get();
        $package=DB::table('package')->get();
        $bussiness_setup=DB::table('business_setup')->get();
        return view('user.welcome_product', compact('user', 'bussiness_setup', 'package', 'tabid'));
    }
    
    
public function purchage_package_bywallet(Request $request){
         $request->validate([
             'payment_type'=>'required',
             'package_id'=>'required',
           
            
            ]);
      if(!empty($request->payment_type=='wallet')){
    
     
      $user=DB::table('user')->where('id',$request->user_id)->get();  
      if(empty($user['0']->id)){
             $request->session()->flash('message', '<p class="alert alert-danger">Your are not availabe in our database.</p>');
             return redirect()->route('payment', ['id'=>1]);
      }else{
          $packages=DB::table('package')->where('id',$request->package_id)->get();  
        
          if($user['0']->saving_wallet<$packages['0']->cost){
              $request->session()->flash('message', '<p class="alert alert-danger">Saving wallet amount must be greater than package amount.</p>');
               return redirect()->route('payment', ['id'=>1]);
          }else{
              
              $packid=$packages['0']->id;
              $uid=$request->user_id;
              $user_packagess=DB::table('user_package')->where('user_id', $uid)->where('package_id', $packid)->get();  
              if(!empty($user_packagess['0']->id)){
                  Session::flash('message', '<p class="alert alert-danger">Package has been already created.</p>');
                  return redirect()->route('payment', ['id'=>1]);
              }else{
                  $data=array(
                    'user_id'=>$request->user_id,
                    'package_id'=>$request->package_id,
                    'status'=>'approved',
                    'payment_type'=>$request->payment_type,
                    'activated_by'=>$request->activated_by,
                    'activated_date'=>date('Y-m-d H:i:s'),
                    'created_at'=>date('Y-m-d H:i:s'),
                  );
                DB::table('user_package')->insert($data);  
                $lastInsertId=DB::getPdo()->lastInsertId();
                if(!empty($lastInsertId)){
                    $updatewalletdata=array(
                           'saving_wallet'=>$user['0']->saving_wallet-$packages['0']->cost,
                    );
                    
                    $result=DB::table('user')->where('id', $request->user_id)->update($updatewalletdata); 
                    if($result>0){
                        Session::flash('message', '<p class="alert alert-success" style="">Package has been successfully created.</p>');
                        return redirect()->route('payment', ['id'=>1]);
                    }else{
                        Session::flash('message', '<p class="alert alert-danger" style="">Check error something went wrong.</p>');
                         return redirect()->route('payment', ['id'=>1]);
                    }
                }   
              }
                  
          }
      }
      }
    }
    
public function purchage_package_byupi(Request $request){
    
                $request->validate([
                     'payment_type'=>'required',
                     'package_id'=>'required',
                     'upi_id'=>'required',
                     'qr_code_image'=>'required',
                    
                    ]);   
   
        
              $user_packagess=DB::table('user_package')->where('user_id',$request->user_id)->where('package_id',$request->package_id)->get();  
   
              if(empty($user_packagess['0']->id)){
                 
                  
                  $imageName = time().'.'.$request->qr_code_image->extension();
                  $request->qr_code_image->move(public_path('assets/paymentproofImages'), $imageName);
                  $data=array(
                    'user_id'=>$request->user_id,
                    'package_id'=>$request->package_id,
                    'status'=>'pending',
                    'payment_type'=>$request->payment_type,
                    'proof_image'=>$imageName,
                    'upi_id'=>$request->upi_id,
                    'activated_by'=>$request->activated_by,
                    'created_at'=>date('Y-m-d H:i:s'),
                  );
                DB::table('user_package')->insert($data);  
                $lastInsertId=DB::getPdo()->lastInsertId();
                if(!empty($lastInsertId)){
                    
                        Session::flash('message', '<p class="alert alert-success" style="">Package has been successfully created.</p>');
                         return redirect()->route('payment', ['id'=>2]);
                   
                }   
              
              }else{
                  Session::flash('message', '<p class="alert alert-danger">Package has been already created.</p>');
                  return redirect()->route('payment', ['id'=>2]);
                  
                   
              }
                  
        
}   

  public function total_direct(){
       $total_direct=DB::table('user')->where('referal',"=",Auth::user()->userid)->get();
        //   dd($total_direct);die;
        return view('user.total_direct',compact('total_direct'));
          
    } 
 
public function total_team(Request $request) {
    //dd($request->all());
    $user = Auth::user();
     $status = null;  
   if (isset($request->status)) {
    if ($request->status == 'active') {
        $status = 'active';
    } elseif ($request->status == 'inactive') {
        $status = 'inactive';
    } else {
        $status = null;  
    }
}  
 
    $mlm = new MLMController;
    $mlm->downline($user, false, true);
    $team = $mlm->getDownline();  

     
    return view('user.total_team', compact('team', 'status'));
}


    
    public function active_users(Request $request)
    {
         $id=Auth::user()->id;
         $active_users = DB::table('user_package')->join('user', 'user_package.user_id','=','user.id')
         ->select('user_package.*','user.userid','user.first_name','user.last_name')
         ->where('user_package.status','=','approved')->get();
        // dd($active_users);
       
    
    
    
    //     $id=Auth::user()->id;
    //     $star_user=DB::table('star_user')->where('userid',"=",$id)->get();
    //     foreach($star_user as $user){}
    //     $left_user_status=array();
    //     $right_user_status=array();
    //     $btree=new BtreeController;
    //     $left_right_user= $btree->getLeftRightUsers($user,$user);
    //     $count_right = count($left_right_user['right']);
    //     $count_left = count($left_right_user['left']);
        
    //     for ($i = 0; $i < count($left_right_user['left']); $i++) {
    //             $left_user_id = $left_right_user['left'][$i];
    //       if($left_user_id >0){
    //           $left_user_status=DB::table('user_package')->where('user_id',$left_user_id)->where('status',"=",'approved')->get();
    //       }
    //         }
    //           print_r($left_user_status); die;
    //     for($i=0; $i< count($left_right_user['right']); $i++){
    //         $right_user_id=$left_right_user['right'][$i];
    //         if($right_user_id > 0){
    //             $right_user_status=DB::table('user_package')->where('user_id',$right_user_id)->where('status',"=",'approved')->get();
            
    //     }
    //   }
  
        return view('user/active_users', compact('active_users'));
    }
    
     public function profile_card(){
        return view('user.profile_card');
    }
    
     public function update_payment_details(){ 
         
         
         return view("user.update_payment_details");
     }
     
     public function update_payment(Request $request){
          $id=Auth::user()->id; 
         $usr_tbl= DB::table("user")->where("id",$id)->first();
            $request->validate([
                     'upi_usdt'=>'required',
                     'upi_image'=>'required',
                     'upi_address'=>'required',
                    
                    ]); 
                    $upi_usdt=$request->upi_usdt;
          if($request->upi_usdt=="upi" ){
              if($usr_tbl->upi_image!=null){
                  if(file_exists(public_path('user_self_payment_barcode/'.$usr_tbl->upi_image))){
                       unlink(public_path('user_self_payment_barcode/'.$usr_tbl->upi_image));
                  }
                 
              }
              $imageName = "UPI_".$id.time().".".$request->upi_image->getClientOriginalExtension(); 
               $request->upi_image->move(public_path('user_self_payment_barcode'), $imageName);      
              $data=array(
                    'upi_address'=>$request->upi_address,
                    'upi_image'=>$imageName, 
                    'create_date'=>date('Y-m-d'),
                    'update_date'=>date('Y-m-d '),
                    
                  );
                  
                 DB::table('user')->where('id',$id)->update($data);
                $request->session()->flash('success',"Update $upi_usdt Successfully");
                return redirect()->back();
          }elseif($request->upi_usdt=="usdt" ){
              if($usr_tbl->usdt_image!=null){
                  if(file_exists(public_path('user_self_payment_barcode/'.$usr_tbl->usdt_image))){
                      unlink(public_path('user_self_payment_barcode/'.$usr_tbl->usdt_image));
                  }
                  
              }
                 $imageName = "USDT_".$id.time().".".$request->upi_image->getClientOriginalExtension(); 
               $request->upi_image->move(public_path('user_self_payment_barcode'), $imageName);      
              $data=array(
                    
                    'usdt_address'=>$request->upi_address,
                    'usdt_image'=>$imageName, 
                    'create_date'=>date('Y-m-d'),
                    'update_date'=>date('Y-m-d '),
                    
                  );
                  
                  DB::table('user')->where('id',$id)->update($data);
                   $request->session()->flash('success',"Update $upi_usdt Successfully");
                return redirect()->back();
          }
          
            
         
    }
     public function get_user_usdt_upi(Request $request){ 
         $responce=[];
         $id=$request->id;
         $upi_usdt=$request->upi_usdt;
         if(!empty($upi_usdt)){
              if($upi_usdt=="usdt"){
             $data=DB::table("user")->where('id',$id)->first();
             $responce['address']=$data->usdt_address;
             $responce['image']=$data->usdt_image;
             $responce['usdt_upi']="USDT";
         }else{
              $data=DB::table("user")->where('id',$id)->first();
                 $responce['address']=$data->upi_address;
                 $responce['image']=$data->upi_image;
                 $responce['usdt_upi']="UPI";
         }
         }else{
              $responce['address']="";
                 $responce['image']="";
                 $responce['usdt_upi']="";
         }
        
         return response()->json($responce);
     }
     
     public function suspend_form(Request $request){
         
        return view('user.suspend_page');
     }
   
     public function pay_fundded_amount_by_user(Request $request){
         $user_id=Auth::user()->id;
         $saving_wallet=Auth::user()->saving_wallet;
          $tbl_user=DB::table("user")->where("id",$user_id)->first();
         $user_package=DB::table("user_package")->where('user_id',$user_id)->where('active_status',0)->first();
         if(!empty($user_package)){
             if($user_package->amount<=$saving_wallet){
                       DB::table("user_package")->where('id',$user_package->id)->update(['active_status'=>1]);
                       DB::table("user")->where('id',$user_id)->decrement('saving_wallet',$user_package->amount);
                                $mlm=new MLMController;
                                $mlm->upline($tbl_user);
                                $upline= $mlm->getUpline();
                                foreach ($upline as $key=>$uplines){
                                    $total_level=DB::table("levels")->count();
                                    if($total_level>$key){
                                    $level_id=$key+1;
                                    $levels=DB::table("levels")->where("id",$level_id)->first();
                                    $check_active=DB::table('user_package')->where("user_id",$uplines->id)->where("status","approved")->where('active_status',1)->count();
                                     $mlm2=new MLMController;
                                     $total_direct=$mlm2->getActiveDirect($uplines);
                                    //  echo $total_direct." ||| $key User Id=".$uplines->userid."<br>";
                                     $paying_amount=$user_package->amount*$levels->percent/100;
                                     if($check_active>0){
                                           if($total_direct>=$levels->direct){
                                                 $insert_income=[
                                                        "type"=>'level',
                                                        "level_no"=>$level_id,
                                                        "amount"=>$paying_amount,
                                                        "laps_amount"=>0,
                                                        "invest_amount"=>$user_package->amount,
                                                        "joined_user"=>$user_id,
                                                        "received_user"=>$uplines->id,
                                                        "credit_debit"=>"credit",
                                                        "up_id"=>$user_package->id,
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
                                                           "invest_amount"=>$user_package->amount,
                                                           "joined_user"=>$user_id,
                                                           "received_user"=>$uplines->id,
                                                           "credit_debit"=>"credit",
                                                           "up_id"=>$user_package->id,
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
                                                "invest_amount"=>$user_package->amount,
                                                "joined_user"=>$user_id,
                                                "received_user"=>$uplines->id,
                                                "credit_debit"=>"credit",
                                                "up_id"=>$user_package->id,
                                                "discription"=>"received user inactive current time",
                                            ]; 
                                         DB::table("income_history")->insert($insert_income);
                                     }
                                    }
                                    }
                                    
               return redirect()->back()->with('success','Package by successfully');
             }else{
                  return redirect()->back()->with('error','Insufficient fund!');
             }
         }else{
               return redirect()->back()->with('error','Package Not Found!');
         }
     }
     
         public function get_user_for_activation(Request $request)
    {
        $userid=$request->userid;
        
       $user_table= DB::table('user')->where('userid',"=",$userid)->where('role','user')->get();
       if(count($user_table)){
            return response()->json($user_table);
       }else{
            return response()->json(false);
       }
      
    }
    public function admins_login(Request $request){
    if (DB::table('user')->where('userid', $request->id)->exists()) {
        $user = DB::table('user')->where('userid', $request->id)->first();
       
        $user = User::find($user->id);
        
        if ($user->role == 'admin') {
          
            Auth::login($user);
        return redirect()->route('user-dashboard');
        }
    }
    dd("NO");
}


// code for new dashboard theme

 public function new_dashboard(){
        $id=Auth::user()->id;
        $user_login=Auth::user();
        // dd($id);
        
        
         $mlm = new MLMController;
         $mlm->downline($user_login, false, true);
         $team = $mlm->getDownline();
          $mlm->PowerWeekLeg($user_login);
         $powerweekleg=$mlm->GetPowerWeekLeg();
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
        $star_user=DB::table('star_user')->where('userid',"=",$id)->get();
    
        foreach($star_user as $user){}
        
        $user=Auth::user();
        $btree=new BtreeController;
        $left_right_user= $btree->getLeftRightUsers($user,$user);
        
        // dd($left_right_user);
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
    
            $total_active_user= $left_user_status + $right_user_status;
            $total_inactive_user = $total_count_left_right-$total_active_user;
            

        $get_total_bv=0;// you can change value or delete according to uncomment 62 no line
        $get_total_r_order_bv=0;// you can change value or delete according to uncomment 63 no line
        $get_total_order=0;// you can change value or delete according to uncomment 65 no line
        $get_total_r_order=0;// you can change value or delete according to uncomment 66 no line
        $total_order_amount=0;// you can change value or delete according to uncomment 73 line
        
    //      $get_total_bv=DB::table('orders')->where('user_id',$id)->sum('total_bv');
    //   $get_total_r_order_bv=DB::table('r_orders')->where('user_id',$id)->sum('total_bv');
      
    //   $get_total_order=DB::table('orders')->where('user_id',$id)->sum('total');
    //   $get_total_r_order=DB::table('r_orders')->where('user_id',$id)->sum('total');
      
      $total_bv=$get_total_bv+$get_total_r_order_bv; 
      $total=$get_total_order+$get_total_r_order;
      
        // $total_order_amount=DB::table('orders')->where('user_id',$id)->sum('total');
        
        $data = User::where('role', '=', 'user')->get();
        $from = date('Y-m-d h:i:s', strtotime('-7days'));
        $to = date('Y-m-d h:i:s');
        $last_7days=DB::table('user')->whereBetween('created_at', [$from, $to])->count();
        $total_dairect=DB::table('user')->where('referal',"=",Auth::user()->userid)->count();
        
        $last_7days_total_dairect=DB::table('user')->where('referal',"=",Auth::user()->userid)->whereBetween('created_at', [$from, $to])->count();
        // $last_7ays_total_team=
         $u_id=Auth::user()->id;
        $active=DB::table('user_package')->where('user_id', $u_id )->where('status', '=', 'approved') ->exists();
        
          $userid= Auth::user()->id; 
           
        //  $dash = DB::table('orders')->where('user_id',$userid)->orderBy('id','DESC')->take(6)->get();
        $dash=0;
         //dd( $dash);
        //  $credit_amount=DB::table('income_history')->where('received_user',Auth::user()->id)->where('status','paid')->sum('amount');
         $credit_amount=0;
        
        
        
        $mlm=new MLMController;
       $mlm->recurseUserLevelListAll($user);
         $total_count_left_right=count($mlm->getLevelUsersAll());
     
        return view('user.dashboard', compact('data','last_7days','total_dairect','total_active_user','total_inactive_user','get_total_bv','total_bv','total','total_order_amount','total_count_left_right','last_7days_total_dairect','active','dash','credit_amount','total_inactive','total_active','total_team','total_team_investment','powerweekleg'));
        
       }

}


















