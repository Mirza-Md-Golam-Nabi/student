<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Classes\ClassRequest;
use App\Models\Cls;
use App\Traits\ClassTrait;

class ClsController extends Controller
{
    use ClassTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Class List";
        $create_url = "classes.create";
        $create_text = "Class Create";
        $class_list = $this->classList();
        $classes = Cls::with('className')
            ->where('root_id', rootId())
            ->orderBy('class_name_id', 'asc')
            ->get();

        $all_data = compact(
            'title',
            'create_url',
            'create_text',
            'class_list',
            'classes',
        );

        return view('admin.class.list', $all_data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassRequest $request)
    {
        $class = Cls::updateOrCreate(
            $request->validated() + [
                'root_id' => rootId(),
                'updated_by' => auth()->id(),
            ],
            []
        );

        if (!$class) {
            session()->flash('error', 'Class Name does not create Successfully.');
            return redirect()->route('classes.index')->withInput();
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
    public function edit(Cls $cls)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassRequest $request, Cls $class)
    {
        $class->fill($request->validated() + [
            'root_id' => rootId(),
            'updated_by' => auth()->id(),
        ]);

        $class->save();

        if (!$class->wasChanged()) {
            session()->flash('error', 'Class Name does not update Successfully.');
            return redirect()->route('classes.index')->withInput();
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
}
