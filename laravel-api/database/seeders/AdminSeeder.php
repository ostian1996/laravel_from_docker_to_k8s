<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::where('email' , 'admin@mail.com')->first()){
            
            $user = User::create([
                'name'  => 'Administrateur',
                'email'     => 'admin@mail.com',
                'password'  => bcrypt('@dmin@8080'),
                'status'   => true
            ]);
    
            $role = Role::where('name' , 'Admin')->first();
    
            $permissions = Permission::all();
    
            $role->syncPermissions($permissions);
    
            $user->assignRole($role);
        }
        $this->command->info("✔️ Admin crée avec succès.");
    }
}
