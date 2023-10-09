@extends('admin.layout.app')

@section('maincontent')
    <!-- Main Content -->

    @include('msg')
    <style>
        .requiredClass {
            color: red;
            font-size: 60%;
        }
    </style>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="inputEmail4">Subject</label>
            <input type="text" class="form-control" value="{{ $result->examInfo->subject->name }}" readonly>
        </div>
        <div class="form-group col-md-8">
            <label for="inputPassword4">Exam Name</label>
            <input type="text" class="form-control" value="{{ $result->examInfo->name }}" readonly>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="inputCity">Class</label>
            <input type="text" class="form-control"
                value="{{ $result->examInfo->className->title . ' (' . $result->examInfo->className->id . ')' }}" readonly>
        </div>
        <div class="form-group col-md-4">
            <label for="inputState">Exam Date</label>
            <input type="text" class="form-control"
                value="{{ Carbon\Carbon::parse($result->examInfo->exam_date)->format('d M Y') }}" readonly>
        </div>
        <div class="form-group col-md-4">
            <label for="inputZip">Total Marks</label>
            <input type="text" class="form-control" value="{{ number_format($result->examInfo->total_marks, 1) }}"
                readonly>
        </div>
    </div>
    <form action="{{ route('results.update', $result) }}" method="post" class="mt-3">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">Student Marks</label>
            <div class="d-flex justify-content-around mb-1">
                <input type="text" value="{{ $result->student->name }}" readonly class="form-control mr-1">
                <input type="number" step="any" name="get_marks" value="{{ number_format($result->get_marks, 1) }}"
                    required class="form-control @error('get_marks') is-invalid @enderror" placeholder="Marks">
            </div>
            @error('get_marks')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-sm btn-primary">Update</button>
    </form>
@endsection

@section('extrascript')
@endsection
