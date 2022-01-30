<?php

namespace Database\Seeders;

use App\Models\IncidencesSubcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncidencesSubcategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('incidences_subcategories')->truncate(); //Vaciamos la tabla
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        $sql = file_get_contents(database_path() . '/seeders/ficheros_bd/incidences_subcategories.sql');
        DB::statement($sql);
    }
}
