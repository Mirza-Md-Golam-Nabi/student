<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StudentInfoRequest;
use App\Models\Cls;
use App\Models\StudentInfo;

class StudentInfoController extends Controller
{
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
        $student = StudentInfo::create(
            $request->validated()
        );

        if (!$student) {
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
        $student->fill($request->validated());
        $student->save();

        if (!$student->wasChanged()) {
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

    public function classes()
    {
        return Cls::with('className')
            ->where('root_id', rootId())
            ->get();
    }
}
