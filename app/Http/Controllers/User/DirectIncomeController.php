<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IncomeHistory;
use App\Http\Controllers\MLMController;
use Auth;

class DirectIncomeController extends Controller
{
    public function global_sponser_income(Request $request){

      
       $global_sponser_income= DB::table('income_history')->join('user', 'income_history.help_sender_id','=','user.id')->select('income_history.*','user.userid','user.first_name','user.last_name')->where('income_history.type','=','global_sponser')->where('income_history.received_user','=',Auth::user()->id)->orderBy('id','desc')->get();
        $data=compact('global_sponser_income');
         
        return view("user.global_sponser_income")->with($data);
    }
    
    public function global_level_income(Request $request){

      
       $global_level_income= DB::table('income_history')->join('user', 'income_history.help_sender_id','=','user.id')->select('income_history.*','user.userid','user.first_name','user.last_name')->where('income_history.type','=','global_level')->where('income_history.received_user','=',Auth::user()->id)->orderBy('id','desc')->get();
        $data=compact('global_level_income');
        
        return view("user.global_level_income")->with($data);
    }
    
    
    public function direct_income_list(Request $request){

      
       $direct_income= DB::table('income_history')->join('user', 'income_history.joined_user','=','user.id')->select('income_history.*','user.userid','user.first_name','user.last_name')->where('income_history.type','=','trading_bonus')->where('income_history.received_user','=',Auth::user()->id)->orderBy('id','desc')->get();
       
       $level_income_first=DB::table('income_history')->join('user','income_history.joined_user','=','user.id')->select('income_history.*','user.userid','user.first_name','user.last_name')->where('income_history.type','=','level')->where('income_history.level_no','1')->where('income_history.received_user','=',Auth::user()->id)->orderBy('id','desc')->get();
       
        $data=compact('direct_income','level_income_first');
        
        return view("user.income_history")->with($data);
    }
    
    public function royality_income(){
         $royality_income= DB::table('income_history')->join('user', 'income_history.joined_user','=','user.id')->select('income_history.*','user.userid','user.first_name','user.last_name')->where('income_history.type','=','royality')->where('income_history.received_user','=',Auth::user()->id)->orderBy('id','desc')->get();
         $data=compact('royality_income');
        
        return view("user.royality_income")->with($data);
    }
    
    public function salary_income(){
         $salary_income= DB::table('income_history')->join('user', 'income_history.joined_user','=','user.id')->select('income_history.*','user.userid','user.first_name','user.last_name')->where('income_history.type','=','salary')->where('income_history.received_user','=',Auth::user()->id)->orderBy('id','desc')->get();
         $data=compact('salary_income');
        
        return view("user.salary_income")->with($data);
    }
    
     public function level_income(Request $request){

     
    //   $level_income= DB::table('income_history')->join('user', 'income_history.joined_user','=','user.id')->select('income_history.*','user.userid','user.first_name','user.last_name')->where('income_history.type','=','level')->where('income_history.credit_debit','=','credit')->where('income_history.received_user','=',Auth::user()->id)->get();
       
       $level = DB::table('levels')->get();
       $user=Auth::user();
       $mlmc2=new MLMController();
                   $mlmc2->direct($user);
                 $direct=$mlmc2->getdirect();
                $total_direct=count($direct);
       
       
       
        $data=compact('level','total_direct');
     
        return view("user.level_income")->with($data);


    }
  
         public function credit_matching_income(){
      
        return view("user.credit_matching_income");
  }
  
         public function credit_autopool_income(){
         return view("user.credit_autopool_income");
  }
  
  public function debit_direct_income(){
        $direct_income= DB::table('income_history')->join('user', 'income_history.joined_user','=','user.id')->select('income_history.*','user.userid','user.first_name','user.last_name')->where('income_history.type','=','direct')->where('income_history.joined_user','=',Auth::user()->id)->orderBy('id','desc')->get();
        $data=compact('direct_income');
         return view("user.debit_direct_income")->with($data);
  }
   
  
  public function debit_matching_income(){
       $direct_income= DB::table('income_history')->join('user', 'income_history.joined_user','=','user.id')->select('income_history.*','user.userid','user.first_name','user.last_name')->where('income_history.type','=','matching')->where('income_history.joined_user','=',Auth::user()->id)->orderBy('id','desc')->get();
        $data=compact('direct_income');
         return view("user.debit_matching_income")->with($data);
  }
  
  public function debit_autopool_income(){
      $direct_income= DB::table('income_history')->join('user', 'income_history.joined_user','=','user.id')->select('income_history.*','user.userid','user.first_name','user.last_name')->where('income_history.type','=','autopool')->where('income_history.joined_user','=',Auth::user()->id)->orderBy('id','desc')->get();
        $data=compact('direct_income');
         return view("user.debit_autopool_income")->with($data);
  }
  public function global_star_income(){
      $global_income=DB::table('income_history')->join('user', 'income_history.received_user','=','user.id')->select('income_history.*','user.userid','user.first_name','user.last_name')->where('income_history.type','=','roi')->where('income_history.received_user','=',Auth::user()->id)->orderBy('id','desc')->get();
      $data=compact('global_income'); 
         return view("user.global_star_income")->with($data);
  }
  
  public function help_send(){
      $club_level=DB::table("club_level")->get();
      $data=compact('club_level');
         return view("user.help_send")->with($data);
  }
  public function company_turn_over_income(){
      $company_turn_over_income=DB::table('income_history')
      ->join('user', 'income_history.joined_user','=','user.id')
      ->select('income_history.*','user.userid','user.first_name','user.last_name')
      ->where('income_history.type','=','reward')
      ->where('income_history.joined_user','=',Auth::user()->id)
      ->orderBy('id','desc')
      ->get();
      $data=compact('company_turn_over_income');
         return view("user.company_turn_over_income")->with($data);
  }
  
  public function reward(){
      $reward=DB::table("reward_vip")->get();
      return view("user.reward",compact('reward'));
  }
}






