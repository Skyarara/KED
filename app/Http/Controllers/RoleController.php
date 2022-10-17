<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

use App\Http\Requests\RoleRequest;
use DB;
use Exception;
use App\Models\Permission;

class RoleController extends Controller
{

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = $this->role->withCount('users')->filter($request)->paginate(10);

        $view = [
            'title' => 'Role',
            'items' => $items
        ];

        return view('role.index')->with($view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->permission->get();

        $view = [
            'title' => 'Tambah Role',
            'permissions' => $permissions
        ];

        return view('role.create')->with($view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        DB::beginTransaction();
        try {
            $role = $this->role->create($request->all());

            if ($request->permission !== null) {
                $role->givePermissionTo($request->permission);
            }

            session()->flash('flash_message', [
                'type' => 'success',
                'message' => 'Berhasil Menambah Data'
            ]);

            DB::commit();

        } catch (Exception $e) {

            session()->flash('flash_message', [
                'type' => 'danger',
                'message' => $e->getMessage()
            ]);

            DB::rollBack();

            return redirect()->back()->withInput();
        }

        return redirect()->route('admin.role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->role->with('permissions')->findOrFail($id);

        $view = [
            'item' => $item,
            'title' => 'Detail Role'
        ];

        return view('role.show')->with($view);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->role->with('permissions')->findOrfail($id);

        $item_permission = $item->permissions->pluck('id')->toArray();

        $permissions = $this->permission->get();

        $view = [
            'title' => 'Edit Role',
            'item' => $item,
            'item_permission' => $item_permission,
            'permissions' => $permissions
        ];

        return view('role.edit')->with($view);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $item = $this->role->findOrFail($id);

            if ( ! $request->has('is_active')) {
                $request->request->add([
                    'is_active' => 0
                ]);
            }

            $item->update($request->all());

            $item->syncPermissions($request->permission ?? []);

            session()->flash('flash_message', [
                'type' => 'success',
                'message' => 'Berhasil Mengedit Data'
            ]);

            DB::commit();

        } catch (Exception $e) {

            session()->flash('flash_message', [
                'type' => 'danger',
                'message' => $e->getMessage()
            ]);

            DB::rollBack();

            return redirect()->back()->withInput();
        }

        return redirect()->route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $item = $this->role->findOrFail($id);

            $item->syncPermissions([]);

            $item->delete();

            session()->flash('flash_message', [
                'type' => 'success',
                'message' => 'Berhasil Menghapus Data'
            ]);

            DB::commit();

        } catch (Exception $e) {

            session()->flash('flash_message', [
                'type' => 'danger',
                'message' => $e->getMessage()
            ]);

            DB::rollBack();
        }

        return redirect()->route('admin.role.index');
    }
}
