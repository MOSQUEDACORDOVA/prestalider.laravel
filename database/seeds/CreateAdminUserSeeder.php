<?php



use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear usuario Super Admin
        $superAdmin = User::create([
            'name' => 'Super Administrador',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password123')
        ]);
        $superAdmin->assignRole('Super Admin');
        $this->command->info('Usuario Super Admin creado con éxito.');

        // Crear usuario Admin
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123')
        ]);
        $admin->assignRole('Admin');
        $this->command->info('Usuario Admin creado con éxito.');

        // Crear usuario Editor
        $editor = User::create([
            'name' => 'Editor',
            'email' => 'editor@example.com',
            'password' => Hash::make('password123')
        ]);
        $editor->assignRole('Editor');
        $this->command->info('Usuario Editor creado con éxito.');

        // Crear usuario normal
        $user = User::create([
            'name' => 'Usuario Normal',
            'email' => 'usuario@example.com',
            'password' => Hash::make('password123')
        ]);
        $user->assignRole('Usuario');
        $this->command->info('Usuario Normal creado con éxito.');
    }
}
