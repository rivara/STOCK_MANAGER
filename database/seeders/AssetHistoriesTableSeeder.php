<?php

namespace Database\Seeders;

use App\Models\AssetsHistory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetHistoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('assets_histories')->truncate(); //Vaciamos la tabla
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); 

        $sql = file_get_contents(database_path() . '/seeders/ficheros_bd/assets_histories.sql');
       
        DB::statement($sql);
    }
}
