<?php

namespace App\Http\Controllers\SuperAdmin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\level;
use Illuminate\Http\Request;

class IncomeSettingController extends Controller
{ 

        public function direct_income_setting_page(Request $request){
            $par = DB::table('orders')->get();
            $direct_income_data = DB::table('direct_income')->find(1);
            $data=compact('direct_income_data');
         
             //dd($direct_income_data);
          return view('superadmin.direct_income_setting')->with($data);
        }
    
    
       public function save_direct_income_setting(Request $request){ 
        //  dd($request);
         $status= $request->status;
         if($status=='0')
         {
           $data=array(
           'income_type'=>$request->income_type,
           'fixed_amount'=>$request->fixed_amount,
           'status'=>'1'
           );   
         }else{
              $data=array(
           'income_type'=>$request->income_type,
           'fixed_amount'=>$request->fixed_amount,
           'status'=>'0'
           );
         }
          
        $directincome=DB::table('direct_income')->update($data);  
        $request->session()->flash('success','Updated  Successfully');
        return redirect()->route('direct-income-setting-page');
        } 
        
        
      public function changeStatuse(Request $request){
        $id=$request->id;
        $table=$request->direct_income;
        $redirectUrl=$request->redirectUrl;
        if($request->status==0){
            $data['status']=1;
            $res=DB::table('direct_income')->where('id', $id)->update($data);
            if($res>0){
                 return redirect()->route($redirectUrl);
           }else{
                 return redirect()->route($redirectUrl);
            }
            
        }else{
            $data['status']=0;
            $res=DB::table('direct_income')->where('id', $id)->update($data);
            if($res>0){
                return redirect()->route($redirectUrl);
                }else{
                  return redirect()->route($redirectUrl);
            }
            
        }
     } 
    
        public function level_income_setting(Request $request){
          $title='Level Income Setting';
          $data = DB::table('levels')->get();
        $result = compact('data');
        // dd($result); die;
          return view('superadmin.level_income_setting')->with($result);
        }
    
       
     
    
    public function store_level(Request $request){
        foreach($request->level_first as $row){       
            $data = array(                  
                'type'=>$request->type,
                'minimum_business'=>$request->minimum_business,
                'direct_required'=>$request->direct_required,
                'level_first' =>$row,
                );
                DB::table('levels')->insert($data);
        }
        
        return redirect('super-admin/level_income_setting');
    }
    function list()
    {
        $data = level::all();
        return view('level_income_setting',['levels'=>$data]);
    }
    function level_delete($id)
    {
        $data= level::find($id);
        $data->delete();
        return redirect('super-admin/level_income_setting');
    }
    public function updatelevel(Request $request)
    {
        $id = $request->id;
        $level_first = $request->input('level_first');
        $direct_required = $request->input('direct_required');
        $minimum_business = $request->input('minimum_business');
        $result=DB::table('levels')->where('id',$id)->get();
        $data = array(
            'level_first' =>$request->level_first,
            'direct_required'=>$request->direct_required,
            'minimum_business'=>$request->minimum_business,
            );
       $res=DB::table('levels')->where('id',$id)->update($data);
    //   print_r($res); die;
       if($res>0){
           echo 1;
       }else{
           echo 0; 
       }
    
}

      
    
}
