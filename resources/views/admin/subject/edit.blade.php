@extends('admin.layout.app')

@section('maincontent')
    <!-- Main Content -->

    @include('msg')

    <form action="{{ route('subjects.update', $subject) }}" method="post" class="mt-3">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Subject Name</label>
            <input type="text" name="name" value="{{ old('name') ?? $subject->name }}"
                class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off" required>
            @error('name')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <input type="submit" class="btn btn-primary" value="Update">
    </form>
@endsection

@section('extrascript')
@endsection
