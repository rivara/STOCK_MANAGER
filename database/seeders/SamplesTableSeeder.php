<?php

namespace Database\Seeders;

use App\Models\Sample;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SamplesTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('samples')->truncate(); //Vaciamos la tabla
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $sql = file_get_contents(database_path() . '/seeders/ficheros_bd/samples.sql');
       
        DB::statement($sql);    }
}
