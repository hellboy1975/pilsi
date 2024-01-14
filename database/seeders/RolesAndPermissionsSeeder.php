<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{

    public function processModels(array $models): void
    {
        foreach ($models as $model) {
            Permission::create(['name' => "create $model"]);
            Permission::create(['name' => "edit $model"]);
            Permission::create(['name' => "delete $model"]);
        }
    }

    public function givePermissions(Role $role, array $models): void 
    {
        foreach ($models as $model) {
            $role->givePermissionTo("create $model", "edit $model", "delete $model");
        }
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // these models are the core features a user would need to use PiLSi
        $userModels = ['Visits', 'Attempts'];
        $this->processModels($userModels);
        
        // these models are ones which many user can access, and therefore may need a little more moderation
        $moderatorModels = ['Caves', 'Trips', 'Clubs', 'Regions', 'Squeezes'];
        $this->processModels($moderatorModels);

        $adminModels = ['Users', 'Posts'];
        $this->processModels($adminModels);
        
        // create Roles
        $superRole = Role::create(['name' => 'Super Admin']);
        $superRole->givePermissionTo(Permission::all());

        $moderatorRole = Role::create(['name' => 'Moderator']);
        $this->givePermissions($moderatorRole, $userModels);
        $this->givePermissions($moderatorRole, $moderatorModels);

        $userRole = Role::create(['name' => 'User']);
        $this->givePermissions($userRole, $userModels);
    }
}
