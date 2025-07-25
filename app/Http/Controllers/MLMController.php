<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class MLMController extends Controller
{


    private $array = array();
    private $arrayAutoPool = array();
    private $leveleList = array();
    private $leveleListAll=array();
    public $levelCount=0;
    public $level_count=0;
    private $autopool_ids=0;
     
    public $prev_level_users=array();
     
    public  function upline($user)
    {
        if (!empty($user->referal) and $user->role=='user') {
          
            $user=DB::table('user')->selectRaw("user.*,IFNULL(user_package.status,'pending' ) as status")->leftJoin('user_package','user.id', '=', 'user_package.user_id')->where('user.userid',$user->referal)->where('user.role','user')->first();
          
                
                    if($user){
                    array_push($this->array, $user);
                    }
                $this->upline($user);
        }
        return $this->array;

    }

    
    public  function getUpline(){

        return $this->array;


    }
    public  function upline2($user)
    {
        if (!empty($user->referal) and $user->role=='user') {
          
            $user=DB::table('user')->selectRaw("user.*,IFNULL(user_package.status,'pending' ) as status")->leftJoin('user_package','user.id', '=', 'user_package.user_id')->where('user.userid',$user->referal)->where('user.role','user')->first();
          
                
                    if($user){
                    array_push($this->array, $user);
                    }
                    $total_levels=DB::table("levels")->count();
                    if(count($this->array)<=$total_levels){
                         $this->upline2($user);
                    }
                    
               
        }
        return $this->array;

    }

    function CurrentInvestAmount($user_id){
        $user_package=DB::table("user_package")->where("user_id",$user_id)->where("status","approved")->get();
        $total_amount=0;
        foreach($user_package as $ups){
            $date20month=date("Y-m-d",strtotime("+20 month", strtotime($ups->created_at)));
            if(date("Y-m-d")<=$date20month){
                $total_amount+=$ups->amount;
            }
        }
        return $total_amount;
    }
    
    public  function getUpline2(){

        return $this->array;


    }
    //
    public  function direct($user)
    {
        if (!empty($user->userid) and $user->role=='user') {
              $user2=DB::table('user')->where('referal',$user->userid)->get();
              foreach($user2 as $users){
                  $user_package=DB::table('user_package')->where("user_id",$users->id)->where("status","approved")->count();
                  if($user_package>0){
                   array_push($this->array, $users);
                  }
              }
        }
        return $this->array;

    }

    
    public  function getdirect(){
        return $this->array;
    }
    public function getActiveDirect($user){
        $total_direct=0;
        if (!empty($user->userid) and $user->role=='user') {
              $user2=DB::table('user')->where('referal',$user->userid)->get();
              foreach($user2 as $users){
                  $user_package=DB::table('user_package')->where("user_id",$users->id)->where("status","approved")->where('active_status',1)->count();
                  if($user_package>0){
                   $total_direct++;
                  }
              }
        }
        return $total_direct;
    }
    public  function PowerWeekLeg($user)
    {
        if (!empty($user->userid) and $user->role=='user') {
              $user2=DB::table('user')->where('referal',$user->userid)->get();
              foreach($user2 as $users){
                  $user_package=DB::table('user_package')->where("user_id",$users->id)->where("status","approved")->count();
                  if($user_package>0){
                   array_push($this->array, $users);
                  }
              }
        }
        return $this->array;

    }
    
    /* ----------- start code of shubham kumar ----------- */
     private $allDownlineUser = array();
     public function getDownlineUsers($userid): array
    {
        $this->allDownlineUser = [];
        $this->downlineTraverser(DB::table('user')->where('id', $userid)->where('role', 'user')->first());
        return $this->allDownlineUser;
    }
    
    public function getActiveDownlineUsers($userid){
        $this->allDownlineUser = [];
        $this->activeDownlineTraverser(DB::table('user')->where('id', $userid)->where('role', 'user')->first());
        return $this->allDownlineUser;
    }
    public function activeDownlineTraverser($user){
        $children = DB::table('user')->join('user_package', 'user.id', '=', 'user_package.user_id')->where('referal', $user->userid)->where('user_package.status', 'approved')->where('role', 'user')->select('user.*')->get();
     
        foreach($children as $child){
            array_push($this->allDownlineUser, $child);
            $this->activeDownlineTraverser($child);
        }
        return;
    }
    
    public function downlineTraverser($user){
        $children = DB::table('user')->where('referal', $user->userid)->where('role', 'user')->get();
    
        foreach($children as $child){
            array_push($this->allDownlineUser, $child);
            $this->downlineTraverser($child);
        }
        return;
    }
    
    public function getLegBusiness($user_tbl){
        $user = DB::table('user')->where('id', $user_tbl)->first();
        
        $directs = DB::table('user')->where('referal', $user->userid)->get();
        $response = [];
        $directsTotalBusiness = array();
                
        foreach($directs as $direct){
           
                $directBusiness = $this->getTeamBusiness($direct->id, true);
                $directsTotalBusiness[$direct->id] = $directBusiness;

        }
        $self = DB::table('user_package')->where("user_id",$user_tbl)->where("status","approved")->sum("amount");
       
        $powerleg = 0;
        if(count($directsTotalBusiness) > 0){
           $powerleg += max($directsTotalBusiness) ;
            
        }
        $total = array_sum($directsTotalBusiness);
        $weakleg = $total - ($powerleg);
        
        $response['power_leg']=$powerleg;
       $response['week_leg']=$weakleg;
       $response['total_business']=$total;
       
       return $response;
        
    }
    public function getDirectsTeamBusiness($user_tbl){
        
        $user = DB::table('user')->where('id', $user_tbl)->first();
        
        $directs = DB::table('user')->where('referal', $user->userid)->get();
        $directsTotalBusiness = array();
        
            foreach($directs as $direct){
                
                if(DB::table('user_package')->where('user_id', $direct->id)->where('status', 'approved')->exists()){
                    $directBusiness = $this->getTeamBusiness($direct->id, false);
                    
                    $directsTotalBusiness[$direct->id] = $directBusiness;
                }
            }
        
        return $directsTotalBusiness;
    }
    
    
    public function getTeamBusiness($userId, $includeSelf = false) {
        $total = 0;
    
        $downlineUsers = $this->getDownlineUsers($userId); 
        
        $userIds = array_column($downlineUsers, 'id');  
        if ($includeSelf) {
            $userIds[] = $userId;
        }
     
        $total = DB::table('user_package')
                ->whereIn('user_id', $userIds)
                ->where('status', 'approved')
                ->sum('amount');
    
        return (int) $total;
    }

     public function getDownlineTree($user)
    {
        $downlineTree = [];

        $children = DB::table('user')->where('referal', $user->userid)->get();

        foreach ($children as $child) {
            $downlineTree[] = [
                'user' => $child,
                'downline' => $this->getDownlineTree($child)
            ];
        }

        return $downlineTree;
    }

    
    
     /* ----------- end code of shubham kumar ----------- */
    public function GetPowerWeekLeg(){
             $data=[];
             $responce=[];
             $i=1;
              foreach($this->array as $getdirects){
                $mlm=new MLMController();
                $user_tbl2=DB::table("user")->where("id",$getdirects->id)->get();
                $mlm->downline($user_tbl2,false,false);
                $getDownline=$mlm->getDownline();
                // $getDownline=$this->getDownlineUsers(\Auth::user()->id);
                
               
                $business= $this->powerweekbusiness($getDownline,$getdirects->id,true);

                array_push($data, $business["total_business"]);
                 
                $i++;  
              }
          
              $total_business=0;
              foreach($data as $data2){
                  $total_business+=$data2;
              }
             if(!empty($data)){
                   $max_value=max(array_values($data));
                    $min_value=min(array_values($data));
             }else{
                $max_value=0;
                $min_value=0;
             }
            
               $responce['power_leg']=$max_value;
               $responce['week_leg']=$total_business-$max_value;
               $responce['total_business']=$total_business;
              
              return $responce;
    }
    
    public  function powerweekbusiness($user,$self_id,$status=false)
    {
     // dd($user);
        $data=[];
        $total_amount=0;
        $self_amount=0;
        if($status==true){
           $self_amount=DB::table('user_package')->where("user_id",$self_id)->where("status","approved")->sum("amount");
        }
        if(!empty($user)){
              foreach($user as $users){
                  foreach($users as $users2){
                    //   echo $self_id."Sanchit".$users2->id."<br>";
                     $total_amount+=DB::table('user_package')->where("user_id",$users2->id)->where("status","approved")->sum("amount");
                  }
              }
        }else{
              
        }
        $all_total=$total_amount+$self_amount;
        $data['business']=$total_amount;
        $data['self_business']=$self_amount;
        $data['total_business']=$all_total;
        $data['direct_user']=$self_id;
        return array("business" => $total_amount,"self_business"=>$self_amount,"total_business"=>$all_total,"user_id"=>$self_id);

    }
  function downline($temp,$active=true,$first_time=false){
         
         if($first_time==true){
             
             
             $temp=array($temp);
         }
         
   
           
            if(count($temp)>0){
                
                $this->prev_level_users=array();
            foreach($temp as $user) {
                
                
                 if($active==true){
                    
      //  $sql="select u.* from user as u inner join user_package as up on u.id=up.user_id where up.status='approved' and u.referal='".$user["userid"]."'  group by up.user_id   ";
            $users=DB::table('user')->join('user_package','user.id', '=', 'user_package.user_id')->where('user_package.status','approved')->where('user.referal',$user->userid)->groupBy('user_package.user_id')->get();
    
    }else{

        $users=DB::table('user')->where('referal',$user->userid)->get();
                    // $sql="select * from user where referal='".$user['userid']."' ";


                 }
                 
                 
                
                 
                  if(count($users)>0){
                            foreach($users as $user){
                         
                              array_push($this->prev_level_users,$user);
                             
                         }
                  }
                         
                        
                 
            }
            
            
            if(count($this->prev_level_users)>0){
              array_push($this->leveleList,$this->prev_level_users);
            }
              $this->downline($this->prev_level_users,$active);
              
            }
        }
 
 
        
       function makeDownlineEmpty(){
         $this->leveleList=array();
    }
    
    
    
    function getDownline(){
        return $this->leveleList;
    }
    
    
      function recurseUserLevelListAll($user,$isactive='inactive'){

        $temp=array();
 
       // $sql="select u.*,max(up.package_id) from user as u inner join user_package as up on u.id=up.user_id where up.status='approved' and u.referal='".$user["userid"]."'  GROUP BY up.user_id";
       if($isactive=='active'){
        $users=DB::table('user')->selectRaw('user.*,max(user_package.user_id)')->join('user_package','user.id','=','user_package.user_id')->where('user_package.status','approved')->where('user.referal',$user->userid)->groupBy('user_package.user_id')->get();
       }else{
          $users=DB::table('user')->where('referal',$user->userid)->get();
         
       }
        
       foreach($users as $u){
        array_push($temp,$u);
             
        array_push($this->leveleListAll,$u);
       }
        
     
        if(count($temp)>0){
           
            foreach($temp as $user) {
                $this->recurseUserLevelListAll($user,$isactive);
            }
        }
 
    }
    
    
    
           function makeLevelUsersAllEmpty(){
         $this->leveleListAll=array();
    }
    
    function getLevelUsersAll(){
        return $this->leveleListAll;
    }
    
    
    
    
    
    
    function recurseUserReferaCheckForAutopool($autopool_user,$table="autopool_user")
    {
        if (!empty($autopool_user->userid)) {
            $autopool_user=   DB::table($table)->where('right_user',$autopool_user->userid)->orWhere('left_user',$autopool_user->userid)->first();
            //$autopool_users = $conn->query("select * from $table where right_user=".$autopool_user['id']." or left_user=".$autopool_user['id'] );
            if($autopool_user!=null)
            {
                echo "<br>recurseUserReferaCheckForAutopool Autopool user id: ".$autopool_user->userid;
                array_push($this->arrayAutoPool, $autopool_user);
                $this->levelCount+=1;
                $this->recurseUserReferaCheckForAutopool($autopool_user,$table);
            }
        }else{
            echo "recurseUserReferaCheckForAutopool is empty";
        }
        
    }
    
    function getAutoPoolUserList(){
        return $this->arrayAutoPool;
    }
    
 function recurseUserReferaCheckForAutopool2($autopool_user,$table)
    {
        if ($autopool_user->right_user>0 && $this->levelCount<=10) {
            $autopool_user=   DB::table($table)->where('right_user',$autopool_user->right_user)->first();
          //  $autopool_users = $conn->query("select * from $table where right_user=".$autopool_user['right_user']);
          if($autopool_user!=null)
            {
                 
                array_push($this->arrayAutoPool, $autopool_user);
                $this->levelCount+=1;
                $this->recurseUserReferaCheckForAutopool2($autopool_user,$table);
            }
        }
    }

function countAutopoolCompleteTeam($autopool_user,$table){
     
     
 
    if($autopool_user->right_user!=0){
    
        $autopool_user=  DB::table($table)->where('userid',$autopool_user->right_user)->first() ;
     
        $this->level_count++;
        $this->countAutopoolCompleteTeam($autopool_user,$table);
    }
    
}


public function getAutopoolCompleteTeam(){
    
    return $this->level_count;
    
}





public function count_autopool_ids($autopool_user,$table){
     
   
  
    if($autopool_user->left_user!=0){
          $this->autopool_ids++;
           
        $left_user=  DB::table($table)->where('userid',$autopool_user->left_user)->first() ;
     
     $this->count_autopool_ids($left_user,$table);
       
    }
    
    

    if($autopool_user->right_user!=0){
          $this->autopool_ids++;
           
        $right_user=  DB::table($table)->where('userid',$autopool_user->right_user)->first() ;
     
     $this->count_autopool_ids($right_user,$table);
       
    }
     
}






public function get_autopool_ids(){
    
    return $this->autopool_ids;
    
}


 







function autopool_placement($user){
    echo "<br>";
    echo "executed";
     echo "<br>";
   
    $id=$user->id;
     $data=array('userid'=>$id);

   
    
   DB::table('autopool_user')->insert($data);

    $last_save_id=DB::getPdo()->lastInsertId();
     
   
   
   $autopool_user=DB::table('autopool_user')->find($last_save_id);
   
   
    
 
  
    if(DB::table('autopool_user')->count()>1){
    
    
    $this->addAutoPoolUser($autopool_user,'autopool_user');
             
                 
    }       
          
            
     
    
}

function addAutoPoolUser($user,$table){

    $autopool_users=DB::table($table)->whereRaw('(select max(id) from '.$table.')>id')->get();
    
   
    if(count($autopool_users)>0){
        foreach($autopool_users as $autopool_user){
   
        if($autopool_user->left_user==0){

           DB::table($table)->where('id',$autopool_user->id)->update(array('left_user'=>$user->userid));
            
            break;
        }else if($autopool_user->right_user==0){


            DB::table($table)->where('id',$autopool_user->id)->update(array('right_user'=>$user->userid));
          
            
             break;
        }
    
   }
    
    
  }
}


function calculateLogic($user,$purchased_package,$table)
{
    $i = 0;
    // $calc = new calc();
    $this->recurseUserReferaCheckForAutopool($user,$table);
    $array = $this->getAutoPoolUserList();
 

    $autopools_levels=DB::table('autopool')->get();
   // $autopools_level = $db->select("autopool");
   $package=DB::table('package')->where('id',$purchased_package->package_id)->first();
  //  $package=$conn->query("select * from package where id=".$purchased_package["package_id"])->fetch_assoc();
    $cost=$package->cost;
  
    $autolevel_column_name=strtolower($package->name."_percent_data");
        // echo "<br>";
        // var_dump($array);
        // echo "<br>";
        foreach($autopool_level as $autopools_levels){
    // while ($autopool_level = $autopools_level->fetch_assoc()) {
        $this->level_count=0;
        if (isset($array[$i])) {
            $team_count_required=$autopool_level->team_count;
            $calc->countIds($array[$i],$table);
            $level_count_=$this->level_count;
            // echo "<br>level ".$autopool_level["level"]." == $level_count_<br>";
            if($level_count_==$autopool_level->level){
                     $money = $autopool_level->$autolevel_column_name;
                   //$money = $autopool_level["$autolevel_column_name"];
                   $saving = $money;
                   $data['level_id']=$autopool_level->id;
                   $data['package_id']=$purchased_package->package_id;
                   $data['user_id']=$array[$i]->userid;
                   $data['autopool_user_id']=$array[$i]->id;
                   $data['amount']=$saving;
                   $data['status']="pending";

              DB::table('autopool_income')->insert($data);
                //    $sql="insert into autopool_income(level_id,package_id,user_id,autopool_user_id,amount,status) values(".$autopool_level["id"].",".$purchased_package["package_id"].",".$array[$i]["userid"].",".$array[$i]["id"].",".$saving.",'pending')";
                //    $conn->query($sql);
                //    $autopool_wallet = $saving + $array[$i]["wallet"];
                //    $db->update(array("wallet"=>$autopool_wallet), "$table", $array[$i]["id"]);
                   
        }
                else{
                    // echo "<br>Team count= ";
                }
       }
      
        
        $i++;
        // echo "<br>-----------------------";
    }
    
// echo "one package level finished ==================================================";
}


    public function getTeamBusinessBetween($userId,$from,$to, $includeSelf = false) {
        $total = 0;
    
        $downlineUsers = $this->getDownlineUsers($userId); 
        
        $userIds = array_column($downlineUsers, 'id');  
        if ($includeSelf) {
            $userIds[] = $userId;
        }
     
        $total = DB::table('user_package')
                ->whereIn('user_id', $userIds)
                ->whereBetween('created_at', [$from, $to])
                ->where('status', 'approved')
                ->sum('amount');
    
        return (int) $total;
    }
 




}
