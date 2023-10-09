<?php

namespace App\Exports;

use App\Models\ExamInfo;
use App\Models\StudentInfo;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExamParticipantsExport implements FromCollection,
WithHeadings
{
    protected $exam_id;

    public function __construct($exam_id)
    {
        $this->exam_id = $exam_id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $class_id = ExamInfo::find($this->exam_id)->class_id;

        $students = StudentInfo::select(DB::raw("$this->exam_id as exam_id"), 'id', 'name')
            ->where('class_id', $class_id)
            ->where('status', 1)
            ->get();

        return $students;
    }

    public function headings(): array
    {
        return [
            'exam id',
            'student id',
            'student name',
            'marks',
        ];
    }
}
