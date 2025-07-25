<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tree_setting;
use Auth;
use DB;
use App\Helpers\Helper;
use App\Http\Controllers\BtreeController;
use Storage;
class BinaryTreeController extends Controller
{
    

    public function binary_tree(Request $request){

         $btree=new BtreeController;
         
           
           $main_user=DB::table('user')->find($request->user_id);
           
           
           
          $star_user=DB::table('autopool_user')->where('userid',$main_user->id)->first();
          if(empty($star_user)){
              
               abort(403,"!Sorry you are not global star user");
              
          }else{
           
           
           
        
        
           
           
         
         
          
         $direct_this_id=NULL;
         $direct_upline_userids=NULL;
       
             
             
             
                if(isset($request->user_id)){
                     $direct_upline_userids=array();
                     $main_user=DB::table('user')->where('id',$request->user_id)->first();
                     
                     
                     $star_user=DB::table('autopool_user')->where('userid',$main_user->id)->first();
                        $left_right = $btree->getLeftRightUsers($star_user, $star_user);  
                      $max_levels=$btree->getMaxNumberOfLevels($main_user->id,$star_user);
                                
                        $btree->execStarUpline($request->user_id);
                     
                        
                      $star_upline=$btree->getStarUpline();
                        
                         
                        
                              foreach($star_upline as $su){
                                                      if($request->user_id==$su->id){
                                           $push="<a href='?'>$su->key</a>";
                                       }else{
                                       $push="<a href='?user_id=$su->id'>$su->key</a>";
                                       
                                       }
                                       array_push($direct_upline_userids,$push);
                                       if($request->user_id==$su->id){
                                           break;
                                       }
                                  
                              }
                   $direct_upline_userids =array_reverse($direct_upline_userids);
                 
                }else{
                    
                     $main_user=DB::table('user')->find($request->user_id);
                       $star_user=DB::table('autopool_user')->where('userid',$main_user->id)->first();
                          $left_right = $btree->getLeftRightUsers($star_user, $star_user);  
                      $max_levels=$btree->getMaxNumberOfLevels($main_user->id,$star_user);
                }
     
           
       

        $main_data = [];
        $data = [];
        $id_array = [];
      
        $auth_user=DB::table('user_package')->select('status')->where('user_id',$main_user->id)->first();
         $main_star_user=DB::table('autopool_user')->where('userid',$main_user->id)->first();
        
        if(empty($auth_user)){
            
         $icon=" <i class='lni lni-ban' aria-hidden='true' style='background:white;  font-weight:900; color:#9D3145; padding:3px; border-radius:10px; '></i>";
        }else{
        
                if($auth_user->status=='approved'){
                                    
                    $icon=" <i class='lni lni-checkmark-circle' aria-hidden='true' style='background:white; font-weight:900; color:green; padding:3px; border-radius:10px;'  ></i>";
                }else{
                    
                    $icon=" <i class='lni lni-ban' aria-hidden='true' style='background:white;  font-weight:900; color:#9D3145; padding:3px; border-radius:10px; '></i>";
                }
        
        }
        
                              $total_team=$btree->countUser($main_star_user,$main_star_user);
                     
                              $path=Storage::url('app/profileupload/').$main_user->image;
                  
                               $img_path="<img src=".$path." height=60 width=60 class=rounded-circle> 
                              <br>Name:<b> ".ucwords($main_user->first_name)." ".ucwords($main_user->last_name)."</b>";
                           
                   
                    //  echo  $img_path;
                    //   echo "<br>";
                      //  $img_path="<i>test</i>";
           $info="<button   style='background:none;font-weight:900;    border:none;' data-bs-toggle='tooltip'   data-bs-placement='left' data-bs-html='true' data-bs-title='".$img_path."'  class='bx bx-info-circle'> ".ucwords($main_user->first_name)." ".ucwords($main_user->last_name)." </button>  ";

                       


        $data['id'] = $main_user->id;  
        $data['contents'] = $info;
        $data['head'] =$main_user->userid;
        $data['parent'] = 0;

        array_push($main_data, $data);
        array_push($id_array,$main_user->id);




        $k = $j = 1;
        for($i=0; $i<count($id_array); $i++) {
            
            $parent =DB::table('user')->select('id','userid')->where('id',$id_array[$i])->first();
            $parent_star_user=DB::table('autopool_user')->where('userid',$id_array[$i])->first();
           
            if($parent_star_user){
                        if($parent_star_user->left_user==0){
                            
                            
                              $data['id']='EMPTY';
                              $data['contents'] = '---';
                              $data['head'] = "<button  style='width:100%;' type='button' class='btn btn-dark'>EMPTY</button>";
                              $data['parent'] = $parent->id;
                         
                               array_push($main_data, $data);
                                
                        }else{
                            
                              
                              $left_user =DB::table('user')->select('id','userid','first_name','last_name','withdrawl_wallet','image')->where('id',$parent_star_user->left_user)->first();
                            
                            
                              $status=DB::table('user_package')->select('status')->where('user_id',$parent_star_user->left_user)->first();
                              
                               $left_star_user=DB::table('autopool_user')->where('userid',$parent_star_user->left_user)->first();
                              $btree=new BtreeController;
                                $total_team=$btree->countUser($left_star_user,$left_star_user);
                              
                              
                                  if(empty($status)){
            
         $icon=" <i class='lni lni-ban' aria-hidden='true' style='background:white;  font-weight:900; color:#9D3145; padding:3px; border-radius:10px; '></i>";
        }else{
        
                if($status->status=='approved'){
                                    
                    $icon=" <i class='lni lni-checkmark-circle' aria-hidden='true' style='background:white; font-weight:900; color:green; padding:3px; border-radius:10px;'  ></i>";
                }else{
                    
                    $icon=" <i class='lni lni-ban' aria-hidden='true' style='background:white;  font-weight:900; color:#9D3145; padding:3px; border-radius:10px; '></i>";
                }
        
        }
        
        
          $path=Storage::url('app/profileupload/').$left_user->image;
                  
                    $img_path="<img src=".$path." height=60 width=60 class=rounded-circle> 
                              <br>Name:<b> ".ucwords($left_user->first_name)." ".ucwords($left_user->last_name)."</b>";
                            
                              
                   
                    //  echo  $img_path;
                    //   echo "<br>";
                      //  $img_path="<i>test</i>";
           $info="<button   style='background:none;font-weight:900;    border:none;' data-bs-toggle='tooltip'   data-bs-placement='left' data-bs-html='true' data-bs-title='".$img_path."'  class='bx bx-info-circle'> ".ucwords($left_user->first_name)." ".ucwords($left_user->last_name)." </button>  ";
        
        
                              
                              
                            
                              $data['id']=$left_user->id;
                              $data['contents'] = $info;
                              $data['head'] = $left_user->userid;
                              $data['parent'] = $parent->id;
                              
                              
                             array_push($main_data, $data);
                                
                            array_push($id_array,$left_user->id);
                               
                               
                            
                            
                        }
                        
                        
                        
                        
                        
                        
                        
                         if($parent_star_user->right_user==0){
                            
                            
                              $data['id']='EMPTY';
                              $data['contents'] = '---';
                              $data['head'] = "<button style='width:100%;' type='button' class='btn btn-dark'>EMPTY</button>";
                              $data['parent'] = $parent->id;
                         
                              array_push($main_data, $data);
                                
                        }else{
                            
                            
                            
                            
                           $right_user =DB::table('user')->select('id','userid','first_name','last_name','withdrawl_wallet','image')->where('id',$parent_star_user->right_user)->first();
                            
                                
                              $status=DB::table('user_package')->select('status')->where('user_id',$parent_star_user->right_user)->first();
                              
                              $right_star_user=DB::table('autopool_user')->where('userid',$parent_star_user->right_user)->first();
                          $btree=new BtreeController;
                                $total_team=$btree->countUser($right_star_user,$right_star_user);
                                  if(empty($status)){
            
         $icon=" <i class='lni lni-ban' aria-hidden='true' style='background:white;  font-weight:900; color:#9D3145; padding:3px; border-radius:10px; '></i>";
        }else{
        
                if($status->status=='approved'){
                                    
                    $icon=" <i class='lni lni-checkmark-circle' aria-hidden='true' style='background:white; font-weight:900; color:green; padding:3px; border-radius:10px;'  ></i>";
                }else{
                    
                    $icon=" <i class='lni lni-ban' aria-hidden='true' style='background:white;  font-weight:900; color:#9D3145; padding:3px; border-radius:10px; '></i>";
                }
        
        }
        
        
        
           $path=Storage::url('app/profileupload/').$right_user->image;
                  
                    $img_path="<img src=".$path." height=60 width=60 class=rounded-circle> 
                              <br>Name:<b> ".ucwords($right_user->first_name)." ".ucwords($right_user->last_name)."</b>
                                <br>Total Left:<b> ".$total_team['left']."</b>
                              <br>Total Right:<b> ".$total_team['right']."</b>
                            
                              <br>Withdrawl Wallet:<b> ".Helper::get_currency() . $right_user->withdrawl_wallet."</b>";
                              
                   
                    //  echo  $img_path;
                    //   echo "<br>";
                      //  $img_path="<i>test</i>";
           $info="<button   style='background:none;font-weight:900;    border:none;' data-bs-toggle='tooltip'   data-bs-placement='left' data-bs-html='true' data-bs-title='".$img_path."'  class='bx bx-info-circle'> ".ucwords($right_user->first_name)." ".ucwords($right_user->last_name)." </button>  ";
        
                              
                              $data['id']=$right_user->id;
                              $data['contents'] = $info;
                              $data['head'] = $right_user->userid;
                              $data['parent'] = $parent->id;
                              array_push($main_data, $data);
                            
                             array_push($id_array,$right_user->id);
                        }
                        
                         
                
            }

     
           
        }


//dd($main_data);
                      
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


 
$send_data=compact('final_tree','tree_setting','direct_this_id','direct_upline_userids','main_star_user','max_levels','left_right');



return view('admin.binary-tree')->with($send_data);

}


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
                                                                                                                                                                                                                                                           