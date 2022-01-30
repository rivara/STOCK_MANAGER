<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvincesTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('provinces')->truncate(); //Vaciamos la tabla
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        $sql = file_get_contents(database_path() . '/seeders/ficheros_bd/provinces.sql');
        DB::statement($sql);
    }
}
