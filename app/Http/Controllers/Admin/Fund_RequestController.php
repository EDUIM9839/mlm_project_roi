<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Fund_RequestController extends Controller
{
   public function fund_request()
  
    {
       $data = DB::table('user')
->select('add_fund.*', 'user.first_name', 'user.last_name')
->join('add_fund','user.id','=','add_fund.unique_id')
->where('status','approved')
->get();
//   $request->validate([
//              'amount'=>'required',
//              'user_id'=>'required',
             
//             ]);
        // $data = DB::table('add_fund')->get();
        // dd($data);
        return view('admin.fund_request', compact('data'));
    }
   public function pending_fund_request()
  
    {
       $data = DB::table('user')
->select('add_fund.*', 'user.first_name', 'user.last_name')
->join('add_fund','user.id','=','add_fund.unique_id')
->where('status','pending')
->get();
//   $request->validate([
//              'amount'=>'required',
//              'user_id'=>'required',
             
//             ]);
        // $data = DB::table('add_fund')->get();
        // dd($data);
        return view('admin.pending_fund_request', compact('data'));
    }
     public function fundrequest(Request $request){
            $unique_id=$request->input('unique_id');
            $user_id=$request->input('user_id');
            $amount=$request->input('amount');
            $get_data = DB::table('user')->where('id',$unique_id)->get('saving_wallet');
            $saving_wallet=$get_data['0']->saving_wallet+$amount;
            $query= DB::table('user')->where('id',$unique_id)->increment('saving_wallet',$amount);
             if($query==true){
                //  DB::table('add_fund')->where('unique_id',$unique_id)->update;
                 DB::update('update add_fund set status="approved" where unique_id='.$unique_id.'');
             }
             return redirect()->route('fund_request');
     }
     
    public function getEditfund(Request $request)
    {
        
        $id=$request->editid;
        // dd($id);die;
        $res=DB::table('add_fund')->where('id' , $id)->get();
        // echo $res['0']->user_id;
        // echo $res['0']->unique_id;
         $data['user_id']=$res['0']->user_id;
        $data['unique_id']=$res['0']->unique_id;
        $data['amount']=$res['0']->amount;
        echo json_encode($data);
        
     }
     
   public function delete_pending(Request $request,$id)
{

    DB::table('add_fund')->where('id',$id)->delete(); 
    $request->session()->flash('success', 'Record has been successfully deleted.'); 
    return redirect()->route('pending_fund_request');
}

}
 