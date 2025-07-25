<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Image;
use App\Http\Controllers\BtreeController;
use Storage;
use App\Http\Controllers\MLMController;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LotteryHandleController extends Controller
{
    public function lottery_pending(){
        $lottery_weeks = DB::table('lottery_entries')
            ->select('week_year', DB::raw('SUM(investment_amount) as total_amount'), DB::raw('COUNT(DISTINCT user_id) as total_participants'))
            ->groupBy('week_year')
            ->orderBy('week_year', 'desc')
            ->get();
        return view('admin.lottery_list', compact('lottery_weeks'));
    }
    
    // public function selectWinner(Request $request, $week){
    //     $now = Carbon::now();
    //     $saturday = Carbon::now()->startOfWeek()->addDays(5)->setTime(22, 30); 
    //     $sunday = Carbon::now()->startOfWeek()->addDays(6)->setTime(23, 59, 59);
    //     if (!$now->between($saturday, $sunday)) {
    //         return back()->with('error', 'Winners can only be selected from Saturday 10:30 PM to Sunday 11:59 PM.');
    //     }
    //     $winners = $request->input('winner', []);
    //     if (empty($winners)) {
    //         return back()->with('error', 'Please select at least one winner.');
    //     }
    //     if (count($winners) > 3) {
    //         return back()->with('error', 'You can select a maximum of 3 winners only.');
    //     }
    //     $processedUserIds = [];
    //     $winnerIds = [];
    //     $loserIds = [];
    //     $winnerPairs = [];
    //     foreach ($winners as $winnerInfo) {
    //         $userId = intval($winnerInfo['id']);
    //         if (in_array($userId, $processedUserIds)) {
    //             continue; 
    //         }
        
    //         $multiply = floatval($winnerInfo['percentage']);
    //         $entry = DB::table('lottery_entries')
    //             ->where('week_year', $week)
    //             ->where('id', $userId)
    //             ->first();
        
    //         if (!$entry) {
    //             continue;
    //         }
        
    //         $investmentAmount = floatval($entry->investment_amount);
    //         $winningAmount = $investmentAmount * $multiply / 100;
    //         $winnerPairs[] = "$userId:$multiply";
    //         DB::table('lottery_entries')
    //             ->where('id', $userId)
    //             ->update([
    //                 'status' => 'winner',
    //                 'winning_amount' => $winningAmount,
    //             ]);
    //         // DB::table('lottery_entries')
    //         //     ->where('week_year', $week)
    //         //     ->where('id', $userId)
    //         //     ->update([
    //         //         'status' => 'loser',
    //         //         'winning_amount' => null,
    //         //     ]);
    //         $income_data = [
    //             'type' => 'lottery',
    //             'amount' => $winningAmount,
    //             'invest_amount' => $investmentAmount,
    //             'roi_percent' => $multiply,
    //             'joined_user' => $userId,
    //             'received_user' => $userId,
    //             'credit_debit' => 'credit',
    //             'discription' => 'Lottery Winning for Week ' . $week,
    //         ];
    //         DB::table('income_history')->insert($income_data);
    //         DB::table('user')->where('id', $userId)->increment('withdrawl_wallet', $winningAmount);
    //         $winnerIds[] = $userId;
    //         $processedUserIds[] = $userId;
    //     }
        
    //     $allUserIds = DB::table('lottery_entries')
    //         ->where('week_year', $week)
    //         ->pluck('id')
    //         ->unique();
    //     foreach ($allUserIds as $userId) {
    //         if (!in_array($userId, $processedUserIds)) {
    //             DB::table('lottery_entries')
    //                 ->where('week_year', $week)
    //                 ->where('id', $userId)
    //                 ->update([
    //                     'status' => 'loser',
    //                     'winning_amount' => null,
    //                 ]);
    //             $loserIds[] = $userId;
    //         }
    //     }
    //     DB::table('lottery_results')->updateOrInsert(
    //         ['week_year' => $week],
    //         [
    //             'winners' => '{' . implode(',', $winnerPairs) . '}',
    //             'losers' => '{' . implode(',', $loserIds) . '}',
    //             'updated_at' => now(),
    //             'created_at' => now(),
    //         ]
    //     );
        
    //     return back()->with('success', 'Winners selected successfully.');

    // }
    public function viewParticipants($week_year){
        $participants = DB::table('lottery_entries')
            ->where('week_year', $week_year)
            ->select('id', 'user_id', 'investment_amount', 'winning_amount')
            ->get();
        $user_ids = $participants->pluck('user_id')->toArray();
        $users = DB::table('user')->whereIn('id', $user_ids)->get()->keyBy('id');
    
        $result = DB::table('lottery_results')->where('week_year', $week_year)->first();
        $result_winners = [];
        $result_losers = [];
    
        if ($result && !empty($result->winners)) {
            $cleaned = trim($result->winners, '{}');
            foreach (explode(',', $cleaned) as $pair) {
                $user_id = explode(':', $pair)[0];
                $result_winners[] = $user_id;
            }
        }
        if ($result && !empty($result->losers)) {
            $result_losers = explode(',', trim($result->losers, '{}'));
        }
        // dd(23456);
        return view('admin.participant_page', compact(
            'week_year',
            'participants',
            'users',
            'result',
            'result_winners',
            'result_losers'
        ));
    }

    public function selectWinner(Request $request, $week){
     
        $now = Carbon::now();
        $saturday = Carbon::now()->startOfWeek()->addDays(5)->setTime(22, 30);
        $sunday = Carbon::now()->startOfWeek()->addDays(6)->setTime(23, 59, 59);
    
        /* if (!$now->between($saturday, $sunday)) {
            return back()->with('error', 'Winners can only be selected from Saturday 10:30 PM to Sunday 11:59 PM.');
        }
        */
    
        $winnerSelections = $request->input('winner', []);
        if (empty($winnerSelections)) {
            return back()->with('error', 'Please select at least one winner.');
        }
         
        if (count($winnerSelections) > 10) {
            return back()->with('error', 'You can select a maximum of 10 winners only.');
        }
        
        $distribution = DB::table('weekly_distributions')->where('week_year', $week)->first();
        if (!$distribution) {
            return back()->with('error', 'No distribution percentages defined for this week.');
        }
    // dd($request->all(),$winnerSelections,$distribution,$week);
        $percentArr = [
            1 => $distribution->first_winner_percent,
            2 => $distribution->second_winner_percent,
            3 => $distribution->third_winner_percent,
            4 => $distribution->fourth_winner_percent,
            5 => $distribution->fifth_winner_percent,
            6 => $distribution->sixth_winner_percent,
            7 => $distribution->seventh_winner_percent,
            8 => $distribution->eighth_winner_percent,
            9 => $distribution->ninth_winner_percent,
            10 => $distribution->tenth_winner_percent,
        ];
        
        $processedUserIds = [];
        $winnerPairs = [];
        $loserIds = [];
    
        foreach ($winnerSelections as $index => $entryId) {
            $position = $index + 1;
    
            if (!isset($percentArr[$position])) {
                continue; 
            }
    
            $entry = DB::table('lottery_entries')
                ->where('week_year', $week)
                ->where('id', $entryId)
                ->first();
    
            if (!$entry) {
                continue;
            }
    
            $percentage = $percentArr[$position];
            $investmentAmount = floatval($entry->investment_amount);
            $winningAmount = $investmentAmount * $percentage / 100;
            
            DB::table('lottery_entries')
                ->where('id', $entryId)
                ->update([
                    'status' => 'winner',
                    'winning_amount' => $winningAmount,
                ]);
    
            $income_data=[
                'type' => 'lottery',
                'amount' => $winningAmount,
                'invest_amount' => $investmentAmount,
                'roi_percent' => $percentage,
                'joined_user' => $entry->user_id,
                'received_user' => $entry->user_id,
                'credit_debit' => 'credit',
                'discription' => 'Lottery Winning for Week ' . $week,
                'date_time' => now(),
            ];
            DB::table('income_history')->insert($income_data);
            DB::table('user')->where('id', $entry->user_id)->increment('withdrawl_wallet', $winningAmount);
    
            $winnerPairs[] = $entryId . ':' . $percentage;
            $processedUserIds[] = $entryId;
        }
        $allEntryIds = DB::table('lottery_entries')
            ->where('week_year', $week)
            ->pluck('id')
            ->toArray();
    
        foreach ($allEntryIds as $entryId) {
            if (!in_array($entryId, $processedUserIds)) {
                DB::table('lottery_entries')
                    ->where('id', $entryId)
                    ->update([
                        'status' => 'loser',
                        'winning_amount' => null,
                    ]);
                $loserIds[] = $entryId;
            }
        }

        DB::table('lottery_results')->updateOrInsert(
            ['week_year' => $week],
            [
                'winners' => '{' . implode(',', $winnerPairs) . '}',
                'losers' => '{' . implode(',', $loserIds) . '}',
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
        DB::table('weekly_distributions')->where('week_year', $week)
                    ->update([
                        'status' => 'distributed'
                    ]);
        return back()->with('success', 'Winners selected successfully.');
    }
    public function lottery_result_view(Request $request){
        $currentWeek = now()->format('o-\WW'); 
        $previousWeek = now()->subWeek()->format('Y-\WW'); 
        $previousWeekFormatted = now()->subWeek()->format('Y') . '-' . now()->subWeek()->format('W');
    
        // Prioritize manual user ID input if provided
        $userId = $request->input('user_id_manual') ?: $request->input('user_id');
        $week = $request->game_id ?? $previousWeekFormatted; 
        $result = $request->result;
        $gameDate = $request->game_date;
    
        $lotteryEntries = DB::table('lottery_entries')
            ->join('user', 'lottery_entries.user_id', '=', 'user.id')
            ->when($week, function ($query, $week) {
                return $query->where('lottery_entries.week_year', $week);
            })
            ->when($result, function ($query, $result) {
                return $query->where('lottery_entries.status', $result);
            })
            ->when($userId, function ($query, $userId) {
                return $query->where('user.userid', $userId);
            })
            ->when($gameDate, function ($query, $gameDate) {
                return $query->whereDate('lottery_entries.created_at', $gameDate);
            })
            ->select(
                'lottery_entries.*',
                'user.userid as user_id',
                'user.first_name',
                'user.last_name'
            )
            ->orderBy('lottery_entries.created_at', 'desc')
            ->paginate(50);
    
        $users = DB::table('user')->where('role','user')->get();
        $weeks = DB::table('lottery_entries')
            ->select('week_year')
            ->distinct()
            ->orderByDesc('week_year')
            ->get();
    
        return view('admin.lottery_result', compact('lotteryEntries', 'users', 'weeks', 'week'));
    }

    
    
    public function percentage() {
        $distributions = DB::table('weekly_distributions')->orderByDesc('id')->get();
        return view('admin.week_percentage', compact('distributions'));
    }
    
    public function editWeekPercentage($id) {
        $distributions = DB::table('weekly_distributions')->orderByDesc('id')->get();
        $editData = DB::table('weekly_distributions')->where('id', $id)->first();
        if (!$editData) {
            return redirect()->route('percent')->with('error', 'Record not found.');
        }
        if ($editData->status !== 'pending') {
            return redirect()->route('percent')->with('error', 'Only pending data can be edited.');
        }
        return view('admin.week_percentage', compact('distributions', 'editData'));
    }

    
    public function saveWeekPercentage(Request $request) {
        $request->validate([
            'week' => ['required', 'regex:/^\d{4}-W\d{2}$/'],
            'first_percent' => 'required|numeric|min:0',
            'second_percent' => 'required|numeric|min:0',
            'third_percent' => 'required|numeric|min:0',
            'fourth_percent' => 'required|numeric|min:0',
            'fifth_percent' => 'required|numeric|min:0',
            'sixth_percent' => 'required|numeric|min:0',
            'seventh_percent' => 'required|numeric|min:0',
            'eighth_percent' => 'required|numeric|min:0',
            'ninth_percent' => 'required|numeric|min:0',
            'tenth_percent' => 'required|numeric|min:0',
        ]);
        // $total = $request->first_percent + $request->second_percent + $request->third_percent;
    
        // if ($total > 100) {
        //     return back()->with('error', 'Total percentage must not exceed 100%.');
        // }
        $weekFormatted = str_replace('-W', '-', $request->week);
        [$year, $weekNumber] = explode('-', $weekFormatted);
        $exists = DB::table('weekly_distributions')->where('week_year', $weekFormatted)->exists();
    
        if ($exists) {
            return back()->with('error', 'This week\'s percentage is already saved.');
        }
        // $currentWeekYear = date('o') . '-' . date('W'); 
        // if ($weekFormatted == $currentWeekYear) {
        //     return back()->with('error', 'You cannot set percentage for the current running week again.');
        // }
    
        $wekly_distribute =[
            'week_year' => $weekFormatted,
            'first_winner_percent' => $request->first_percent,
            'second_winner_percent' => $request->second_percent,
            'third_winner_percent' => $request->third_percent,
            'fourth_winner_percent' => $request->fourth_percent,
            'fifth_winner_percent' => $request->fifth_percent,
            'sixth_winner_percent' => $request->sixth_percent,
            'seventh_winner_percent' => $request->seventh_percent,
            'eighth_winner_percent' => $request->eighth_percent,
            'ninth_winner_percent' => $request->ninth_percent,
            'tenth_winner_percent' => $request->tenth_percent,
            'created_at' => now()
        ];
        DB::table('weekly_distributions')->insert($wekly_distribute);
        return back()->with('success', 'Weekly percentage saved successfully.');
    }
    
    public function updateWeekPercentage(Request $request, $id) {
        // $request->validate([
        //     'first_percent' => 'required|numeric|min:0',
        //     'second_percent' => 'required|numeric|min:0',
        //     'third_percent' => 'required|numeric|min:0',
        //     'fourth_percent' => 'required|numeric|min:0',
        //     'fifth_percent' => 'required|numeric|min:0',
        //     'sixth_percent' => 'required|numeric|min:0',
        //     'seventh_percent' => 'required|numeric|min:0',
        //     'eighth_percent' => 'required|numeric|min:0',
        //     'ninth_percent' => 'required|numeric|min:0',
        //     'tenth_percent' => 'required|numeric|min:0',
        // ]);
        $record = DB::table('weekly_distributions')->where('id', $id)->first();
        if (!$record) {
            return back()->with('error', 'Record not found.');
        }
        if ($record->status !== 'pending') {
            return back()->with('error', 'Only pending data can be edited.');
        }
        $update_distribtion = [
            'first_winner_percent' => $request->first_percent,
            'second_winner_percent' => $request->second_percent,
            'third_winner_percent' => $request->third_percent,
            'fourth_winner_percent' => $request->fourth_percent,
            'fifth_winner_percent' => $request->fifth_percent,
            'sixth_winner_percent' => $request->sixth_percent,
            'seventh_winner_percent' => $request->seventh_percent,
            'eighth_winner_percent' => $request->eighth_percent,
            'ninth_winner_percent' => $request->ninth_percent,
            'tenth_winner_percent' => $request->tenth_percent,
            'updated_at'=> now()
        ];
        DB::table('weekly_distributions')->where('id', $id)->update($update_distribtion);
        return redirect()->route('percent')->with('success', 'Week data updated successfully.');
    }



    public function exportWinners($week): StreamedResponse{
        $winners = DB::table('lottery_entries')
                    ->where('week_year', $week)
                    // ->where('status', 'winner')
                    ->join('user', 'user.id', '=', 'lottery_entries.user_id')
                    ->select('user.first_name', 'user.userid', 'lottery_entries.winning_amount')
                    ->groupBy('user.id', 'lottery_entries.week_year')
                    ->get();
        $filename = 'winners_week_' . $week . '.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];
        $columns = ['Name', 'User ID', 'Winning Amount'];
        $callback = function () use ($winners, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($winners as $winner) {
                fputcsv($file, [
                    $winner->first_name,
                    $winner->userid,
                    $winner->winning_amount,
                ]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
    
    public function resetWinners($week){
        DB::table('lottery_entries')
            ->where('week_year', $week)
            ->update([
                'status' => 'pending',
                'winning_amount' => null,
            ]);
    
        return back()->with('success', 'Winners reset successfully.');
    }


}