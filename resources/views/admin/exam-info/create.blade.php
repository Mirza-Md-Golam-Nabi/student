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
    <form action="{{ route('examinfos.store') }}" method="post" class="mt-3">
        @csrf
        <div class="form-group">
            <label for="name">Exam Name <small class="requiredClass">(required)</small></label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off" required
                autofocus>
            @error('name')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="subject_id">Subject <small class="requiredClass">(required)</small></label>
            @php $old = old('subject_id'); @endphp
            <select name="subject_id" id="subject_id" class="form-control @error('subject_id') is-invalid @enderror" required>
                <option value="">Please Select One</option>
                @foreach ($subjects as $subject)
                    @if ($old == $subject->id)
                        <option value="{{ $subject->id }}" selected>{{ $subject->name }}</option>
                    @else
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endif
                @endforeach
            </select>
            @error('subject_id')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="class_id">Class <small class="requiredClass">(required)</small></label>
            @php $old = old('class_id'); @endphp
            <select name="class_id" id="class_id" class="form-control @error('class_id') is-invalid @enderror" required>
                <option value="">Please Select One</option>
                @foreach ($classes as $class)
                    @if ($old == $class->class_name_id)
                        <option value="{{ $class->class_name_id }}" selected>{{ $class->className->title }}</option>
                    @else
                        <option value="{{ $class->class_name_id }}">{{ $class->className->title }}</option>
                    @endif
                @endforeach
            </select>
            @error('class_id')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exam_date">Exam Date <small class="requiredClass">(required)</small></label>
            <input type="date" name="exam_date" value="{{ old('exam_date') }}"
                class="form-control @error('exam_date') is-invalid @enderror" id="exam_date" autocomplete="off" required>
            @error('exam_date')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="topic">Exam Topic</label>
            <textarea class="form-control @error('topic') is-invalid @enderror" name="topic" id="topic" placeholder="Please input here exam topic" autocomplete="off" rows="5">{{ old('topic') }}</textarea>
            @error('topic')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>
@endsection

@section('extrascript')
@endsection
