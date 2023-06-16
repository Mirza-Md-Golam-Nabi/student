@extends('admin.layout.app')

@section('maincontent')
    <!-- Main Content -->

    @include('msg')

    <form action="{{ route('subjects.store') }}" method="post" class="mt-3">
        @csrf
        <div class="form-group">
            <label for="name">Subject Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off" required>
            @error('name')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>
@endsection

@section('extrascript')
@endsection
