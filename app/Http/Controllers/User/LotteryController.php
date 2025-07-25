<?php

namespace App\Http\Controllers\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BtreeController;
use App\Http\Controllers\MLMController;
use DateTime ;
use Carbon\Carbon;
use App\Models\User;
use App\Models\IncomeHistory;
use Illuminate\Support\Facades\Storage;
use Hash;
use Illuminate\Validation\ValidationException;


class LotteryController extends Controller
{
    public function invest_lottery(){
        $user = Auth::user();
        $entries = DB::table('lottery_entries')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get()
                ->groupBy('week_year');
        return view('user.invest_lottery', compact('entries'));
    } 
    
    public function lottery_amount(Request $request){
        $request->validate([
            'investment_amount' => 'required|numeric|min:5',
            'wallet' => 'in:saving_wallet,withdrawl_wallet',
        ]);
        $currentDateTime = now() ;
        $dayOfWeek = $currentDateTime->dayOfWeekIso;
        if ($dayOfWeek >= 1 && $dayOfWeek <= 6) {
            if (
                $dayOfWeek == 6 &&
                $currentDateTime->gt(Carbon::parse($currentDateTime->format('Y-m-d') . ' 22:30:00'))
            ) {
                return redirect()->back()->with('error', 'Lucky Draw is allowed only till Saturday 10:30 PM.');
            }
        } else {
            return redirect()->back()->with('error', 'Lucky Draw is  allowed from Monday 12:00 AM to Saturday 10:30 PM only.');
        }
        
       
        $user = Auth::user();
        $currentWeekYear = Carbon::now()->format('Y-W');
        
        if($request->wallet =='saving_wallet'){
            if ($user->saving_wallet < $request->investment_amount) {
                return redirect()->back()->with('error', 'Insufficient wallet balance.');
            }
        }else{
            if ($user->withdrawl_wallet < $request->investment_amount) {
                return redirect()->back()->with('error', 'Insufficient wallet balance.');
            }
        }
        
        
    
        $existing = DB::table('lottery_entries')
            ->where('user_id', $user->id)
            ->where('week_year', $currentWeekYear)
            ->first();
        $insert_amount = [
            'user_id' => $user->id,
            'week_year' => $currentWeekYear,
            'investment_amount' => $request->investment_amount,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('lottery_entries')->insert($insert_amount);
        if($request->wallet =='saving_wallet'){
            DB::table('user')->where('id', $user->id)->decrement('saving_wallet', $request->investment_amount);
        }else{
            DB::table('user')->where('id', $user->id)->decrement('withdrawl_wallet', $request->investment_amount);
        }
        return redirect()->back()->with('success', 'You have successfully entered the lottery.');
    }

    
    


     public function lottery_winner_list(){
        $lottery = DB::table('lottery_results')->orderBy('id', 'DESC')->first();
        $topEarners = [];
         
        if ($lottery && $lottery->winners) {
            $winnerPairs = explode(',', trim($lottery->winners, '{}'));
            $winnerIds = [];
            // $pointsMap = [];
            foreach ($winnerPairs as $pair) {
                [$userId, $points] = explode(':', $pair);
               
                $userId = trim($userId);
                $winnerIds[] = $userId;
                // $pointsMap[$userId] = $points; 
            }
           
            if (!empty($winnerIds)) {
                $topEarners = DB::table('lottery_entries as le')
                    ->join('user as u', 'u.id', '=', 'le.user_id')
                    ->select(
                        'u.userid',
                        'u.first_name',
                        'u.last_name',
                        'u.image',
                        'le.winning_amount',
                        'le.id',
                        'u.city',
                        'u.state'
                    )
                    ->where('le.week_year', $lottery->week_year)
                    ->whereIn('le.id', $winnerIds)
                    ->groupBy('le.user_id')
                    ->get();
                // foreach ($topEarners as $winner) {
                //     $winner->points = $pointsMap[$winner->id] ?? 0;
                // }
                $topEarners = $topEarners->sortBy(function ($item) use ($winnerIds) {
                            return array_search($item->id, $winnerIds);
                        })->values();
                // $topEarners = $topEarners->values();
                // dd($topEarners);
            }
        }
        return view('user.lottery_winner', compact('topEarners'));
    }
    
   


    public function top_earners(Request $request){
       
       
        $currentdate = date("Y-m-d");
        $startdate= date("Y-m-d", strtotime("monday this week"));
        $winner_data = DB::table('lottery_results as w')
                        ->join('user', 'user.id', '=', 'i.received_user');
        $totalEarners = DB::table('income_history as i')
                            ->join('user', 'user.id', '=', 'i.received_user')
                            ->selectRaw('SUM(i.amount) as total_amount, user.first_name, user.last_name, user.userid, user.image, user.city')
                            ->groupBy('i.received_user', 'user.first_name', 'user.last_name', 'user.userid', 'user.image', 'user.city')
                            ->having('total_amount', '>=', 1000)->where('i.created_at','>',$enddate)->where('i.created_at','<=',$lastdate)
                            ->orderBy('total_amount', 'desc')
                            ->get()
                            ->count();
                            
        $topEarners = DB::table('income_history as i')
                        ->join('user', 'user.id', '=', 'i.received_user')
                        ->selectRaw('SUM(i.amount) as total_amount, user.first_name, user.last_name, user.userid, user.image, user.city,user.state')
                        ->groupBy('i.received_user', 'user.first_name', 'user.last_name', 'user.userid', 'user.image', 'user.city')
                        ->having('total_amount', '>=', 1000)->where('i.created_at','>',$enddate)->where('i.created_at','<=',$lastdate)
                        ->orderBy('total_amount', 'desc')
                        ->take($cardsCount)
                        ->get();
        // dd($topEarners);
        return view('user.top-rank-earners', compact('topEarners', 'topEarnersEnabled', 'totalEarners'));
    }
    
    public function lotteryParticipents(Request $request){
        
        $participents = DB::table('lottery_entries')
        ->join('user', 'lottery_entries.user_id', '=', 'user.id')
                        // ->where('weak_year', date('o-W'))
                        ->where('status', 'pending')
                        ->select('lottery_entries.*', 'user.first_name', 'user.last_name', 'user.userid')
                        ->orderBy('id', 'desc')
                        ->get();
        
        return view('user.luckey_draw_participents', compact('participents'));
        
        
    }
    
    
}