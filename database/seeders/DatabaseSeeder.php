<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ProvincesTableSeeder::class,
            MunicipalitiesTableSeeder::class,
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            AssetStatusTableSeeder::class,
            TaskStatusTableSeeder::class,
            AreasTableSeeder::class,
            CalculationsTableSeeder::class,
            UnitsTableSeeder::class,
            TechniquesTableSeeder::class,
            MagnitudesTableSeeder::class,
            MarksTableSeeder::class,
            SamplesTableSeeder::class,
            PeriodsTableSeeder::class,
            NetworksTableSeeder::class,
            ZonesTableSeeder::class,
            AssetCategoriesTableSeeder::class,
            AssetSubCategoriesTableSeeder::class,
            AssetLocationsTableSeeder::class,
            AssetTableSeeder::class,
			ParametersTableSeeder::class,
            AssetHistoriesTableSeeder::class,
            IncidencesCategoriesTableSeeder::class,
            IncidencesSubCategoriesTableSeeder::class,
            TaskTagsTableSeeder::class,
            /*TaskTableSeeder::class,
			TaskTableSeeder1::class,
			TaskTableSeeder2::class,
			TaskTableSeeder3::class,
			TaskTableSeeder4::class,
			TaskTableSeeder5::class,
			TaskTableSeeder6::class,
			TaskTableSeeder7::class,
			TaskTableSeeder8::class,
			TaskTableSeeder9::class,
			TaskTableSeeder10::class,
			TaskTableSeeder11::class,
            TaskTaskTagsTableSeeder::class,*/
        ]);
    }
}
