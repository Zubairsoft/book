<?php

namespace Database\Factories;

use App\Models\Book;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{

    protected $model=Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //

            'book_name'=>$this->faker->name(),
            'description'=>$this->faker->paragraph(5)
        ];
    }
}
