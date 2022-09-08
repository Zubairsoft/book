<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user=User::get();
        $books=Book::factory(5)->make()->each(function($book) use($user){
            $book->user_id=$user->random()->id;
        });
    }
}
