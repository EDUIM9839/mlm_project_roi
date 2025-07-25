<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserPackage;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
     
    protected $table = 'user';

    protected $fillable = [
        'first_name',
        'email',
        'password',
        'contact',
        'last_name',
        'api_key',
        'referal',
        'userid',
        'role',
        'image',
        'pan',
        'pan_img',
        'nomini_name',
        'nomini_relation',
        'nomini_email',
        'about',
        'referal',
        'saving_wallet',
        'withdrawl_wallet',
        'user_tron_aadress',
        'user_upi_address',
        'your_tokens',
        'transaction_password',
        'push_notification_code',
        'autopool_wallet',
        'booster_wallet',
        'direct_income',
        'level_income',
        'global_key',
        'hold_booster_wallet', 
        'new_password',
        'confirm_password',
        'country',
        'state',
        'city',
        'aadhar_no',
        'pan',
        
    ];

    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        
    ];

    public function user_package($value='')
    {
        return $this->hasMany(UserPackage::class,'user_id');
    }

 
}
