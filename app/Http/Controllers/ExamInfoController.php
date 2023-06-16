<?php

namespace App\Http\Controllers;

use App\Http\Requests\Exam\ExamInfoRequest;
use App\Models\ExamInfo;
use App\Models\Subject;
use App\Traits\ClassTrait;
use Illuminate\Http\Request;

class ExamInfoController extends Controller
{
    use ClassTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Exam Info List";
        $create_url = "examinfos.create";
        $create_text = "Exam Info Create";
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

        return view('admin.exam-info.list', $all_data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Exam Info Create";
        $classes = $this->classes();
        $subjects = $this->subjects();

        $all_data = compact(
            'title',
            'classes',
            'subjects'
        );

        return view('admin.exam-info.create', $all_data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamInfoRequest $request)
    {
        $exam_info = ExamInfo::create(
            $request->validated()
        );

        if (!$exam_info) {
            session()->flash('error', 'Do not add a Exam Info Successfully.');
            return redirect()->route('examinfos.create')->withInput();
        }

        session()->flash('success', "Add a Exam Info Successfully.");
        return redirect()->route('examinfos.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(ExamInfo $examinfo)
    {
        $examinfo->load('className', 'subject');

        $title = "Exam Info Details";

        $all_data = compact(
            'title',
            'examinfo'
        );

        return view('admin.exam-info.show', $all_data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamInfo $examinfo)
    {
        $title = "Exam Info Edit";
        $classes = $this->classes();
        $subjects = $this->subjects();

        $all_data = compact(
            'title',
            'examinfo',
            'classes',
            'subjects'
        );

        return view('admin.exam-info.edit', $all_data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamInfoRequest $request, ExamInfo $examinfo)
    {
        $examinfo->fill($request->validated());
        $examinfo->save();

        if (!$examinfo->wasChanged()) {
            session()->flash('error', 'Do not add a Exam Info Successfully.');
            return redirect()->route('examinfos.edit', $examinfo)->withInput();
        }

        session()->flash('success', "Add a Exam Info Successfully.");
        return redirect()->route('examinfos.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamInfo $examinfo)
    {
        $examinfo->delete();

        session()->flash('success', "Delete Exam Info Successfully.");
        return redirect()->route('examinfos.index');
    }

    public function statusUpdate(Request $request): string
    {
        $status = $request->status;
        $exam_info_id = $request->examinfoid;
        $exam_info = ExamInfo::find($exam_info_id);
        $exam_info->status = $status == 1 ? 0 : 1;
        $exam_info->save();

        if ($status) {
            return "<span style='color:red;'>Inactive Exam Info.</span>";
        }

        return "<span style='color:blue;'>Active Exam Info.</span>";
    }

    public function subjects()
    {
        return Subject::where('root_id', rootId())
            ->get();
    }
}
