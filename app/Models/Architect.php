<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Architect extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'architect_name', 
        'architect_mobile_no',
        'architect_email', 
        'architect_address', 
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
