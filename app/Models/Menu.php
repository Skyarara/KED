<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'permission_id',
        'parent_id',
        'title', 
        'icon',
        'route_name'
    ];

    public $timestamps = true;

    public function child()
	{
		return $this->hasMany(Self::class, 'parent_id');
	}

	public function parent()
	{
		return $this->belongsTo(Self::class, 'parent_id');
    }

    public function childRecrusive()
	{
		return $this->child()->with('childRecrusive');
	}

	public function permission()
	{
		return $this->belongsToMany(Permission::class, 'menus_has_permission', 'menu_id', 'permission_id');
	}
}
