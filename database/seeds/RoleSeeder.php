<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Root Role
        $rootRole = new Role(
            [
                'name' => 'root',
                'display_name' => 'Root',
                'description' => 'Root role with access to everything',
            ]
        );
        $rootRole->save();
        $rootRole->users()->attach(1);
        // Web Project Manager Role
        $webProjectManagerRole = new Role(
            [
                'name' => 'web_project_manager',
                'display_name' => 'Web Project Manager',
                'description' => 'Project manager in the web department',
            ]
        );
        $webProjectManagerRole->save();
        $webProjectManagerRole->users()->attach(2);
        // Web Developer Role
        $webDeveloperRole = new Role(
            [
                'name' => 'web_developer',
                'display_name' => 'Web Developer',
                'description' => 'Developer in the web department',
            ]
        );
        $webDeveloperRole->save();
        $webDeveloperRole->users()->attach([3, 4, 5, 6]);
        // Sales Manager Role
        $salesManagerRole = new Role(
            [
                'name' => 'sales_manager',
                'display_name' => 'Sales Manager',
                'description' => 'Manager in the sales departmentRoot role with access to everything',
            ]
        );
        $salesManagerRole->save();
        $salesManagerRole->users()->attach(7);
        // Sales Associate Role
        $salesAssociateRole = new Role(
            [
                'name' => 'sales_associate',
                'display_name' => 'Sales Associate',
                'description' => 'Person in the sales department',
            ]
        );
        $salesAssociateRole->save();
        $salesAssociateRole->users()->attach(8);
        // Finance Manager Role
        $financeManagerRole = new Role(
            [
                'name' => 'finance_manager',
                'display_name' => 'Finance Manager',
                'description' => 'Manager in the finance department',
            ]
        );
        $financeManagerRole->save();
        $financeManagerRole->users()->attach(9);
        // Finance Associate Role
        $financeAssociateRole = new Role(
            [
                'name' => 'finance_associate',
                'display_name' => 'Finance Associate',
                'description' => 'Person in the finance department',
            ]
        );
        $financeAssociateRole->save();
        $financeAssociateRole->users()->attach(10);
        // Warehouse Manager Role
        $warehouseManagerRole = new Role(
            [
                'name' => 'warehouse_manager',
                'display_name' => 'Warehouse Manager',
                'description' => 'Manger in the warehouse department',
            ]
        );
        $warehouseManagerRole->save();
        $warehouseManagerRole->users()->attach(11);
        // Warehouse Associate Role
        $warehouseAssociateRole = new Role(
            [
                'name' => 'warehouse_associate',
                'display_name' => 'Warehouse Associate',
                'description' => 'Person in the warehouse department',
            ]
        );
        $warehouseAssociateRole->save();
        $warehouseAssociateRole->users()->attach(12);
    }
}
