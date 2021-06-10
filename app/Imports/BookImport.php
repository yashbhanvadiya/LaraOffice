<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; 

class BookImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Book([
            'id'=>$row['0'],
            'book_name'=>$row['1'],
            'book_price'=>$row['2'],
            'created_at'=>$row['3'],
            'updated_at'=>$row['4']
        ]);
    }
}
