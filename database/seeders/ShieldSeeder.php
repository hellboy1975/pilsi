<?php

namespace Database\Seeders;

use BezhanSalleh\FilamentShield\Support\Utils;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_attempt","view_any_attempt","create_attempt","update_attempt","restore_attempt","restore_any_attempt","replicate_attempt","reorder_attempt","delete_attempt","delete_any_attempt","force_delete_attempt","force_delete_any_attempt","view_cave","view_any_cave","create_cave","update_cave","restore_cave","restore_any_cave","replicate_cave","reorder_cave","delete_cave","delete_any_cave","force_delete_cave","force_delete_any_cave","view_club","view_any_club","create_club","update_club","restore_club","restore_any_club","replicate_club","reorder_club","delete_club","delete_any_club","force_delete_club","force_delete_any_club","view_region","view_any_region","create_region","update_region","restore_region","restore_any_region","replicate_region","reorder_region","delete_region","delete_any_region","force_delete_region","force_delete_any_region","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_squeeze","view_any_squeeze","create_squeeze","update_squeeze","restore_squeeze","restore_any_squeeze","replicate_squeeze","reorder_squeeze","delete_squeeze","delete_any_squeeze","force_delete_squeeze","force_delete_any_squeeze","view_trip","view_any_trip","create_trip","update_trip","restore_trip","restore_any_trip","replicate_trip","reorder_trip","delete_trip","delete_any_trip","force_delete_trip","force_delete_any_trip","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","view_visit","view_any_visit","create_visit","update_visit","restore_visit","restore_any_visit","replicate_visit","reorder_visit","delete_visit","delete_any_visit","force_delete_visit","force_delete_any_visit","page_MyProfilePage","widget_GravatarOverview","widget_LatestCaves","widget_LatestSqueezeAttempts","widget_LatestSqueezes","widget_LatestUsers"]},{"name":"Moderator","guard_name":"web","permissions":["view_attempt","view_any_attempt","create_attempt","update_attempt","restore_attempt","restore_any_attempt","replicate_attempt","reorder_attempt","delete_attempt","delete_any_attempt","force_delete_attempt","force_delete_any_attempt","view_cave","view_any_cave","create_cave","update_cave","restore_cave","restore_any_cave","replicate_cave","reorder_cave","delete_cave","delete_any_cave","force_delete_cave","force_delete_any_cave","view_club","view_any_club","create_club","update_club","restore_club","restore_any_club","replicate_club","reorder_club","delete_club","delete_any_club","force_delete_club","force_delete_any_club","view_squeeze","view_any_squeeze","create_squeeze","update_squeeze","restore_squeeze","restore_any_squeeze","replicate_squeeze","reorder_squeeze","delete_squeeze","delete_any_squeeze","force_delete_squeeze","force_delete_any_squeeze","view_trip","view_any_trip","create_trip","update_trip","restore_trip","restore_any_trip","replicate_trip","reorder_trip","delete_trip","delete_any_trip","force_delete_trip","force_delete_any_trip","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","view_visit","view_any_visit","create_visit","update_visit","restore_visit","restore_any_visit","replicate_visit","reorder_visit","delete_visit","delete_any_visit","force_delete_visit","force_delete_any_visit","page_MyProfilePage","widget_GravatarOverview","widget_LatestCaves","widget_LatestSqueezeAttempts","widget_LatestSqueezes","widget_LatestUsers"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
