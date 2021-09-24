<?php

use Illuminate\Database\Seeder;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10 ; $i++) { 
            DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'quoctienphamm'.$i.'@gmail.com',
                'username' => 'quoctienphamm1'.$i,
                'level' => 'user',
                'fullname' => 'Phạm Tiến'.$i,
                'password' => Hash::make('123456'),
            ]);
        }
        
    }
}
