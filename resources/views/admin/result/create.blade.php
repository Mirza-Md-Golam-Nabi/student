@extends('admin.layout.app')

@section('maincontent')
    <!-- Main Content -->

    @include('admin.result.include-top')

    @include('msg')
    <style>
        .requiredClass {
            color: red;
            font-size: 60%;
        }
    </style>
    <form action="{{ route('results.store') }}" method="post" class="mt-3">
        @csrf
        <input type="hidden" name="exam" value="{{ $exam_info->id }}">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputEmail4">Subject</label>
                <input type="text" class="form-control" value="{{ $exam_info->subject->name }}" readonly>
            </div>
            <div class="form-group col-md-8">
                <label for="inputPassword4">Exam Name</label>
                <input type="text" class="form-control" value="{{ $exam_info->name }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputCity">Class</label>
                <input type="text" class="form-control"
                    value="{{ $exam_info->className->title . ' (' . $exam_info->className->id . ')' }}" readonly>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Exam Date</label>
                <input type="text" class="form-control"
                    value="{{ Carbon\Carbon::parse($exam_info->exam_date)->format('d M Y') }}" readonly>
            </div>
            <div class="form-group col-md-4">
                <label for="inputZip">Total Marks</label>
                <input type="text" class="form-control" value="{{ $exam_info->total_marks }}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="">Student Marks</label>
            <div id="student">
                <div class="d-flex justify-content-around mb-1">
                    <select name="student_id[]" data-student="1" required class="form-control mr-1 target_product">
                        <option value="">Select Student</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                    <input type="number" step="any" name="marks[]" required class="form-control mr-1" placeholder="Marks">
                    <span class="btn ml-1">&nbsp;&nbsp;&nbsp;</span>
                </div>
            </div>
            <span class="btn btn-success btn-sm mt-2" id="addmore">Add More</span>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('extrascript')
    <script>
        $(document).ready(function() {
            var i = 1;
            $('#addmore').click(function() {
                i++;
                var data = `<div id="div${i}" class="mt-3">
                <div class="d-flex justify-content-around mb-1">
                    <select name="student_id[]" data-student="${i}" required class="form-control mr-1 target_product">
                        <option value="">Select Student</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                    <input type="number" step="any" name="marks[]" required class="form-control mr-1" placeholder="Marks">
                    <span class="btn ml-1 btn-danger btn_remove_product" id="${i}">X</span>
                </div>
            </div>`;
                $('#student').append(data);
            });
        });

        $(document).on('click', '.btn_remove_product', function() {
            var button_id = $(this).attr("id");
            $('#div' + button_id).remove();
        });
    </script>
@endsection
