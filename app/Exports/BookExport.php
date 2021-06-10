<?php

namespace App\Exports;

use App\User;
use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;

class BookExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Book::all();
    }
}
