@extends('admin.layout.app')
@section('maincontent')
    @include('admin.includes.createbutton')
    @include('msg')
    <div class="clearfix">
        <table class="table table-striped" id="table_id">
            <thead>
                <tr>
                    <th scope="col">S.N</th>
                    <th scope="col">Name</th>
                    <th scope="col">Student Phone</th>
                    <th scope="col">Status</th>
                    <th style="text-align:center;" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            <a href="{{ route('students.show', $student) }}" class="text-primary">
                                {{ $student->name }}
                            </a>
                        </td>
                        <td>{{ $student->phone }}</td>
                        <td>{{ $student->status() }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('students.edit', $student) }}" class="text-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('extrascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_id').DataTable({
                "lengthMenu": [
                    [25, 50, -1],
                    [25, 50, "All"]
                ]
            });
        });
    </script>
@endsection
