@extends('admin.layout.app')
@section('maincontent')
    @include('admin.includes.createmodal')
    @include('validationError')
    @include('msg')
    <div class="clearfix">
        <table class="table table-striped" id="table_id">
            <thead>
                <tr>
                    <th scope="col">S.N</th>
                    <th scope="col">Subject Name</th>
                    <th style="text-align:center;" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $subject->name }}</td>
                        <td style="text-align: center;">
                            <span style="cursor: pointer;" class="text-primary" data-toggle="modal"
                                data-target="#editModal{{ $subject->id }}">Edit</span>
                            @include('admin.subject.edit')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('admin.subject.create')
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
