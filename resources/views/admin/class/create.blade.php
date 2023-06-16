@extends('admin.layout.app')

@section('maincontent')
    <!-- Main Content -->

    @include('msg')

    <form action="{{ route('classes.store') }}" method="post" class="mt-3">
        @csrf
        <div class="form-group">
            <label for="class_name_id">Class Name</label>
            @php $old = old('class_name_id'); @endphp
            <select name="class_name_id" id="class_name_id" class="form-control @error('class_name_id') is-invalid @enderror" required autofocus>
                <option value="">Please Select One</option>
                @foreach ($classes as $class)
                    @if ($old == $class->id)
                        <option value="{{ $class->id }}" selected>{{ $class->title }}</option>
                    @else
                        <option value="{{ $class->id }}">{{ $class->title }}</option>
                    @endif
                @endforeach
            </select>
            @error('class_name_id')
                <span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>
@endsection

@section('extrascript')
@endsection
