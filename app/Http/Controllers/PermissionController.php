<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    /**
     * Constructor del controlador.
     */
    function __construct()
    {
        $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','store']]);
        $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    /**
     * Muestra la lista de permisos.
     */
    public function index(Request $request)
    {
        // Obtener todos los permisos y agruparlos por módulo
        $permissionGroups = [];
        $permissions = Permission::orderBy('name', 'ASC')->get();

        foreach ($permissions as $permission) {
            // Extraer el módulo del nombre del permiso (ej: "user-list" -> "user")
            $parts = explode('-', $permission->name);
            $module = $parts[0];

            if (!isset($permissionGroups[$module])) {
                $permissionGroups[$module] = [];
            }

            $permissionGroups[$module][] = $permission;
        }

        return view('permissions.index', compact('permissionGroups', 'permissions'));
    }

    /**
     * Muestra el formulario para crear un nuevo permiso.
     */
    public function create()
    {
        // Obtener los módulos existentes para el selector
        $modules = [];
        $permissions = Permission::orderBy('name', 'ASC')->get();

        foreach ($permissions as $permission) {
            $parts = explode('-', $permission->name);
            $module = $parts[0];

            if (!in_array($module, $modules)) {
                $modules[] = $module;
            }
        }

        sort($modules);

        return view('permissions.create', compact('modules'));
    }

    /**
     * Almacena un nuevo permiso en la base de datos.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
            'module' => 'required',
            'action' => 'required',
            'description' => 'nullable|max:255',
        ]);

        // Crear el nombre del permiso combinando módulo y acción
        $permissionName = $request->input('module') . '-' . $request->input('action');

        $permission = Permission::create([
            'name' => $permissionName,
            'description' => $request->input('description'),
            'guard_name' => 'web'
        ]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permiso creado exitosamente');
    }

    /**
     * Muestra los detalles de un permiso específico.
     */
    public function show($id)
    {
        $permission = Permission::find($id);

        // Obtener los roles que tienen este permiso
        $permissionRoles = DB::table('roles')
            ->join('role_has_permissions', 'role_has_permissions.role_id', '=', 'roles.id')
            ->where('role_has_permissions.permission_id', $id)
            ->select('roles.*')
            ->get();

        // Extraer información del permiso
        $parts = explode('-', $permission->name);
        $module = $parts[0];
        $action = isset($parts[1]) ? $parts[1] : '';

        return view('permissions.show', compact('permission', 'permissionRoles', 'module', 'action'));
    }

    /**
     * Muestra el formulario para editar un permiso.
     */
    public function edit($id)
    {
        $permission = Permission::find($id);

        // Extraer módulo y acción del nombre del permiso
        $parts = explode('-', $permission->name);
        $module = $parts[0];
        $action = isset($parts[1]) ? $parts[1] : '';

        // Obtener los módulos existentes para el selector
        $modules = [];
        $permissions = Permission::orderBy('name', 'ASC')->get();

        foreach ($permissions as $perm) {
            $parts = explode('-', $perm->name);
            $mod = $parts[0];

            if (!in_array($mod, $modules)) {
                $modules[] = $mod;
            }
        }

        sort($modules);

        return view('permissions.edit', compact('permission', 'module', 'action', 'modules'));
    }

    /**
     * Actualiza un permiso específico en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);

        $this->validate($request, [
            'module' => 'required',
            'action' => 'required',
            'description' => 'nullable|max:255',
            'name' => [
                'required',
                Rule::unique('permissions')->ignore($id),
            ],
        ]);

        // Crear el nombre del permiso combinando módulo y acción
        $permissionName = $request->input('module') . '-' . $request->input('action');

        $permission->name = $permissionName;
        $permission->description = $request->input('description');
        $permission->save();

        return redirect()->route('permissions.index')
            ->with('success', 'Permiso actualizado exitosamente');
    }

    /**
     * Elimina un permiso específico de la base de datos.
     */
    public function destroy($id)
    {
        DB::table("permissions")->where('id', $id)->delete();
        return redirect()->route('permissions.index')
            ->with('success', 'Permiso eliminado exitosamente');
    }
}
