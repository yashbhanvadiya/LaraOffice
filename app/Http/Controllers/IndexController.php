<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Response;
use Excel;
use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Exports\BookExport;
use App\Imports\BookImport;

class IndexController extends Controller
{
    public function data_view()
    {
        return view('multiple_records');
    }

    public function multipleRecord()
    {      
        $query = DB::table('books')->orderBy('id');
        return DataTables::queryBuilder($query)->toJson();
    }

    // public function btn_export()
    // {
    //     $table = Book::all();
    //     $filename = "Books.csv";
    //     $handle = fopen($filename, 'w+');
    //     fputcsv($handle, array('Id', 'Book Name', 'Book Price', 'Created At', 'Updated At'));

    //     foreach($table as $row) {
    //         fputcsv($handle, array($row['id'], $row['book_name'], $row['book_price'], $row['created_at'], $row['updated_at']));
    //     }

    //     fclose($handle);

    //     $headers = array(
    //         'Content-Type' => 'text/csv',
    //     );

    //     return Response::download($filename, 'Books.csv', $headers);
    // }

    public function export() 
    {
        return Excel::download(new BookExport, 'Books Table.xlsx');
    }

    public function importUploadForm(Request $req)
    {
        Excel::import(new BookImport, $req->file);
        return redirect('/multiple_records')->with("msg", "Record are imported");
    }


}
