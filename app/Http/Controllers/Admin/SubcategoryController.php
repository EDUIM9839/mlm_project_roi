<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Image;


class SubcategoryController extends Controller
{
   

  


    public function save_subcategory(Request $request){
      
        $request->validate([
           'subcategory_name'=>'required',
           'category_id'=>'required',
           'image'=>'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
           
        ]);
        // dd($request);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('assets/subcategoryImages'), $imageName);

        $data=array(
           'subcategory_name'=>$request->subcategory_name,
           'category_id'=>$request->category_id,
           'created_at'=>date('Y-m-d H:i:s'),
           'updated_at'=>date('Y-m-d H:i:s'),
           'image'=>$imageName
        );
      

        DB::table('subcategories')->insert($data);
        $lastInsertId=DB::getPdo()->lastInsertId();
        if(!empty($lastInsertId)){
                $request->session()->flash('success',"SubCategory has been successfully added."); 
             //return redirect()->back();
            //Session::flash('message', '<p class="alert alert-success" style="text-align:center">SubCategory has been successfully added.</p>');
            return redirect()->route('subcategory-list');
        } 
   } 

    public function getsubcategory(Request $request){
          $id=$request->id;
          $data = DB::table('subcategories')->where('category_id', $id)->get();
          $html="<option>--Select Subcategory--</option>";
          $count=count($data);
          if($count==0){
             $html="<option value=''>No Record Found</option>";  
          }else{
          foreach($data as $row){
                 $sid=$row->id;
                 $sname=$row->subcategory_name;
                 $html.='<option value="'.$sid.'">'.$sname.'</option>';
           }
          }
           
           
           
           echo $html;
    }
  

    public function subcategory_list(){
        $title='SubCategories';
        // $referal='AP002';
        $data = DB::table('subcategories')->select('subcategories.*','categories.category_name')->join('categories', 'subcategories.category_id','=','categories.id',)->get();
        // print_r($data);
        return view('admin.subcategory-list' , compact('title', 'data'));
    } 
    
    public function changeStatus(Request $request){
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
     
     
     public function changeStatuss(Request $request){
        $id=$request->id;
        $table=$request->table;
        $redirectUrl=$request->redirectUrl;
        if($request->stock_transferable_status==0){
            $data['stock_transferable_status']=1;
            $res=DB::table($table)->where('id', $id)->update($data);
            if($res>0){
                 return redirect()->route($redirectUrl);
           }else{
                 return redirect()->route($redirectUrl);
            }
            
        }else{
            $data['stock_transferable_status']=0;
            $res=DB::table($table)->where('id', $id)->update($data);
            if($res>0){
                return redirect()->route($redirectUrl);
                }else{
                  return redirect()->route($redirectUrl);
            }
            
        }
    }






       public function add_subcategory(){
        $title='Add Sub Category';
        $categories = DB::table('categories')->get();
        return view('admin.add-subcategory', compact('title', 'categories'));
    }



    public function edit_subcategory(Request $request){
        $title='Edit Sub Category';
        $id=$request->id;
        $categories = DB::table('categories')->get();
        $categories_all = DB::table('categories')->get();
        $data = DB::table('subcategories')->where('id', $id)->get();
      // dd($data);
        return view('admin.add-subcategory', compact('id', 'title', 'data','categories','categories_all'));
    }

   
    
    public function update_subcategory(Request $request){

        $id=$request->id;

        $request->validate([
            'subcategory_name'=>'required',
            'category_id'=>'required',
         ]);

         if(empty($request->image)){
                
            $data=array(
                'subcategory_name'=>$request->subcategory_name,
                'category_id'=>$request->category_id,
                
                'updated_at'=>date('Y-m-d H:i:s'),
                );
                DB::table('subcategories')->where('id', $id)->update($data);
    $request->session()->flash('success',"SubCategory has been successfully updated."); 
             //return redirect()->back();
                //$request->session()->put('message', '<p class="alert alert-success" style="text-align:center">SubCategory has been successfully updated.</p>');
                return redirect()->route('subcategory-list');
         }else{
            $imageName = time().'.'.$request->image->extension();
            $deletedImage=public_path('assets/subcategoryImages').'/'.$request->oldimage;
            $request->image->move(public_path('assets/subcategoryImages'), $imageName);
            $data=array(

                'subcategory_name'=>$request->subcategory_name,
                'updated_at'=>date('Y-m-d H:i:s'),
                'category_id'=>$request->category_id,
                'image'=>$imageName,

                );
                
                unlink($deletedImage);
                DB::table('subcategories')->where('id', $id)->update($data);
                    $request->session()->flash('success',"SubCategory has been successfully updated."); 
             //return redirect()->back();
                //$request->session()->put('message', '<p class="alert alert-success" style="text-align:center">SubCategory has been successfully updated.</p>');
                return redirect()->route('subcategory-list');
         }
         
    }
 
     

public function delete_subcategory(Request $request){
        $id=$request->id;
        // dd($id);
        $cdata=DB::table('subcategories')->find($id);
        // dd($cdata);
        $cimage=$cdata->image;
        //dd($cimage);
        $deletedImage=public_path('assets/subcategoryImages').'/'.$cimage;
       // dd($deletedImage);
       if(file_exists($deletedImage)){
        unlink($deletedImage);
       }
        DB::table('subcategories')->where('id',$id)->delete();

        $request->session()->flash('success',"SubCategory has been successfully deleted."); 

        // Session::flash('message', '<p class="alert alert-success" style="text-align:center">SubCategory has been successfully deleted.</p>');
        return redirect()->route('subcategory-list');
}
   
   
   
}
