<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear rol de Super Admin con todos los permisos
        $role = Role::create(['name' => 'Super Admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $this->command->info('Rol de Super Admin creado con todos los permisos.');

        // Crear rol de Admin con permisos específicos
        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::whereIn('name', [
            'user-list', 'user-create', 'user-edit',
            'role-list', 'role-create', 'role-edit',
            'dashboard-access', 'reports-view'
        ])->pluck('id', 'id');
        $role->syncPermissions($permissions);
        $this->command->info('Rol de Admin creado con permisos específicos.');

        // Crear rol de Editor con permisos limitados
        $role = Role::create(['name' => 'Editor']);
        $permissions = Permission::whereIn('name', [
            'user-list', 'dashboard-access', 'reports-view'
        ])->pluck('id', 'id');
        $role->syncPermissions($permissions);
        $this->command->info('Rol de Editor creado con permisos limitados.');

        // Crear rol de Usuario con permisos básicos
        $role = Role::create(['name' => 'Usuario']);
        $permissions = Permission::whereIn('name', [
            'dashboard-access'
        ])->pluck('id', 'id');
        $role->syncPermissions($permissions);
        $this->command->info('Rol de Usuario creado con permisos básicos.');
    }
}
