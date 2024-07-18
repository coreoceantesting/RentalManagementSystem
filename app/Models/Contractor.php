<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Contractor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'contractor_name', 
        'contractor_mobile_no',
        'contractor_email', 
        'contractor_address', 
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
