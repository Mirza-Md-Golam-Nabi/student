<?php

namespace App\Http\Controllers;

use App\Http\Requests\Exam\ExamIdRequest;
use App\Models\ExamInfo;
use App\Models\Result;
use App\Models\StudentInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Result List";
        $create_url = "results.create";
        $create_text = "Result Create";
        $examInfos = ExamInfo::with(['className', 'subject'])
            ->where('root_id', rootId())
            ->orderBy('status', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $all_data = compact(
            'title',
            'create_url',
            'create_text',
            'examInfos',
        );

        return view('admin.result.exam-list', $all_data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ExamIdRequest $request)
    {
        $title = "Result Create";
        $exam_info = ExamInfo::with(['className', 'subject', 'smsFormat'])
            ->find($request->exam);

        $students = StudentInfo::select('id', 'name')
            ->where('root_id', rootId())
            ->where('class_id', $exam_info->class_id)
            ->get();

        $all_data = compact(
            'title',
            'exam_info',
            'students'
        );
// return response()->json($all_data);

        return view('admin.result.create', $all_data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamIdRequest $request)
    {
        $exam = $request->exam;
        $student_id = $request->student_id;
        $marks = $request->marks;

        $root_id = rootId();
        $auth_id = auth()->id();

        try {
            DB::beginTransaction();

            foreach ($student_id as $key => $value) {
                $data = [
                    'root_id' => $root_id,
                    'exam_info_id' => $exam,
                    'student_id' => $value,
                    'get_marks' => $marks[$key],
                    'updated_by' => $auth_id,
                ];

                $this->storeMarks($data);
            }

            DB::commit();
        } catch (\Throwable $th) {
            report($th);

            DB::rollback();

            session()->flash('error', 'Do not store a Student Marks Successfully.');
            return redirect()->route('results.create', compact('exam'))->withInput();
        }

        session()->flash('success', "Store a Student Marks Successfully.");
        return redirect()->route('results.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result)
    {
        $result->load(
            'student:id,name',
            'examInfo:id,name,subject_id,class_id,total_marks,exam_date',
            'examInfo.subject',
            'examInfo.className'
        );

        $title = "Result Edit";

        $all_data = compact('title', 'result');

        return view('admin.result.edit', $all_data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        $validator = Validator::make($request->all(), [
            'get_marks' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('results.edit', $result)->withErrors($validator)->withInput();
        }

        $result->fill($validator->validated());
        $result->updated_by = auth()->id();
        $result->save();

        session()->flash('success', "Result updated Successfully.");
        return redirect()->route('results.history', ['exam' => $result->exam_info_id]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        $exam = $result->exam_info_id;
        $result->delete();

        session()->flash('error', "Delete Result Successfully.");
        return redirect()->route('results.history', ['exam' => $exam]);

    }

    public function history(ExamIdRequest $request)
    {
        $title = "Result History";
        $exam_info = ExamInfo::with(['className', 'subject', 'smsFormat'])
            ->find($request->exam);

        $results = Result::with([
            'student' => function ($query) {
                $query->select('id', 'name', 'phone', 'father_name', 'mother_name', 'school_name', 'father_phone', 'mother_phone');
            },
        ])
            ->select('id', 'student_id', 'get_marks', 'got_sms')
            ->where('root_id', rootId())
            ->where('exam_info_id', $exam_info->id)
            ->orderBy('get_marks', 'desc')
            ->get();

        $all_data = compact(
            'title',
            'exam_info',
            'results'
        );

        return view('admin.result.history', $all_data);
    }

    public function storeMarks($data)
    {
        Result::updateOrCreate(
            [
                'root_id' => $data['root_id'],
                'exam_info_id' => $data['exam_info_id'],
                'student_id' => $data['student_id'],
            ],
            [
                'get_marks' => $data['get_marks'],
                'updated_by' => $data['updated_by'],
            ]
        );
    }
}
