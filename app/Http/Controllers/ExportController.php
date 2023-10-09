<?php

namespace App\Http\Controllers;

use App\Exports\ExamParticipantsExport;
use App\Exports\StudentTemplateExport;
use App\Http\Requests\Exam\ExamIdRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function examParticipants(ExamIdRequest $request)
    {
        $exam_id = $request->validated()['exam'];
        $file_name = 'exam-participants-' . $exam_id . '.xlsx';

        return Excel::download(new ExamParticipantsExport($exam_id), $file_name);

    }

    public function studentTemplate(Request $request)
    {
        $class_id = $request->class;
        $file_name = 'student-template.xlsx';

        return Excel::download(new StudentTemplateExport($class_id), $file_name);

    }
}
