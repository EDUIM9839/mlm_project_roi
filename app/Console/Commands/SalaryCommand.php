<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Http\Controllers\MLMController;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
 
 

class SalaryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salary:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Salary Cron';

    /**
     * Execute the console command.
     */
    public function handle()
    {
     echo  $current_date=date("Y-m-d H:i:s");
      $this->salary_distribution();
        echo "-- Salary Successfully Done -- ";
    }
    
    public function salary_distribution(){
        $firstDayOfLastMonth = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d 00:00:00');
        $salaryMonth = Carbon::now()->subMonth()->startOfMonth()->format('M Y');
        $lastDayOfLastMonth = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d 23:59:59');
        $user_package = DB::table("user_package")->groupBy('user_id')->get();
        
        foreach($user_package as $up){
            $mlm = new MLMController();
            $downlineBusiness = $mlm->getTeamBusinessBetween($up->user_id,$firstDayOfLastMonth,$lastDayOfLastMonth);
            $salary = $downlineBusiness * 0.05/100;
            
            
            if($salary <= 0){
                continue;
            }
            
            $insert_income = [
                'type' => 'salary',
                'amount' => $salary,
                'total_collection'=>$downlineBusiness,
                'received_user' => $up->user_id, 
                'joined_user' => $up->user_id,
                'credit_debit' => 'credit',
                'discription' => $salaryMonth,
            ];
            DB::table('income_history')->insert($insert_income);
            DB::table('user')->where('id',$up->user_id)->increment('withdrawl_wallet',$salary);
             echo "user id=".$up->user_id." ||| First Day of Month =".$firstDayOfLastMonth."||| Last Day of Month=".$lastDayOfLastMonth." ||| Salary of Month=".$salaryMonth." || Total Business =".$downlineBusiness." |||  Salary : $salary<br>";
        }
    }
    
  
      
      
        
     
  
    
    
    
    
}
