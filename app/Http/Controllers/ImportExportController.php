<?php

namespace App\Http\Controllers;

use App\Exports\ExportProduct;
use App\Imports\ImportProduct;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{

    public function import() 
    {
        Excel::import(new ImportProduct,request()->file('file'));
           
        return back()->with('success','Products imported successfully');
    }

    public function export()
    {
        return Excel::download(new ExportProduct, 'products.xlsx');
    }
    
}
