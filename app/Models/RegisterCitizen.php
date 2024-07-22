<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class RegisterCitizen extends Model
{
    use HasFactory, SoftDeletes, Notifiable, HasRoles;

    protected $fillable = [
        'citizen_first_name', 
        'citizen_middle_name',
        'citizen_last_name', 
        'citizen_mobile_no',
        'citizen_email',
        'citizen_address',
        'citizen_username',
        'password',
        'created_by', 
        'updated_by', 
        'deleted_by'
    ];

    public static function booted()
    {
        static::deleting(function (self $user)
        {
            if(Auth::check())
            {
                self::where('id', $user->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
