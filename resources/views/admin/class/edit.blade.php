@extends('admin.layout.app')

@section('maincontent')
    <!-- Main Content -->

    @include('msg')

    <form action="{{ route('classes.update', $class) }}" method="post" class="mt-3">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="class_name_id">Class Name</label>
            <select name="class_name_id" id="class_name_id" class="form-control @error('class_name_id') is-invalid @enderror" required>
                <option value="">Please Select One</option>
                @php
                    $class_id = old('class_name_id') ?? $class->class_name_id;
                @endphp
                @foreach ($classes as $clas)
                    @if ($clas->id == $class_id)
                        <option value="{{ $clas->id }}" selected>{{ $clas->title }}</option>
                    @else
                        <option value="{{ $clas->id }}">{{ $clas->title }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <input type="submit" class="btn btn-primary" value="Update">
    </form>
@endsection

@section('extrascript')

@endsection
