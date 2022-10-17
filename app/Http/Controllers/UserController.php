<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Response;
use Carbon\Carbon;
use App\User;
use App\UserProfiles;
use App\Models\Role;
use App\Models\Permission;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        // $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $result = [];
        $fil = "";
        if($request->has('filter')) $fil = $request->filter;

        if($request->filter == "Role")
        {
            $users = User::with('users_profiles')->has('users_profiles')->paginate(10);
            foreach($users as $dt)
            {
                if(strpos(strtolower($dt->getRoleNames()->first()), strtolower($request->search)) !== false) {
                    $result[] = ([
                        'id' => $dt->id,
                        'nama' => $dt->users_profiles->name,
                        'npk' => $dt->users_profiles->employee_number,
                        'nohp' => $dt->users_profiles->phone,
                        'alamat' => $dt->users_profiles->address,
                        'username' => $dt->username,
                        'last_login' => $dt->last_login,
                        'role' => $dt->getRoleNames()->first() ?? null
                    ]);
                }
            }
            return view('user.index', compact('result', 'users', 'fil'));
        }

        $users = User::with('users_profiles')->has('users_profiles')->filterusername($request)->paginate(10);        
        foreach($users as $dt) 
        {
            if($request->filter == "Username" || $fil == "") {
                $result[] = ([
                    'id' => $dt->id,
                    'nama' => $dt->users_profiles->name,
                    'npk' => $dt->users_profiles->employee_number,
                    'nohp' => $dt->users_profiles->phone,
                    'alamat' => $dt->users_profiles->address,
                    'username' => $dt->username,
                    'last_login' => $dt->last_login,
                    'role' => $dt->getRoleNames()->first() ?? null
                ]);
            } else {
                $result[] = ([
                    'id' => $dt->id,
                    'nama' => $dt->name,
                    'npk' => $dt->employee_number,
                    'nohp' => $dt->phone,
                    'alamat' => $dt->address,
                    'username' => $dt->user->username,
                    'last_login' => $dt->last_login,
                    'role' => $dt->user->getRoleNames()->first() ?? null
                ]);
            }

        }

        return view('user.index', compact('result', 'users', 'fil'));

    }

    public function tambah_page()
    {
        $role = Role::get();
        $permission = Permission::get();

        return view('user.tambah', compact('role', 'permission'));
    }

    public function tambah(Request $request)
    {
        $rules = array(
            'username' => 'required',
            'password' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toarray()));
        } else {

        $user = new User();
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->is_active = 0;
        if ($request->aktif)
        {
        $user->is_active = $request->aktif;
        }
        $user->save();
        $user->assignRole($request->role);

        $users = new UserProfiles();
        $users->name = $request->nama;
        $users->employee_number = $request->npk;
        $users->phone = $request->nohp;
        $users->address = $request->alamat;
        $users->is_mechanic = 0;
        if ($request->mekanik)
        {
        $users->is_mechanic = $request->mekanik;
        }
        $users->user_id = User::latest()->first()->id;
        $users->save();

        return redirect('/user');

        }
    }

    public function ubah_page($id)
    {
        $old_users = User::with('users_profiles')->has('users_profiles')->find($id);
        // dd($old_users);
        $users = User::with('users_profiles')->has('users_profiles')->get();
        $role = Role::get();

        return view('user.ubah', compact('old_users', 'users', 'role','id'));   
    }

    public function ubah(request $request, $id)
    {
        $rules = array(
            'username' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toarray()));
        } else {
            
            $user = User::with('users_profiles')->has('users_profiles')->find($request->id);
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->is_active = $request->aktif;

            $user->save();
            $user->assignRole($request->role);
            
            $user->users_profiles->name = $request->nama;
            $user->users_profiles->employee_number = $request->npk;
            $user->users_profiles->phone = $request->nohp;
            $user->users_profiles->address = $request->alamat;
            $user->users_profiles->is_mechanic = $request->mekanik;

            $user->users_profiles->save();

            return redirect('/user');
        }
    }

    public function show($id)
    {
        $item = $this->user->with('users_profiles')->findOrFail($id);

        $view = [
            'title' => 'Detail User',
            'item' => $item
        ];

        return view('user.show')->with($view);
    }


    public function hapus(request $request)
    {
    if (Auth::User()->id == $request->id)
    {
        return 0;
    }
    
    $user = User::with('users_profiles')->has('users_profiles')->find($request->id)->delete();
    return 1;
    }
}
