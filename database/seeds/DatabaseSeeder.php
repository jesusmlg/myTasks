<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'User number 1',
            'email' => 'user1@user.es',
            'password' => bcrypt('123456'),
        ]);

        factory(App\Task::class, 50)->create();
    
    }
}
