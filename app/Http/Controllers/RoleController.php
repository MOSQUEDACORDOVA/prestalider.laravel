<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Constructor del controlador.
     */
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Muestra la lista de roles.
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(10);
        return view('roles.index', compact('roles'));
    }

    /**
     * Muestra el formulario para crear un nuevo rol.
     */
    public function create()
    {
        // Obtener todos los permisos y agruparlos por módulo
        $permissionGroups = [];
        $permissions = Permission::get();

        foreach ($permissions as $permission) {
            // Extraer el módulo del nombre del permiso (ej: "user-list" -> "user")
            $parts = explode('-', $permission->name);
            $module = $parts[0];

            if (!isset($permissionGroups[$module])) {
                $permissionGroups[$module] = [];
            }

            $permissionGroups[$module][] = $permission;
        }

        return view('roles.create', compact('permissionGroups'));
    }

    /**
     * Almacena un nuevo rol en la base de datos.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'nullable|array',
        ]);

        $role = Role::create(['name' => $request->input('name')]);

        if ($request->has('permission')) {
            $role->syncPermissions($request->input('permission'));
        }

        return redirect()->route('roles.index')
            ->with('success', 'Rol creado exitosamente');
    }

    /**
     * Muestra los detalles de un rol específico.
     */
    public function show($id)
    {
        $role = Role::find($id);

        // Obtener los permisos asignados al rol
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        // Agrupar permisos por módulo
        $permissionGroups = [];
        foreach ($rolePermissions as $permission) {
            $parts = explode('-', $permission->name);
            $module = $parts[0];

            if (!isset($permissionGroups[$module])) {
                $permissionGroups[$module] = [];
            }

            $permissionGroups[$module][] = $permission;
        }

        // Obtener usuarios con este rol
        $roleUsers = DB::table('users')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->where('model_has_roles.role_id', $id)
            ->select('users.*')
            ->get();

        return view('roles.show', compact('role', 'rolePermissions', 'permissionGroups', 'roleUsers'));
    }

    /**
     * Muestra el formulario para editar un rol.
     */
    public function edit($id)
    {
        $role = Role::find($id);

        // Obtener todos los permisos y agruparlos por módulo
        $permissionGroups = [];
        $permissions = Permission::get();

        foreach ($permissions as $permission) {
            $parts = explode('-', $permission->name);
            $module = $parts[0];

            if (!isset($permissionGroups[$module])) {
                $permissionGroups[$module] = [];
            }

            $permissionGroups[$module][] = $permission;
        }

        // Obtener los IDs de los permisos asignados al rol
        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('roles.edit', compact('role', 'permissionGroups', 'rolePermissions'));
    }

    /**
     * Actualiza un rol específico en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$id,
            'permission' => 'nullable|array',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        // Sincronizar permisos
        if ($request->has('permission')) {
            $role->syncPermissions($request->input('permission'));
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('roles.index')
            ->with('success', 'Rol actualizado exitosamente');
    }

    /**
     * Elimina un rol específico de la base de datos.
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Rol eliminado exitosamente');
    }
}
