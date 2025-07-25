<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tree_setting;
use Auth;
use DB;
use App\Helpers\Helper;
use App\Http\Controllers\MLMController;
use Storage;
class TreeController extends Controller
{
    

    public function sponser_tree(Request $request){

         $mlm=new MLMController;
          
         $direct_this_id=NULL;
         $direct_upline_userids=NULL;
         if(isset($request->user_id)){
             
              $main_user=DB::table('user')->where('id',$request->user_id)->first();
              $direct_this_id=$request->user_id;
             $mlm->upline($main_user);
              $direct_upline=$mlm->getUpline(); 
              
              $direct_upline_userids=array();
              foreach($direct_upline as $du){
                  
                   if(Auth::user()->id==$du->id){
                       $push="<a href='?'>$du->userid</a>";
                   }else{
                   $push="<a href='?user_id=$du->id'>$du->userid</a>";
                   
                   }
                   array_push($direct_upline_userids,$push);
                   if(Auth::user()->id==$du->id){
                       break;
                   }
              }
              
             $direct_upline_userids =array_reverse($direct_upline_userids);
              
         }else{
             
                 $main_user=Auth::user(); 
         }
     
       

        $main_data = [];
        $data = [];
        $id_array = [];
      
        $auth_user=DB::table('user_package')->select('status')->where('user_id',$main_user->id)->first();
        
        
        if(empty($auth_user)){
            
         $icon=" <i class='lni lni-ban' aria-hidden='true' style='background:white;  font-weight:900; color:#9D3145; padding:3px; border-radius:10px; '></i>";
        }else{
        
                if($auth_user->status=='approved'){
                                    
                    $icon=" <i class='lni lni-checkmark-circle' aria-hidden='true' style='background:white; font-weight:900; color:green; padding:3px; border-radius:10px;'  ></i>";
                }else{
                    
                    $icon=" <i class='lni lni-ban' aria-hidden='true' style='background:white;  font-weight:900; color:#9D3145; padding:3px; border-radius:10px; '></i>";
                }
        
        }
        
                     
                         $mlm->recurseUserLevelListAll($main_user);
                       $total_team=count($mlm->getLevelUsersAll());
                        $mlm->makeLevelUsersAllEmpty();
                        
           $total_directs=DB::table('user')->where('referal',$main_user->userid)->count();
                           $path=Storage::url('app/profileupload/').$main_user->image;
                  
                    $img_path="<img src=".$path." height=60 width=60 class=rounded-circle> 
                              <br>Name:<b> ".ucwords($main_user->first_name)." ".ucwords($main_user->last_name)."</b>
                              
                              <br>Total Direct:<b> ".$total_directs."</b>
                              <br>Total Team:<b> ".$total_team."</b>
                              <br>Withdrawl Wallet:<b> ".Helper::get_currency() . $main_user->withdrawl_wallet."</b>";
                              
                   
                    //  echo  $img_path;
                    //   echo "<br>";
                      //  $img_path="<i>test</i>";
           $info="<button   style='background:none;font-weight:900;    border:none;' data-bs-toggle='tooltip'   data-bs-placement='left' data-bs-html='true' data-bs-title='".$img_path."'  class='bx bx-info-circle'> ".ucwords($main_user->first_name)." ".ucwords($main_user->last_name)." </button>  ";

                        


        $data['id'] = $main_user->userid;  
        $data['contents'] = $info;
        $data['head'] =$main_user->userid.$icon;
        $data['parent'] = 0;

        array_push($main_data, $data);
        array_push($id_array,$main_user->userid);


   

        $k = $j = 1;
        for($i=0; $i<count($id_array); $i++) {


//             echo "<pre>";
// print_r($id_array);
// echo "</pre>";
 
  
            $parent =DB::table('user')->select('id','userid')->where('userid',$id_array[$i])->first();
            $result=DB::table('user')->select('user.id','user.image','user.email','user.withdrawl_wallet','user.saving_wallet','user.first_name','user.last_name','user.userid','user_package.status')->leftJoin('user_package','user.id', '=', 'user_package.user_id')->where('user.referal',$id_array[$i])->get();
   
          

            if(count($result) > 0) {
                

                    foreach($result as $row){

                  
                        
                        if($row->status=='approved'){
                            
                            $icon=" <i class='lni lni-checkmark-circle' aria-hidden='true' style='background:white; font-weight:900; color:green; padding:3px; border-radius:10px;'  ></i>";
                        }else{
                            
                            $icon=" <i class='lni lni-ban' aria-hidden='true' style='background:white;  font-weight:900; color:#9D3145; padding:3px; border-radius:10px; '></i>";
                        }
              
                       
                        $mlm->recurseUserLevelListAll($row);
                       $total_team=count($mlm->getLevelUsersAll());
                        $mlm->makeLevelUsersAllEmpty();
                        

                      $total_directs=DB::table('user')->where('referal',$row->userid)->count();
                           
                           $path=Storage::url('app/profileupload/').$row->image;
                  
                    $img_path="<img src=".$path." height=60 width=60 class=rounded-circle> 
                              <br>Name:<b> ".ucwords($row->first_name)." ".ucwords($row->last_name)."</b>
                              
                              <br>Total Direct:<b> ".$total_directs."</b>
                              <br>Total Team:<b> ".$total_team."</b>
                              <br>Withdrawl Wallet:<b> ".Helper::get_currency() . $row->withdrawl_wallet."</b>";
                              
                   
                    //  echo  $img_path;
                    //   echo "<br>";
                      //  $img_path="<i>test</i>";
                        $info="<button   style='background:none;font-weight:900;    border:none;' data-bs-toggle='tooltip'   data-bs-placement='left' data-bs-html='true' data-bs-title='".$img_path."'  class='bx bx-info-circle'> ".ucwords($row->first_name)." ".ucwords($row->last_name)." </button>  ";

                        


                        $data['id']=$row->userid;
                        $data['contents'] = $info;
                        $data['head'] = ucwords($row->userid).$icon;
                        $data['parent'] = $parent->userid;
                        $promocode = $row->userid;
            
                        array_push($main_data, $data);
                        if(!empty($promocode)) {
                            array_push($id_array,$promocode);
                        }
                        $k=$k+1;

                    }
                

            }
        }



// die;

// echo "<pre>";
// print_r($main_data);
// echo "</pre>";
 
 
// die;
                      
$new = array();
foreach ($main_data as $a){
$new[$a['parent']][] = $a;
}
$tree = $this->createTree($new, array($main_data[0]));

// echo "<pre>";
// print_r($tree);
// echo "</pre>";
 
// die;            
$final_tree=json_encode($tree,JSON_PRETTY_PRINT);        

$tree_setting=tree_setting::first();

$send_data=compact('final_tree','tree_setting','direct_this_id','direct_upline_userids');



return view('user.sponser-tree')->with($send_data);

    }




    function createTree(&$list, $parent){
        $tree = array();
        foreach ($parent as $k=>$l){
          if(isset($list[$l['id']])){
              $l['children'] =$this->createTree($list, $list[$l['id']]);
          }
          $tree[] = $l;
        } 
        return $tree;
    }     

}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   