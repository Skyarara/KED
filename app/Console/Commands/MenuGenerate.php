<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Models\Menu;
use Spatie\Permission\Contracts\Role as RoleContract;
use App\Models\Permission;
use App\User;
use App\Console\Commands\Menu\AdminMenu;

class MenuGenerate extends Command
{
    protected $signature = 'menu:generate';

    protected $description = 'Generate Menu';

    protected $menu;
    protected $role;
    protected $user;
    protected $permission;

    use AdminMenu;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Menu $menu, RoleContract $role)
    {
        parent::__construct();

        $this->menu = $menu;
        $this->role = $role;
        $this->permission = app(Permission::class);
        $this->user = app(User::class);
    }

    /**
	 *fungsi ini untuk membuat
	 *user mengatur parenting menu.
	 */
	public function composingMenu()
	{
        return [
            $this->adminComposingMenu()
        ];
    }

    public function rolePermission()
    {
        // Jangan Lupa ditambah trait untuk setiap akses role

        return [
            'admin'  => $this->adminAccess(),
        ];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::beginTransaction();

        try {

            DB::table('menus_has_permission')->truncate();
            DB::table('menus')->truncate();
        
            if ( is_array($this->rolePermission())) {
                foreach ($this->rolePermission() as $role => $permissionsAndMenus) {

                    $role = $this->role->firstOrCreate([
                        'name' => $role
                    ]);

                    foreach ($permissionsAndMenus as $permission => $menus) {

                        list($permissionName, $permissionDesc) = explode(' : ', $permission);

                        $permission = $this->permission->firstOrCreate([
                            'name' => $permissionName,
                            'desc' => $permissionDesc,
                            'guard_name' => 'web'
                        ]);

                        $role->givePermissionTo($permission->name);

                        if (is_array($menus) && count($menus) > 0) {

                            $permissionOnMenu = collect();

                            foreach ($menus as $menu) {
                                $menu = $this->menu->firstOrCreate([
                                    'title' => $menu['title'],
                                    'route_name' => $menu['route_name'] ?? null
                                ]);

                                $permissionOnMenu->push($menu->id);
                            }

                            $permission->menu()->sync($permissionOnMenu->toArray());

                        }
                    }
                }
            }


            if ( is_array($this->composingMenu())) {

                $this->buildMenu($this->composingMenu());
            }

            DB::commit();
        } catch (\Exception $e) {
            $this->info($e->getMessage());

            DB::rollBack();
        }
    }

    public function buildMenu($getMenus)
    {
        foreach ($getMenus as $menus) {

            foreach ($menus as $menu) {
                $query = $this->menu->query();

                if (isset($menu['title']) && $menu['title'] !== null) {
                    $query->where('title', $menu['title']);
                }

                if (isset($menu['route_name']) && $menu['route_name'] !== null) {
                    $query->where('route_name', $menu['route_name']);
                }

                $resultMenu = $query->first();

                if ($resultMenu === null) {
                    if (isset($menu['title']) && $menu['title'] !== null) {
                        $resultMenu = $this->menu->create([
                            'title'      => $menu['title'],
                            'route_name' => null,
                            'icon'       => $menu['icon'] ?? '',
                        ]);
                    }
                }

                if (isset($menu['child'])) {
                    $menuChild = collect();

                    $this->buildMenuChild($menu['child'], $menuChild);

                    if ($menuChild->isNotEmpty()) {
                        $parentPermissionIDs = $resultMenu->permission->pluck('id');
                        foreach ($menuChild as $child) {
                            $resultMenu->child()->save($child);
                            $parentPermissionIDs = $parentPermissionIDs->merge($child->permission->pluck('id'));
                        }
                        $resultMenu->permission()->sync($parentPermissionIDs);
                    }
                }
            }

        }
    }

    public function buildMenuChild($menus, &$childMenu)
    {
        foreach ($menus as $menu) {
            $query = $this->menu->query();

            if (isset($menu['title']) && $menu['title'] !== null) {
                $query->where('title', $menu['title']);
            }

            if (isset($menu['route_name']) && $menu['route_name'] !== null) {
                $query->where('route_name', $menu['route_name']);
            }

            $resultMenu = $query->first();

            if ($resultMenu === null) {
                if (isset($menu['title']) && $menu['title'] !== null) {
                    $resultMenu = $this->menu->create([
                        'title'      => $menu['title'],
                        'route_name' => $menu['route_name'] ?? null,
                        'icon'       => $menu['icon'] ?? null,
                    ]);
                }
            }

            if (null !== $resultMenu && null !== $childMenu) {
				$childMenu->push($resultMenu);
            }

            if (isset($menu['child'])) {

                $menuChild = collect();

                $this->buildMenuChild($menu, $menuChild);

                if ($menuChild->isNotEmpty()) {
					$parentPermissionIDs = $resultMenu->permission->pluck('id');
					foreach ($menuChild as $child) {
						$resultMenu->child()->save($child);
						$parentPermissionIDs = $parentPermissionIDs->merge($child->permission->pluck('id'));
					}
					$resultMenu->permission()->sync($parentPermissionIDs);
				}
            }
        }
    }
}