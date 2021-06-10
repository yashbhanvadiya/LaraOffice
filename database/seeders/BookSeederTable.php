<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Seeder;

class BookSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('books')->insert([
        //     'book_name' => 'PHP',
        //     'book_price' => 400,
        // ]);
        \App\Models\Book::factory(1000)->create();
    }
}
