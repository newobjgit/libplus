<?php

use App\Permission;
use Illuminate\Database\Seeder;

class Permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createBook = new Permission();
        $createBook->name         = 'добавити';
        $createBook->display_name = 'Добавити літературу'; // optional.
        $createBook->description  = 'Добавить новую литературу'; // optional
        $createBook->save();

        $editBook = new Permission();
        $editBook->name         = 'редактировать';
        $editBook->display_name = 'Редагувати літературу'; // optional.
        $editBook->description  = 'Редактировать литературу'; // optional
        $editBook->save();

        $deleteBook = new Permission();
        $deleteBook->name         = 'видалити';
        $deleteBook->display_name = 'Видалити літературу'; // optional.
        $deleteBook->description  = 'Удалить литературу'; // optional
        $deleteBook->save();

        $createModer = new Permission();
        $createModer->name         = 'добавить модератора';
        $createModer->display_name = 'Добавити модератора'; // optional
        $createModer->description  = 'Добавить модератора'; // optional
        $createModer->save();
    }
}
