<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User();
        $user->name = "Administrador";        
        $user->email = "admin@temp.com";                
        $user->password = bcrypt("sistemas");        
        $user->save();
    }
}
