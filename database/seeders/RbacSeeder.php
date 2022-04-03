<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RbacSeeder extends Seeder
{
    /**
     * Run RBAC seeds for the Spatie plug-in.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Regular user permissions
        Permission::create(['name' => 'create.hdf']);
        Permission::create(['name' => 'read.own.hdf']);
        Permission::create(['name' => 'update.profile']);
        Permission::create(['name' => 'read.own.profile']);
        Permission::create(['name' => 'read.own.nomination']);
        Permission::create(['name' => 'read.own.antigen_result']);
        Permission::create(['name' => 'read.own.quarantine_entry']);

        // Create regular user role and assign created permissions
        Role::create(['name' => 'regular'])->givePermissionTo(Permission::all());

        // HSO permissions
        Permission::create(['name' => 'create.nomination']);
        Permission::create(['name' => 'read.nomination']);
        Permission::create(['name' => 'update.nomination']);
        Permission::create(['name' => 'delete.nomination']);

        // Create HSO role and assign permissions + employee permissions
        Role::create(['name' => 'health-officer'])->givePermissionTo(
            array_merge(
                ['create.nomination', 'read.nomination', 'update.nomination', 'delete.nomination'],
                Role::findByName('regular')->getPermissionNames()->toArray()
            )
        );

        // Additional LSB permissions
        Permission::create(['name' => 'read.hdf']);
        Permission::create(['name' => 'read.antigen_result']);
        Permission::create(['name' => 'read.quarantine_entry']);
        Permission::create(['name' => 'read.profile']);
        Permission::create(['name' => 'read.antigen_test_eligibility']);

        // Create Security role and assign permissions + employee permissions
        Role::create(['name' => 'security'])->givePermissionTo(
            array_merge(
                ['read.nomination', 'read.hdf', 'read.antigen_result', 'read.quarantine_entry', 'read.profile', 'read.antigen_test_eligibility'],
                Role::findByName('regular')->getPermissionNames()->toArray()
            )
        );

        // Additional MDS permissions
        Permission::create(['name' => 'create.antigen_result']);
        Permission::create(['name' => 'create.quarantine_entry']);
        Permission::create(['name' => 'update.quarantine_entry']);
        Permission::create(['name' => 'delete.quarantine_entry']);

        // Create MDS role and assign permissions + employee permissions
        Role::create(['name' => 'medical'])->givePermissionTo(
            array_merge(
                ['create.antigen_result', 'read.antigen_result', 'create.quarantine_entry', 'read.quarantine_entry', 'update.quarantine_entry', 'delete.quarantine_entry'],
                Role::findByName('regular')->getPermissionNames()->toArray()
            )
        );

        // Super admin permissions
        Permission::create(['name' => 'create.user']);
        Permission::create(['name' => 'read.user']);
        Permission::create(['name' => 'update.user']);
        Permission::create(['name' => 'delete.user']);

        // Create admin user role and assign created permissions
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}
