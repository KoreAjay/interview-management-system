<?php
namespace App\Exports;

use App\Models\Interview;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InterviewsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $status;

    public function __construct($status = null) {
        $this->status = $status;
    }

    public function collection() {
        return Interview::with(['candidate', 'interviewer', 'feedback'])
            ->when($this->status, function ($query) {
                $query->whereHas('candidate', fn($q) => $q->where('status', $this->status));
            })->get();
    }

    public function headings(): array {
        return ['Candidate Name', 'Email', 'Outcome', 'Interviewer', 'Rating', 'Feedback'];
    }

    public function map($interview): array {
        return [
            $interview->candidate->name,
            $interview->candidate->email,
            ucfirst($interview->candidate->status),
            $interview->interviewer->name ?? 'N/A',
            $interview->feedback->rating ?? '0',
            $interview->feedback->comments ?? '',
        ];
    }
}