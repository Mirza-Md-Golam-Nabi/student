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

    @include('admin.student.include-top')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('students.store') }}" method="post" class="mt-3">
        @csrf
        <div class="form-group">
            <label for="name">Name <small class="requiredClass">(required)</small></label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off" required
                autofocus>
            @error('name')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Student Phone</label>
            <input type="text" name="phone" value="{{ old('phone') }}"
                class="form-control @error('phone') is-invalid @enderror" id="phone" autocomplete="off">
            @error('phone')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="class_id">Class <small class="requiredClass">(required)</small></label>
            <select name="class_id" id="class_id" class="form-control @error('class_id') is-invalid @enderror" required readonly>
                @foreach ($classes as $class)
                    @if ($class_id == $class->class_name_id)
                        <option value="{{ $class->class_name_id }}" selected>{{ $class->className->title }}</option>
                        @break
                    @endif
                @endforeach
            </select>
            @error('class_id')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="father_name">Father Name</label>
            <input type="text" name="father_name" value="{{ old('father_name') }}"
                class="form-control @error('father_name') is-invalid @enderror" id="father_name" autocomplete="off">
            @error('father_name')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="mother_name">Mother Name</label>
            <input type="text" name="mother_name" value="{{ old('mother_name') }}"
                class="form-control @error('mother_name') is-invalid @enderror" id="mother_name" autocomplete="off">
            @error('mother_name')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="school_name">School Name</label>
            <input type="text" name="school_name" value="{{ old('school_name') }}"
                class="form-control @error('school_name') is-invalid @enderror" id="school_name" autocomplete="off">
            @error('school_name')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="father_phone">Father Phone</label>
            <input type="text" name="father_phone" value="{{ old('father_phone') }}"
                class="form-control @error('father_phone') is-invalid @enderror" id="father_phone" autocomplete="off">
            @error('father_phone')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="mother_phone">Mother Phone</label>
            <input type="text" name="mother_phone" value="{{ old('mother_phone') }}"
                class="form-control @error('mother_phone') is-invalid @enderror" id="mother_phone" autocomplete="off">
            @error('mother_phone')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>
@endsection

@section('extrascript')
@endsection
