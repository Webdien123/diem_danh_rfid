<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function LayThongTinTK($email)
    {
        $tk = \DB::select('SELECT * FROM `users` WHERE email = ?', [$email]);
        if ($tk) {
            return $tk;
        } else {
            return null;
        }
        
    }

    public static function KiemTraTaiKhoan($password, $mk_da_luu)
    {
        if (Hash::check($password, $mk_da_luu)) {
            return true;

        } else {
            return false;

        }
        
    }
}
