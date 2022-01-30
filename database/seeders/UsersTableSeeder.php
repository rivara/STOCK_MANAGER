<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('users')->truncate(); //Vaciamos la tabla
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); 

        $sql = file_get_contents(database_path() . '/seeders/ficheros_bd/users.sql');
       
        DB::statement($sql);
    }
}
