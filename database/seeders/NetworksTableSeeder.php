<?php

namespace Database\Seeders;

use App\Models\Network;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NetworksTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('networks')->truncate(); //Vaciamos la tabla
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); 

        $sql = file_get_contents(database_path() . '/seeders/ficheros_bd/networks.sql');
       
        DB::statement($sql);
    }
}
