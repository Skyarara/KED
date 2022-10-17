<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as RoleSpatie;

class Role extends RoleSpatie
{
    protected $table = 'roles';

    protected $fillable = [
        'name',
        'is_active',
        'guard_name'
    ];

    public $timestamps = true;

    public function scopeFilter($query, $request)
    {
        if ($request->has('filter')) {
            switch ($request->get('filter')) {
                case 'Role':
                        $query->where(function ($query) use ($request) {
                            $query->where('name', 'LIKE', '%' . $request->get('role') . '%');
                        });
                    break;
                case 'Permission':
                        $query->where(function ($query) use ($request) {
                            $query->whereHas('permissions', function ($query) use ($request) {
                                $query->where('name', 'LIKE', '%' . $request->get('permission') . '%');
                            });
                        });
                    break;
                case 'Status':
                        $query->where(function ($query) use ($request) {
                            $query->where('is_active', $request->get('status'));
                        });
                    break;
            }
        }
    }

    public function getIsActiveFormattedAttribute()
    {
        $is_active = $this->getAttribute('is_active');

        return $is_active
               ? '<label class="label-green"><i class="icon-circle-check"></i> Aktif</label>'
               : '<label><i class="icon-ban2"></i> Tidak Aktif</label>';
    }
}
