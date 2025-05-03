<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Constructor del controlador.
     */
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Muestra la lista de usuarios.
     */
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'DESC')->get();

        // Obtener todos los roles para el filtro
        $roles = Role::pluck('name', 'id')->all();

        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado exitosamente');
    }

    /**
     * Muestra los detalles de un usuario específico.
     */
    public function show($id)
    {
        $user = User::find($id);

        // Obtener los roles del usuario
        $userRoles = $user->roles->pluck('name')->all();

        // Obtener los permisos del usuario a través de sus roles
        $rolePermissions = [];
        foreach ($user->roles as $role) {
            $permissions = $role->permissions->pluck('name')->all();
            $rolePermissions[$role->name] = $permissions;
        }

        return view('users.show', compact('user', 'userRoles', 'rolePermissions'));
    }

    /**
     * Muestra el formulario para editar un usuario.
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'id')->all();
        $userRole = $user->roles->pluck('id')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Actualiza un usuario específico en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'string',
            'email' => 'string|email|unique:users,email,'.$id,
            'password' => 'nullable|min:8|confirmed',
            'roles' => 'required'
        ]);

        $input = $request->all();

        if(!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }

        $user = User::find($id);
        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado exitosamente');
    }

    /**
     * Elimina un usuario específico de la base de datos.
     */
    public function destroy($id)
    {
        // Evitar eliminar al usuario actual
        if (auth()->id() == $id) {
            return redirect()->route('users.index')
                ->with('error', 'No puedes eliminar tu propio usuario');
        }

        User::find($id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado exitosamente');
    }
}
