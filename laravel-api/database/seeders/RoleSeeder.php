<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Role::count() == 0){

            $roles = [
                'Admin',
                'Superviseur',
                'Utilisateur'
            ];

            foreach ($roles as $key => $role) {
                Role::firstOrCreate([
                    'name'          => $role ,
                    'guard_name'    => 'web'
                ]);
            }
            
        }
        $this->command->info("✔️ Roles insérés avec succès.");
    }
}
