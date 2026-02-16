<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interview;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ResultsExport;

class AdminResultController extends Controller
{
    /**
     * Results Page
     */
    public function index(Request $request)
    {
        $query = Interview::with([
            'candidate',
            'interviewer',
            'feedback'
        ])->where('status', 'completed');

        // Filter by candidate status
        if ($request->status) {
            $query->whereHas('candidate', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        $interviews = $query->latest()->get();

        return view('admin.results', compact('interviews'));
    }

    /**
     * Export PDF
     */
    public function exportPdf(Request $request)
    {
        $query = Interview::with(['candidate','interviewer','feedback'])
            ->where('status','completed');

        if ($request->status) {
            $query->whereHas('candidate', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        $interviews = $query->get();

        $pdf = Pdf::loadView('admin.results-pdf', compact('interviews'));

        return $pdf->download('final-results.pdf');
    }

    /**
     * Export Excel
     */
    public function exportExcel(Request $request)
    {
        return Excel::download(
            new ResultsExport($request->status),
            'final-results.xlsx'
        );
    }
}
