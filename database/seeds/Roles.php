<?php

use App\Role;
use Illuminate\Database\Seeder;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Role();
        $user->name         = 'user';
        $user->display_name = 'Користувач'; // optional
        $user->description  = 'Користувач електроної бази коледжа'; // optional
        $user->save();

        $moder = new Role();
        $moder->name         = 'moder';
        $moder->display_name = 'Модератор'; // optional
        $moder->description  = 'Модератр електроної бази коледжа'; // optional
        $moder->save();

        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'Адміністратор'; // optional
        $admin->description  = 'Адміністратор електроної бази коледжа'; // optional
        $admin->save();
    }
}
