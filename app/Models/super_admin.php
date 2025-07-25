<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
use Illuminate\Foundation\Auth\User as Authenticatable;
 
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class super_admin extends Authenticatable
{
    use HasFactory;
    protected $table='super_admin';
    protected $guard = 'super_admin';
}
