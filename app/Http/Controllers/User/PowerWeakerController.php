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
use App\Http\Controllers\MLMController;

class PowerWeakerController extends Controller
{
   
   public function powerLeg(){
       
        $mlm = new MLMController;
        $directsBusiness=$mlm->getDirectsTeamBusiness(Auth::user()->id);
        // dd($directsBusiness);
        $data = array();
        $data['power_available'] = false;
        $data['power_leg_id'] = "";
        $data['power_self_business'] = 0;
        $data['power_business'] = 0;
        $data['team_member_count'] = 0;
        $data['team_with_business'] = 0;
        $data['team'] = [];
        if(count($directsBusiness) > 0){
                
              $max_key = array_search(max($directsBusiness), $directsBusiness);
              
              $data['power_leg_id']  = $max_key;
              
              $data['power_business'] = max($directsBusiness);
              
              if($data['power_business'] > 0){
                  $data['power_available'] = true;
              }
              
              $data['power_self_business'] = DB::table('user_package')
                                                ->where('user_id', $max_key)
                                                ->where('status', 'approved')
                                                ->sum('amount');
                // $data['power_business'] -= $data['power_self_business'];
                
            $team = $mlm->getDownlineUsers($max_key);
          
             $data['team_member_count'] = count($team);
               
            foreach($team as $member){
                
                $business = DB::table('user_package')
                        ->where('user_id', $member->id)
                        ->where('status', 'approved')
                        ->sum('amount');
                if($business > 0){
                    // $data['team'][$member->id] = (int) $business;      
                     $data['team'][] = [
                            'user' => $member,
                            'business' => (int) $business
                        ];     
                }
                        
            }
             $data['team_with_business'] = count($data['team']); 
        }
        
        
        return view('user.power_leg_business', compact('data'));
   }
   
   public function weakerLeg(){
       
       
        $mlm = new MLMController;
        $directsBusiness=$mlm->getDirectsTeamBusiness(Auth::user()->id);
        // dd($directsBusiness); 
        $data = array();
        
        $data['team'] = [];
        if(count($directsBusiness) > 0){
                
              $max_key = array_search(max($directsBusiness), $directsBusiness);
              
              
                
            foreach($directsBusiness as $key => $directBusiness){
                if($key == $max_key){
                    continue;
                }
                
                $self_business = DB::table('user_package')
                                    ->where('user_id', $key)
                                    ->where('status', 'approved')
                                    ->sum('amount');
                $team_business = $mlm->getTeamBusiness($key, false);
                
                $data['team'][] = [
                                'user' => DB::table('user')->where('id', $key)->first(),
                                'self_business' => (int) $self_business,
                                'team_business' => (int) $team_business
                          ]; 
         
              
                
            }
                
            
        }
        
        // dd($data);
        return view('user.weaker_leg_business', compact('data'));
       
   }
  
}

