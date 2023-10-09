<?php

namespace App\Http\Controllers;

use App\Models\ExamInfo;
use App\Models\Result;
use App\Traits\PdfTrait;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    use PdfTrait;

    public function examResults(Request $request)
    {
        $pdf = $this->banglaPDF();

        $exam_info = ExamInfo::with(['className', 'subject'])
            ->find($request->exam);

        $results = Result::with([
            'student' => function ($query) {
                $query->select('id', 'name', 'phone', 'father_name', 'mother_name', 'school_name', 'father_phone', 'mother_phone');
            },
        ])
            ->select('id', 'student_id', 'get_marks')
            ->where('root_id', rootId())
            ->where('exam_info_id', $exam_info->id)
            ->orderBy('get_marks', 'desc')
            ->get();

        $data = compact(
            'exam_info',
            'results'
        );

        $pdf->WriteHTML(view('pdf.exam-result')->with($data));

        return $pdf->Output('test.pdf', 'I'); // "I" for string output

    }
}
