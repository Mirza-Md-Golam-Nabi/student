<?php

namespace App\Http\Controllers;

use App\Http\Requests\Classes\ClassIdRequest;
use App\Http\Requests\Student\StudentInfoRequest;
use App\Models\StudentInfo;
use App\Models\User;
use App\Traits\ClassTrait;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
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
    public function index(ClassIdRequest $request)
    {
        $title = "Student List";
        $class_id = $request->class;
        $create_url = "students.create";
        $create_text = "Student Create";

        $param = [
            'class' => $class_id,
        ];

        $students = StudentInfo::where('root_id', rootId())
            ->where('class_id', $class_id)
            ->where('status', 1)
            ->orderBy('status', 'desc')
            ->orderBy('name', 'asc')
            ->get();

        $all_data = compact(
            'title',
            'class_id',
            'create_url',
            'create_text',
            'param',
            'students',
        );

        return view('admin.student.list', $all_data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ClassIdRequest $request)
    {
        $title = "Student Create";
        $class_id = $request->class;
        $classes = $this->classes();

        $all_data = compact(
            'title',
            'class_id',
            'classes',
        );

        return view('admin.student.create', $all_data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentInfoRequest $request)
    {
        $class_id = $request->class_id;
        $root_id = $request->root_id;
        $phone = $request->phone;
        $father_phone = $request->father_phone;
        $mother_phone = $request->mother_phone;

        try {
            DB::beginTransaction();

            $student = StudentInfo::firstOrCreate(
                [
                    'root_id' => $root_id,
                    'phone' => $phone,
                    'class_id' => $class_id,
                ],
                [
                    'name' => $request->name,
                    'father_name' => $request->father_name,
                    'mother_name' => $request->mother_name,
                    'school_name' => $request->school_name,
                    'father_phone' => $father_phone,
                    'mother_phone' => $mother_phone,
                    'status' => 1,
                    'updated_by' => $request->updated_by,
                ]
            );

            $validationData = [
                'root_id' => $root_id,
                'phone' => $phone,
                'father_phone' => $father_phone,
                'mother_phone' => $mother_phone,
                'student_id' => $student->id,
            ];

            $validator = $this->uniqueUserValidation($validationData);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($request->phone) {
                $this->addStudentInUser($request, $student);
            }

            if ($request->father_phone) {
                $this->addFatherInUser($request, $student);
            }

            if ($request->mother_phone) {
                $this->addMotherInUser($request, $student);
            }

            DB::commit();
        } catch (\Throwable $th) {
            report($th);

            DB::rollback();

            session()->flash('error', 'Do not add a Student Successfully.');
            return redirect()->route('students.create', ['class' => $class_id])->withInput();
        }

        session()->flash('success', "Add a Student Successfully.");
        return redirect()->route('students.index', ['class' => $class_id]);
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
            'father_phone' => $request->father_phone,
            'mother_phone' => $request->mother_phone,
            'student_id' => $student->id,
        ];

        $validator = $this->uniqueUserValidation($validationData);

        if ($validator->fails()) {
            return redirect()->route('students.create')->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $student->fill($request->validated());
            $student->save();

            if ($request->phone) {
                $this->addStudentInUser($request, $student);
            }

            if ($request->father_phone) {
                $this->addFatherInUser($request, $student);
            }

            if ($request->mother_phone) {
                $this->addMotherInUser($request, $student);
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

    public function classList()
    {
        $title = 'Class List';
        $classes = $this->classes();

        return view('admin.student.class-list', compact('title', 'classes'));
    }

    public function uniqueUserValidation(array $validationData)
    {
        return Validator::make($validationData, [
            'phone' => [
                'required',
                Rule::unique('users')->where(function ($query) use ($validationData) {
                    return $query->where('parent_id', $validationData['root_id'])
                        ->where(function (Builder $query) use ($validationData) {
                            $query->where('phone', $validationData['father_phone'])
                                ->orWhere('phone', $validationData['mother_phone']);
                        })
                        ->where('student_id', $validationData['student_id'])
                        ->where('status', 1);
                }),
            ],
        ]);
    }

    public function addStudentInUser(Request $request, StudentInfo $student): User
    {
        return User::updateOrCreate(
            ['phone' => $request->phone],
            [
                'name' => $request->name,
                'parent_id' => rootId(),
                'student_id' => $student->id,
                'user_type_id' => 5,
                'password' => Hash::make(12345),
                'updated_by' => auth()->id(),
            ]
        );
    }

    public function addFatherInUser(Request $request, StudentInfo $student): User
    {
        return User::updateOrCreate(
            ['phone' => $request->father_phone],
            [
                'name' => $request->father_name ?? 'Mr.',
                'parent_id' => rootId(),
                'student_id' => $student->id,
                'user_type_id' => 4,
                'password' => Hash::make(12345),
                'updated_by' => auth()->id(),
            ]
        );
    }

    public function addMotherInUser(Request $request, StudentInfo $student): User
    {
        return User::updateOrCreate(
            ['phone' => $request->mother_phone],
            [
                'name' => $request->mother_name ?? 'Mrs.',
                'parent_id' => rootId(),
                'student_id' => $student->id,
                'user_type_id' => 4,
                'password' => Hash::make(12345),
                'updated_by' => auth()->id(),
            ]
        );
    }
}
