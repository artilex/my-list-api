<?php

use Illuminate\Database\Seeder;
use User\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        factory(User::class)->create([
            'id'        => 1,
            'email'     => 'test@gmail.com',
            'password'  => 'secret123',
        ]);

        factory(User::class)->create(            [
            'id'        => 2,
            'email'     => 'guest@gmail.com',
            'password'  => 'guest123',
        ]);
    }
}
