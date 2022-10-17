<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as PermissionSpatie;
use Spatie\Permission\Models\Role;
use App\Models\Menu;
use App\User;

class Permission extends PermissionSpatie
{
    protected $table = 'permissions';

    protected $fillable = [
		'name',
		'desc',
        'guard_name'
    ];

    public $timestamps = true;

    public function menu()
	{
		return $this->belongsToMany(Menu::class, 'menus_has_permission', 'permission_id', 'menu_id');
	}

	public function roleCanDo()
	{
		return $this->belongsToMany(Role::class, 'role_has_permissions', 'permission_id', 'role_id');
	}

	public function userCanDo()
	{
		return $this->morphedByMany(User::class, 'model', 'model_has_permissions');
	}
}
