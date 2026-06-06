<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = [

            /** link permissions */
            'link.list',
            'link.create',
            'link.edit',
            'link.delete',

            /** click permissions */
            'click.list',
            'click.create',
            'click.edit',
            'click.delete',

            /** trafic permissions */
            'trafic.list',
            'trafic.create',
            'trafic.edit',
            'trafic.delete',

            /** Roles permissions */
            'role.list',
            'role.create',
            'role.edit',
            'role.delete',

            /** Users permissions */
            'user.list',
            'user.create',
            'user.edit',
            'user.delete',

        ];
        
        foreach ($permissions as $key => $permission) {
            Permission::updateOrCreate([
                'name'          => $permission,
                'guard_name'    => 'web'
            ]);
        }

        $this->command->info("✔️ Permissions insérées avec succès.");
    }
}
