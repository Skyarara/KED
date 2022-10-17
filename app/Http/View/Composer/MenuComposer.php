<?php

namespace App\Http\View\Composer;

use Illuminate\View\View;
use Illuminate\Auth\AuthManager;
use App\Models\Menu;

Class MenuComposer
{

    protected $menu;
    protected $user;
    protected $resevedMenusIds;

    public function __construct(AuthManager $auth)
    {
        $this->resevedMenusIds = collect();
        $this->menu = collect();
        if ($auth->check()) {
            $this->user = $auth->user();

            $this->menu = $this->user->roles->reduce(function ($menu, $role) {
                $menu[$role->name] = $this->getMenu($this->user->id, $role->id);

                return $menu;
            }, collect());

            $this->menu->prepend($this->getMenu($this->user->id), 'General');
        }
    }

    public function getMenu($userId, $roleId = null, $parentId = null)
    {
        try {
            $query = Menu::whereHas('permission', function ($query) use ($roleId, $userId) {
                if (null !== $roleId) {
                    $query->whereHas('roleCanDo', function ($query) use ($roleId) {
                        $query->where('role_id', $roleId);
                    });
                }
                $query->whereHas('userCanDo', function ($query) use ($userId) {
                    $query->where('model_id', $userId);
                });
            })
            ->withCount('child')
            ->whereNotIn('menus.id', $this->resevedMenusIds->toArray())
            ->where('parent_id', $parentId)
            ->get();


            return $query->tap(function ($menus) {
                $this->resevedMenusIds = $this->resevedMenusIds->merge($menus->pluck('id'));
            })
            ->map(function ($menu) use ($roleId, $parentId, $userId) {
                $view = view('layout.menu-item' , compact('menu'));

                if ($menu->child_count > 0) {
                    $childs = $this->getMenu($userId, $roleId, $menu->id);
                    $view->with(['childs' => $childs]);
                }

                return $view->render();
            });
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }

    public function compose(View $view)
    {
        $view->with([
            'menus' => $this->menu
        ]);
    }
}