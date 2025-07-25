<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class BtreeController extends Controller
{
    public $countLeft = 0;
    public $countRight = 0;
    public $leftUsers = array();
    public $rightUsers = array();
    public $isRightSide = false;
    public $isRightSide2 = false;
    public $tempUser;
    public $levellist = array();
    public $uplinelist = array();
    public $star_users_new = array();
    public $i;
    public $sequence_array=array();
 
   public $key=0;
   public $max_left_level=0;
   public $max_right_level=0;
     public $star_user_send=false;
    function findPlaceNew($star_parent, $side = '', $joining_user, $user_package)
    {
        $temp_parent = $star_parent;
        // dd($temp_parent);
        if ($side == "left") {

            if ($temp_parent != NULL) {

                if ($temp_parent->left_user > 0) {
                    // echo "parent has left user";
                    $left_user_id = $temp_parent->left_user;
                    $temp_parent=DB::table('autopool_user')->where('userid',$left_user_id)->first();
                   // $temp_parent = $conn->query("select * from star_user where userid=" . $left_user_id)->fetch_assoc();
                    $this->findPlaceNew($temp_parent, $side, $joining_user, $user_package);
                } else {
                    //  echo "parent has no left user";

                   $data=array();
                   $update_data=array();
                   $data['userid']=$joining_user->id;
                   $data['package_id']=1;
                   DB::table('autopool_user')->insert($data);
                   $update_data['left_user']=$joining_user->id;
                   $id=$temp_parent->id;
                   DB::table('autopool_user')->where('id' , $id)->update($update_data);
                   DB::table('user')->where('id' , $joining_user->id)->update(['position'=>$side]);
    // $sql = "insert into star_user(userid,package_id,left_user,right_user,left_count,right_count,matching_count,is_active) values(" . $joining_user["id"] . "," . $user_package["package_id"] . ",'0','0','0','0','0','0'); ";
    //                 $conn->query($sql);
                    // $sql = "update star_user set left_user=" . $joining_user["id"] . " where id=" . $temp_parent["id"];
                    // $conn->query($sql);
                }
            } else {
                // echo "In outer else blanck";
                // $sql = "insert into star_user(userid,package_id,left_user,right_user,left_count,right_count,matching_count,is_active) values(" . $joining_user["id"] . "," . $user_package["package_id"] . ",'0','0','0','0','0','0'); ";
                // $conn->query($sql);
                $data=array();
                $data['userid']=$joining_user->id;
                $data['package_id']=1;
                DB::table('autopool_user')->insert($data);
            }
            echo "In outer "  ;
        } elseif ($side == "right") {
            if ($temp_parent != NULL) {
                if ($temp_parent->right_user > 0) {
                    echo "parent has right user";
                    $right_user_id = $temp_parent->right_user;

                    $temp_parent=DB::table('autopool_user')->where('userid',$right_user_id)->first();
                    //$temp_parent = $conn->query("select * from star_user where userid=" . $right_user_id)->fetch_assoc();
                    $this->findPlaceNew($temp_parent, $side, $joining_user, $user_package);
                    
                } else {

                    $data=array();
                    $update_data=array();
                    $data['userid']=$joining_user->id;
                    $data['package_id']=1;
                    DB::table('autopool_user')->insert($data);
                    $update_data['right_user']=$joining_user->id;
                    $id=$temp_parent->id;
                    DB::table('autopool_user')->where('id' , $id)->update($update_data);
                    DB::table('user')->where('id' , $joining_user->id)->update(['position'=>$side]);

                    // echo "parent has no right user";
                    // $sql = "insert into star_user(userid,package_id,left_user,right_user,left_count,right_count,matching_count,is_active) values(" . $joining_user["id"] . "," . $user_package["package_id"] . ",'0','0','0','0','0','0'); ";
                    // $conn->query($sql);
                    // $sql = "update star_user set right_user=" . $joining_user["id"] . " where id=" . $temp_parent["id"];
                    // $conn->query($sql);
                }
            } else {
                echo "In outer else blanck";


                $data=array();
              
                $data['userid']=$joining_user->id;
                $data['package_id']=1;
                DB::table('autopool_user')->insert($data);
                // $sql = "insert into star_user(userid,package_id,left_user,right_user,left_count,right_count,matching_count,is_active) values(" . $joining_user["id"] . "," . $user_package["package_id"] . ",'0','0','0','0','0','0'); ";

                // $conn->query($sql);
            }
            echo "In outer "  ;
        }
    }

















    function getLeftRightUsers($temp_parent, $user, $debug = false)
    {
        echo $debug ? "<br>checking iteration:" . $temp_parent->left_user . "----" . $temp_parent->right_user . "<br>" : "";
        
        if ($temp_parent->left_user > 0) {
            if ($this->isRightSide2 === true) {
                // echo $temp_parent["right_user"]."-- 1 if";
                array_push($this->rightUsers, $temp_parent->left_user);
              
            } else {
            
                array_push($this->leftUsers, $temp_parent->left_user);
            }
            // $this->countLeft++;
            $left_user_id = $temp_parent->left_user;
            // echo $debug ? "<br>Counted Left ID---" . $conn->query("select * from user where id=" . $left_user_id)->fetch_assoc()["userid"] . "<br>" : "";
            $temp_parent1=DB::table('autopool_user')->where('userid',$left_user_id)->first();
           
           // $temp_parent1 = $conn->query("select * from star_user where userid=" . $left_user_id)->fetch_assoc();
            $this->getLeftRightUsers($temp_parent1, $user);
        }
        if ($temp_parent->right_user > 0) {
            echo $debug ? $temp_parent->id . "==" . $user->id : "";
            if ($temp_parent->id == $user->id) {
                echo $debug ? "making true" : "";

                $this->isRightSide2 = true;
            }
            if ($this->isRightSide2 === true) {

                array_push($this->rightUsers, $temp_parent->right_user);
            } else {
                array_push($this->leftUsers, $temp_parent->right_user);
            }
            $right_user_id = $temp_parent->right_user;
            //echo $debug ? "<br>Counted Right ID---" . $conn->query("select * from user where id=" . $right_user_id)->fetch_assoc()["userid"] . "<br>" : "";
            $temp_parent2=DB::table('autopool_user')->where('userid',$right_user_id)->first();
            //$temp_parent2 = $conn->query("select * from star_user where userid=" . $right_user_id)->fetch_assoc();
            $this->getLeftRightUsers($temp_parent2, $user);
        }

        return array("left" => $this->leftUsers, "right" => $this->rightUsers);
    }













function findPlaceDirectNew($conn,$direct_star_parent,$joining_user,$direct_user){
    //parameter info
               // $direct_star_parent ----> is the row data of direct star user table  where user_id and direct_user is equal
               
               //  joining_user ----> is  joining_user_id
                //  direct_user ----> is  direct_user_id
    
     //parameter info end 
     
     
    if($direct_star_parent['left_user']==0){
        
      
        
        //"UPDATE `direct_star_user` SET  `left_user`='$joining_user'  WHERE id='".$direct_star_parent['id']."'";
        
        $conn->query("UPDATE `direct_star_user` SET  `left_user`='$joining_user'  WHERE id='".$direct_star_parent['id']."'");
        
       $conn->query("INSERT INTO `direct_star_user`(`user_id`, `left_user`, `right_user`,`direct_user`) VALUES ('".$joining_user."','0','0','".$direct_user."')");
       return true;
       
        
    }elseif($direct_star_parent['right_user']==0){
        
       $conn->query("UPDATE `direct_star_user` SET  `right_user`='$joining_user'  WHERE id='".$direct_star_parent['id']."'");
          
    $conn->query("INSERT INTO `direct_star_user`(`user_id`, `left_user`, `right_user`,`direct_user`) VALUES ('".$joining_user."','0','0','".$direct_user."')");
      return true;
    
    }else{
        
            array_push($this->sequence_array,$direct_star_parent['left_user']);
            array_push($this->sequence_array,$direct_star_parent['right_user']);
         
        
        
        
          $direct_star_parent1=$conn->query("select * from direct_star_user where user_id='".$this->sequence_array[$this->key]."' and direct_user='$direct_user' ")->fetch_assoc();
          $this->key++;
          $this->findPlaceDirectNew($conn,$direct_star_parent1,$joining_user,$direct_user);
        
    }
    
    
    return true;
    
    
}

     function countUser($temp_parent, $user, $debug = false)
    {

        echo $debug ? "<br>checking iteration:" . $temp_parent->left_user . "----" . $temp_parent->right_user . "<br>" : "";
        
        if ($temp_parent->left_user > 0) {
            // $this->countLeft++;
            if ($this->isRightSide === true) {
                $this->countRight++;
                echo $debug ? "<br>in true" : "";
            } else {
                $this->countLeft++;
                echo $debug ? "<br>in false" : "";
            }
            $left_user_id = $temp_parent->left_user;
          //  echo $debug ? "<br> l: " . $this->countLeft . " r: " . $this->countRight . " Counted Left ID---" . $conn->query("select * from user where id=" . $left_user_id)->fetch_assoc()["userid"] . "<br>" : "";
          $temp_parent1=   DB::table('autopool_user')->where('userid',$left_user_id)->first();
          //$temp_parent1 = $conn->query("select * from star_user where userid=" . $left_user_id)->fetch_assoc();
            $this->countUser($temp_parent1, $user);
        }
        if ($temp_parent->right_user > 0) {
            echo $debug ? "right check " . $temp_parent->id . "==" . $user->id : "";
            if ($temp_parent->id == $user->id) {
                echo $debug ? "making true" : "";
                $this->isRightSide = true;
            }

            if ($this->isRightSide === true) {
                $this->countRight++;
                echo $debug ? "<br>in true" : "";
            } else {
                $this->countLeft++;
                echo $debug ? "<br>in false" : "";
            }
            $right_user_id = $temp_parent->right_user;
           // echo $debug ? "<br>l: " . $this->countLeft . " r: " . $this->countRight . "Counted Right ID---" . $conn->query("select * from user where id=" . $right_user_id)->fetch_assoc()["userid"] . "<br>" : "";
            
           $temp_parent2=   DB::table('autopool_user')->where('userid',$right_user_id)->first();

          //  $temp_parent2 = $conn->query("select * from star_user where userid=" . $right_user_id)->fetch_assoc();
            $this->countUser($temp_parent2, $user);
        }

        return array("left" => $this->countLeft, "right" => $this->countRight);
    }

   
    function findLevels($conn, $star_users_array, $numberOfLevels)
    {
        $this->star_users_new = array();

        $this->i++;
        foreach ($star_users_array as $value) {
            if ($value["left_user"] > 0) {
                $star_users = $conn->query("select * from autopool_user where userid=" . $value["left_user"]);
                if ($star_users->num_rows > 0) {
                    array_push($this->star_users_new, $star_users->fetch_assoc());
                }
            }
            if ($value["right_user"] > 0) {
                $star_users = $conn->query("select * from autopool_user where userid=" . $value["right_user"]);
                if ($star_users->num_rows > 0) {
                    array_push($this->star_users_new, $star_users->fetch_assoc());
                }
            }
        }
        array_push($this->levellist, $this->star_users_new);
        if ($this->i < $numberOfLevels) {
            $this->findLevels($conn, $this->star_users_new, $numberOfLevels);
        }
        return $this->levellist;
    }

    function getLeftRightBusiness($array)
    {
        $leftArray = $array["left"];
        $rightArray = $array["right"];
        $totalleft = 0;
        $totalright = 0;
        foreach ($leftArray as $userid) {
$totalleft+=DB::table('package')->join('user_package', 'package.id', '=', 'user_package.package_id')->where('user_package.user_id',$userid)->where('user_package.status','approved')->sum('package.cost');
            //$totalleft += $conn->query("select sum(p.cost) totalleft from package p inner join user_package up on p.id=up.package_id where up.user_id=$userid and status='approved'")->fetch_assoc()["totalleft"];
        }
        foreach ($rightArray as $userid) {

            $totalright+=DB::table('package')->join('user_package', 'package.id', '=', 'user_package.package_id')->where('user_package.user_id',$userid)->where('user_package.status','approved')->sum('package.cost');
   
          //  $totalright += $conn->query("select sum(p.cost) totalright from package p inner join user_package up on p.id=up.package_id where up.user_id=$userid and status='approved'")->fetch_assoc()["totalright"];
        }
        return array("left" => $totalleft, "right" => $totalright);
    }

    function getTodaysLeftRightBusiness($array,$date)
    {
        $leftArray = $array["left"];
        $rightArray = $array["right"];
        $totalleft = 0;
        $totalright = 0;
        foreach ($leftArray as $userid) {

    $totalleft+=DB::table('package')->join('user_package', 'package.id', '=', 'user_package.package_id')->where('user_package.user_id',$userid)->where('user_package.status','approved')->where('user_package.date',$date)->sum('package.cost');

           // $totalleft += $conn->query("select sum(p.cost) totalleft from package p inner join user_package up on p.id=up.package_id where  up.user_id=$userid and activated_date='$date' and status='approved'")->fetch_assoc()["totalleft"];
        }
        foreach ($rightArray as $userid) {
            $totalright+=DB::table('package')->join('user_package', 'package.id', '=', 'user_package.package_id')->where('user_package.user_id',$userid)->where('user_package.status','approved')->where('user_package.date',$date)->sum('package.cost');

          //  $totalright += $conn->query("select sum(p.cost) totalright from package p inner join user_package up on p.id=up.package_id where up.user_id=$userid and activated_date='$date' and status='approved'")->fetch_assoc()["totalright"];
        }
        return array("left" => $totalleft, "right" => $totalright);
    }
    
    
     function getTodaysLeftRightPV($array,$date)
    {
        $leftArray = $array["left"];
        $rightArray = $array["right"];
        $totalleft = 0;
        $totalright = 0;
        foreach ($leftArray as $userid) {
            $totalleft+=DB::table('package')->join('user_package', 'package.id', '=', ' user_package.package_id')->where('user_package.user_id',$userid)->where('status','approved')->where('activated_date',$date)->sum('package.bv');

           // $totalleft += $conn->query("select sum(p.coin) totalleft from package p inner join user_package up on p.id=up.package_id where  up.user_id=$userid and activated_date='$date' and up.status='approved'")->fetch_assoc()["totalleft"];
        }
        foreach ($rightArray as $userid) {

            $totalright+=DB::table('package')->join('user_package', 'package.id', '=', ' user_package.package_id')->where('user_package.user_id',$userid)->where('status','approved')->where('activated_date',$date)->sum('package.bv');

           // $totalright += $conn->query("select sum(p.coin) totalright from package p inner join user_package up on p.id=up.package_id where up.user_id=$userid and activated_date='$date' and up.status='approved'")->fetch_assoc()["totalright"];
        }
        return array("left" => $totalleft, "right" => $totalright);
    }
    
    
    
    function setStarUserApproved()
    {
        $ups = DB::table('user_package')->where('status','approved')->get();
      //  $ups = $conn->query("select * from user_package where status='approved'");
      foreach($ups as $up){
            DB::table('autopool_user')->where('userid',$up->user_id)->update(array('is_active'=>1));
      }
         
    }
      function sponserIncomeTranseferToWithdrawl($conn)
    {
        $income_history = $conn->query("select * from income_history where type='direct'");
        while ($income = $income_history->fetch_assoc()) {
            $amount=$income["amount"];
            $received_user=$income["received_user"];
            $sql = "update user set withdrawl_wallet=withdrawl_wallet+$amount where id=" . $received_user;
            echo "<br>".$sql;
            $conn->query($sql);
        }
    }
    
    
     function execStarUpline($user_id){
         
$data=DB::table('autopool_user')->select('autopool_user.*','user.id','user.first_name','user.last_name','user.userid as key')->join('user','autopool_user.userid','=','user.id')->where('autopool_user.left_user',$user_id)->orWhere('autopool_user.right_user',$user_id)->first();
     
          if(!empty($data)){
              
               array_push($this->uplinelist,$data);
               $this->execStarUpline($data->userid);
              
          }
         
         
     }
     
     
     function getStarUpline(){
         return $this->uplinelist;
     }
    
    
    
    public function getMaxNumberOfLevels($user_id,$star_user_send){
        
        
             
              $star_user=DB::table('autopool_user')->where('userid',$user_id)->first();  
              
                if($star_user->left_user>0){
                 
                     if($this->star_user_send){
                         
                          $this->max_right_level++;
                     }else{
                     $this->max_left_level++;
                     
                     }
                     $this->getMaxNumberOfLevels($star_user->left_user,$star_user_send);
                 
                }
                
                if($star_user_send->right_user==$star_user->right_user){
                    
                    $this->star_user_send=true;
                     if($star_user->right_user>0){
                         $this->max_right_level++;
                     }
                    
                }
                     
                if($star_user->right_user>0){
                          
                     
                     if($star_user->left_user==0){
                           if($this->star_user_send){
                         
                          $this->max_right_level++;
                     }else{
                     $this->max_left_level++;
                     
                     }
                     
                     }
                          $this->getMaxNumberOfLevels($star_user->right_user,$star_user_send);
                     
                }
         
         
         
         
                  
         return     array('left_max_level'=>$this->max_left_level,'right_max_level'=>$this->max_right_level);
         
     }
     
     
   
    
  
    
    
    
    
    
}








