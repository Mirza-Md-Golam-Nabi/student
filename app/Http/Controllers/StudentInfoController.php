<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StudentInfoRequest;
use App\Models\StudentInfo;
use App\Models\User;
use App\Traits\ClassTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StudentInfoController extends Controller
{
    use ClassTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Student List";
        $create_url = "students.create";
        $create_text = "Student Create";
        $students = StudentInfo::where('root_id', rootId())
            ->orderBy('status', 'desc')
            ->orderBy('name', 'asc')
            ->get();

        $all_data = compact(
            'title',
            'create_url',
            'create_text',
            'students',
        );

        return view('admin.student.list', $all_data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Student Create";
        $classes = $this->classes();

        $all_data = compact(
            'title',
            'classes'
        );

        return view('admin.student.create', $all_data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentInfoRequest $request)
    {
        try {
            DB::beginTransaction();

            $student = StudentInfo::create(
                $request->validated()
            );

            $validationData = [
                'root_id' => $request->root_id,
                'phone' => $request->phone,
                'guardian_phone' => $request->guardian_phone,
                'student_id' => $student->id,
            ];

            $validator = Validator::make($validationData, [
                'phone' => [
                    'required',
                    Rule::unique('users')->where(function ($query) use ($validationData) {
                        return $query->where('parent_id', $validationData['root_id'])
                            ->where('phone', $validationData['guardian_phone'])
                            ->where('student_id', $validationData['student_id'])
                            ->where('status', 1);
                    }),
                ],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($request->phone) {
                User::create([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'parent_id' => rootId(),
                    'student_id' => $student->id,
                    'user_type_id' => 5,
                    'password' => Hash::make(12345),
                ]);
            }

            if ($request->guardian_phone) {
                User::create([
                    'name' => $request->father_name ?? $request->mother_name ?? '',
                    'phone' => $request->guardian_phone,
                    'parent_id' => rootId(),
                    'student_id' => $student->id,
                    'user_type_id' => 4,
                    'password' => Hash::make(12345),
                ]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            report($th);

            DB::rollback();

            session()->flash('error', 'Do not add a Student Successfully.');
            return redirect()->route('students.create')->withInput();
        }

        session()->flash('success', "Add a Student Successfully.");
        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentInfo $student)
    {
        $student->load('className');

        $title = "Student Details";

        $all_data = compact(
            'title',
            'student'
        );

        return view('admin.student.show', $all_data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentInfo $student)
    {
        $student->load('className');

        $title = "Student Edit";
        $classes = $this->classes();

        $all_data = compact('title', 'student', 'classes');

        return view('admin.student.edit', $all_data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentInfoRequest $request, StudentInfo $student)
    {
        $validationData = [
            'root_id' => $request->root_id,
            'phone' => $request->phone,
            'guardian_phone' => $request->guardian_phone,
            'student_id' => $student->id,
        ];

        $validator = Validator::make($validationData, [
            'phone' => [
                'required',
                Rule::unique('users')->where(function ($query) use ($validationData) {
                    return $query->where('parent_id', $validationData['root_id'])
                        ->where('phone', $validationData['guardian_phone'])
                        ->where('student_id', $validationData['student_id'])
                        ->where('status', 1);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->route('students.create')->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $student->fill($request->validated());
            $student->save();

            if ($request->phone) {
                User::updateOrCreate(
                    ['phone' => $request->phone],
                    [
                        'name' => $request->name,
                        'parent_id' => rootId(),
                        'student_id' => $student->id,
                        'user_type_id' => 5,
                        'password' => Hash::make(12345),
                    ]
                );
            }

            if ($request->guardian_phone) {
                User::updateOrCreate(
                    ['phone' => $request->guardian_phone],
                    [
                        'name' => $request->father_name ?? $request->mother_name,
                        'parent_id' => rootId(),
                        'student_id' => $student->id,
                        'user_type_id' => 4,
                        'password' => Hash::make(12345),
                    ]
                );
            }

            DB::commit();
        } catch (\Throwable $th) {
            report($th);

            DB::rollback();

            session()->flash('error', 'Student does not update Successfully.');
            return redirect()->route('students.edit', $student)->withInput();
        }

        session()->flash('success', "Student's data update Successfully.");
        return redirect()->route('students.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentInfo $studentInfo)
    {
        //
    }
}
