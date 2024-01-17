<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        $jefeDocumentacion = Role::create(['name' => 'jefe_documentacion']); // ibeth
        Role::create(['name' => 'jefe']);
        Role::create(['name' => 'alumno']);

        Permission::create([
            'name' => 'ver estadisticas'
        ]);

        Permission::create([
            'name' => 'configurar'
        ]);

        $jefeDocumentacion->givePermissionTo(['ver estadisticas','configurar']);
    }
}
