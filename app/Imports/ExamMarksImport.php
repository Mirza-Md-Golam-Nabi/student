<?php

namespace App\Imports;

use App\Http\Controllers\ResultController;
use App\Models\ExamInfo;
use App\Models\StudentInfo;
use Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ExamMarksImport implements ToCollection,
WithHeadingRow,
SkipsEmptyRows,
WithValidation
{
    use Importable;

    private $exam_id;

    public function __construct($exam_id)
    {
        $this->exam_id = $exam_id;
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $result = new ResultController;
        $root_id = rootId();
        $auth_id = auth()->id();
        $class_id = ExamInfo::find($this->exam_id)->class_id;

        $students = StudentInfo::where('class_id', $class_id)
            ->where('status', 1)
            ->pluck('id')
            ->toArray();

        foreach ($rows as $key => $row) {

            if ($this->exam_id != $row['exam_id']) {
                // Error at row ##; Exam ID is not correct.
                throw new Exception('Error at row ' . ($key + 2) . '; Exam ID is not correct.', 400);
            }

            if (!in_array($row['student_id'], $students)) {
                // Error at row ##; Student ID do not match.
                throw new Exception('Error at row ' . ($key + 2) . '; Student ID do not match.', 400);
            }

            $data = [
                'root_id' => $root_id,
                'exam_info_id' => $row['exam_id'],
                'student_id' => $row['student_id'],
                'get_marks' => $row['marks'],
                'updated_by' => $auth_id,
            ];

            $result->storeMarks($data);

        }
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function rules(): array
    {
        return [
            '*.exam_id' => [
                'required',
                'integer',
            ],
            '*.student_id' => [
                'required',
                'integer',
            ],
            '*.marks' => [
                'required',
                'numeric',
            ],
        ];
    }
}
