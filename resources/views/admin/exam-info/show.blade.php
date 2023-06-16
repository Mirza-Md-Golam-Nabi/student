@extends('admin.layout.app')

@section('maincontent')
    <!-- Main Content -->

    <table class="table table-striped table-sm mt-4">
        <tr>
            <td>Class</td>
            <td>{{ $examinfo->className->title }}</td>
        </tr>
        <tr>
            <td>Exam Name</td>
            <td>{{ $examinfo->name }}</td>
        </tr>
        <tr>
            <td>Subject</td>
            <td>{{ $examinfo->subject->name }}</td>
        </tr>
        <tr>
            <td>Exam Date</td>
            <td>{{ Carbon\Carbon::parse($examinfo->exam_date)->format('d M y') }}</td>
        </tr>
        <tr>
            <td>Exam Topic</td>
            <td>{{ $examinfo->topic }}</td>
        </tr>
    </table>
@endsection

@section('extrascript')
@endsection
