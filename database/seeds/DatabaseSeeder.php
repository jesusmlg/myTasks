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
            'name' => 'Jesús María Luis Gil',
            'email' => 'jluis@joca.es',
            'password' => bcrypt('123456'),
        ]);

        factory(App\Task::class, 50)->create();
    
    }
}
