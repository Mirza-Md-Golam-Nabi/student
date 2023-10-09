<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkImportMarksRequest;
use App\Http\Requests\ImportExcelFileRequest;
use App\Imports\ExamMarksImport;
use App\Imports\StudentsImport;
use Exception;
use Maatwebsite\Excel\Validators\ValidationException;

class ImportController extends Controller
{
    public function examParticipantsMarks(BulkImportMarksRequest $request)
    {
        $file = $request->file('file');
        $exam_id = $request->exam;
        $error_msg = null;

        try {
            $import = new ExamMarksImport($exam_id);
            $import->import($file);
            session()->flash('success', 'Student Result added successfully.');

        } catch (ValidationException $e) {
            $errors = $e->failures();
            $row = $errors[0]->row();
            $error = $errors[0]->errors()[0];
            $attribute = $errors[0]->attribute();
            $value = $errors[0]->values()[$attribute];

            $error_msg = "Row " . $row . "; " . $error . " Given, " . $value;

        } catch (Exception $e) {
            $error_msg = $e->getMessage();
        }

        if ($error_msg) {
            session()->flash('error', $error_msg);
        }

        return redirect()->route('results.history', ['exam' => $exam_id]);

    }

    public function students(ImportExcelFileRequest $request)
    {
        $file = $request->file('file');
        $error_msg = null;

        try {
            $import = new StudentsImport();
            $import->import($file);
            session()->flash('success', 'Student added successfully.');

        } catch (ValidationException $e) {
            $errors = $e->failures();
            $row = $errors[0]->row();
            $error = $errors[0]->errors()[0];
            $attribute = $errors[0]->attribute();
            $value = $errors[0]->values()[$attribute];

            $error_msg = "Row " . $row . "; " . $error . " Given, " . $value;

        } catch (Exception $e) {
            $error_msg = $e->getMessage();
        }

        if ($error_msg) {
            session()->flash('error', $error_msg);
        }

        return redirect()->back();

    }

}
