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
                    <th scope="col">Class Name</th>
                    <th style="text-align:center;" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $class)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $class->className->title }}</td>
                        <td style="text-align: center;">
                            <span style="cursor: pointer;" class="text-primary" data-toggle="modal"
                                data-target="#editModal{{ $class->id }}">Edit</span>
                            @include('admin.class.edit')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('admin.class.create')
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
