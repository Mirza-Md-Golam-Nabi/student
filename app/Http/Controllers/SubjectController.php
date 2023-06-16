<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subjects\SubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Subject List";
        $create_url = "subjects.create";
        $create_text = "Subject Create";
        $subjects = Subject::where('root_id', rootId())
            ->orderBy('name', 'asc')
            ->get();

        $all_data = compact(
            'title',
            'create_url',
            'create_text',
            'subjects',
        );

        return view('admin.subject.list', $all_data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Subject Create";

        $all_data = compact(
            'title'
        );

        return view('admin.subject.create', $all_data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        $subject = Subject::updateOrCreate(
            $request->validated(),
            []
        );

        if (!$subject) {
            session()->flash('error', 'Subject does not create Successfully.');
            return redirect()->route('subjects.create')->withInput();
        }

        return redirect()->route('subjects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $title = "Subject Edit";

        $all_data = compact('title', 'subject');

        return view('admin.subject.edit', $all_data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        $subject->fill($request->validated());
        $subject->save();

        if (!$subject->wasChanged()) {
            session()->flash('error', 'Class Name does not update Successfully.');
            return redirect()->route('subjects.edit', $subject)->withInput();
        }

        return redirect()->route('subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
