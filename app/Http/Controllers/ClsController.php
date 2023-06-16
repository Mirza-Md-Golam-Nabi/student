<?php

namespace App\Http\Controllers;

use App\Http\Requests\Classes\ClassRequest;
use App\Models\ClassName;
use App\Models\Cls;

class ClsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Class List";
        $create_url = "classes.create";
        $create_text = "Class Create";
        $classes = Cls::with('className')
            ->where('root_id', rootId())
            ->orderBy('class_name_id', 'asc')
            ->get();

        $all_data = compact(
            'title',
            'create_url',
            'create_text',
            'classes',
        );

        return view('admin.class.list', $all_data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Class Create";

        $classes = $this->classList();

        $all_data = compact(
            'title',
            'classes'
        );

        return view('admin.class.create', $all_data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassRequest $request)
    {
        $class = Cls::updateOrCreate(
            $request->validated(),
            []
        );

        if (!$class) {
            session()->flash('error', 'Class Name does not create Successfully.');
            return redirect()->route('classes.create')->withInput();
        }

        return redirect()->route('classes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cls $cls)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cls $class)
    {
        $title = "Class Edit";

        $classes = $this->classList();

        $all_data = compact('title', 'class', 'classes');

        return view('admin.class.edit', $all_data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassRequest $request, Cls $class)
    {
        $class->fill($request->validated());
        $class->save();

        if (!$class->wasChanged()) {
            session()->flash('error', 'Class Name does not update Successfully.');
            return redirect()->route('classes.edit', $class)->withInput();
        }

        return redirect()->route('classes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cls $cls)
    {
        //
    }

    private function classList()
    {
        return ClassName::orderBy('id', 'asc')->get();
    }
}
