<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeHistory extends Model
{
    use HasFactory;

    protected $table="income_history";

    public function getJoinedUser(){


        return $this->belongsTo(User::class,'joined_user','id');


    }
}
