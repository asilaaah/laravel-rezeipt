<?php

namespace App\Http\Controllers;

use App\Exports\ExportProduct;
use App\Imports\ImportProduct;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{

    public function import(Request $request) 
    {
        $extensions = array("xls","xlsx","xlm","xla","xlc","xlt","xlw");

        $result = array($request->file('file')->getClientOriginalExtension());

        if(in_array($result[0],$extensions)){
            Excel::import(new ImportProduct,$request->file('file'));
            return back()->with('success','Products imported successfully');
        }else{
            return back()->with('error','The selected file is not of the required type');
        }
        
    }

    public function export()
    {
        return Excel::download(new ExportProduct, 'products.xlsx');
    }
    
}
