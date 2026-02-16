<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
  use App\Exports\InterviewsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

  

// ... inside your Controller class ...

public function exportExcel(Request $request) 
{
    return Excel::download(new InterviewsExport($request->status), 'interviews.xlsx');
}

use AuthorizesRequests, ValidatesRequests;
    
    // If you have defined exportPdf here as well, ensure the hint is correct:
    public function exportPdf(Request $request) 
    {
        // ...
    }
    
}
