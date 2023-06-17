@extends('admin.layout.app')

@section('maincontent')
    <!-- Main Content -->

    <table class="table table-striped table-sm mt-4">
        <tr>
            <td>Class</td>
            <td>{{ $student->className->title }}</td>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{ $student->name }}</td>
        </tr>
        <tr>
            <td>Student Phone</td>
            <td>{{ $student->phone }}</td>
        </tr>
        <tr>
            <td>Father Name</td>
            <td>{{ $student->father_name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>Mother Name</td>
            <td>{{ $student->mother_name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>School Name</td>
            <td>{{ $student->school_name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>Guardian Phone</td>
            <td>{{ $student->guardian_phone ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td class="@if ($student->status() == 'Active') text-success @else text-danger @endif">
                {{ $student->status() }}
            </td>
        </tr>
    </table>
@endsection

@section('extrascript')
@endsection
