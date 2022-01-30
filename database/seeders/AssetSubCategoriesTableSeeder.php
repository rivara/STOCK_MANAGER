<?php

namespace Database\Seeders;

use App\Models\AssetSubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetSubCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('asset_sub_categories')->truncate(); //Vaciamos la tabla
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); 

        $sql = file_get_contents(database_path() . '/seeders/ficheros_bd/assets_sub_categories.sql');
       
        DB::statement($sql);
    }
}
