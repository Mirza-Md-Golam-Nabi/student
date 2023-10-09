<?php

namespace App\Imports;

use App\Http\Controllers\StudentInfoController;
use App\Models\StudentInfo;
use App\Rules\PhoneNumber;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentsImport implements ToCollection,
WithHeadingRow,
SkipsEmptyRows,
WithValidation
{
    use Importable;

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $root_id = rootId();
        $auth_id = auth()->id();

        foreach ($rows as $key => $row) {

            $phone = $row['phone'];
            $father_phone = $row['father_phone'];
            $mother_phone = $row['mother_phone'];

            if ($phone == $father_phone) {
                throw new Exception("Row " . $key + 2 . "; phone and father_phone can not be equal.");
            }

            if ($father_phone == $mother_phone) {
                throw new Exception("Row " . $key + 2 . "; father_phone and mother_phone can not be equal.");
            }

            if ($mother_phone == $phone) {
                throw new Exception("Row " . $key + 2 . "; phone and mother_phone can not be equal.");
            }

            $student = StudentInfo::firstOrCreate(
                [
                    'root_id' => $root_id,
                    'phone' => $phone,
                    'class_id' => $row['class_id'],
                ],
                [
                    'name' => $row['name'],
                    'father_name' => $row['father_name'],
                    'mother_name' => $row['mother_name'],
                    'school_name' => $row['school_name'],
                    'father_phone' => $father_phone,
                    'mother_phone' => $mother_phone,
                    'status' => 1,
                    'updated_by' => $auth_id,
                ]
            );

            $validationData = [
                'root_id' => $root_id,
                'phone' => $phone,
                'father_phone' => $father_phone,
                'mother_phone' => $mother_phone,
                'student_id' => $student->id,
            ];

            $request = new Request();
            $request->merge([
                'name' => $row['name'],
                'phone' => $phone,
                'father_name' => $row['father_name'],
                'father_phone' => $father_phone,
                'mother_name' => $row['mother_name'],
                'mother_phone' => $mother_phone,
            ]);

            $student_info = new StudentInfoController();
            $validator = $student_info->uniqueUserValidation($validationData);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($phone) {
                $student_info->addStudentInUser($request, $student);
            }

            if ($father_phone) {
                $student_info->addFatherInUser($request, $student);
            }

            if ($mother_phone) {
                $student_info->addMotherInUser($request, $student);
            }

        }

    }

    public function headingRow(): int
    {
        return 1;
    }

    public function rules(): array
    {
        return [
            '*.class_id' => [
                'required',
                'integer',
            ],
            '*.name' => [
                'required',
                'string',
                'max:190',
            ],
            '*.phone' => [
                'nullable',
                'digits:11',
                new PhoneNumber,
            ],
            '*.father_name' => [
                'nullable',
                'string',
                'max:190',
            ],
            '*.father_phone' => [
                'nullable',
                'digits:11',
                new PhoneNumber,
                'different:phone',
                'different:mother_phone',
            ],
            '*.mother_name' => [
                'nullable',
                'string',
                'max:190',
            ],
            '*.mother_phone' => [
                'nullable',
                'digits:11',
                new PhoneNumber,
                'different:phone',
                'different:father_phone',
            ],
            '*.school_name' => [
                'nullable',
                'string',
                'max:190',
            ],
        ];
    }
}
