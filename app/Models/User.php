<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use App\UserProfiles;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use HasRoles;

    protected $table = 'users';

    protected $fillable = [
        'username', 'password', 'last_login'
    ];

    protected $dates = [
        'last_login'
    ];

    public $timestamps = true;

    public function users_profiles()
    {
        return $this->hasOne(UserProfiles::class);
    }

    public function scopeFilterusername($query, $request)
    {
        if ($request->has('search')) {
            $search = $request->search;
            switch ($request->filter) {
                case "Username":
                    $query->where('username', 'like', "%$search%");
                    break;
                case "Nama":
                    $query = UserProfiles::where('name', 'LIKE', "%$search%");
                    break;
                case "NPK":
                    $query = UserProfiles::where('employee_number', 'LIKE', "%$search%");
                    break;
            }
        }
        return $query;
    }

    public function getLastLoginFormattedAttribute()
    {
        $last_login = $this->last_login;

        if ($last_login !== null) {
            return $last_login->format('d.m.Y H.i.s');
        }

        return null;
    }

    public function AauthAcessToken()
    {
        return $this->hasMany('\App\OauthAccessToken');
    }

    // public function () {}

    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
