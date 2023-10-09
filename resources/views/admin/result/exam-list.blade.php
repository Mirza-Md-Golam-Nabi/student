@extends('admin.layout.app')
@section('maincontent')
    @include('admin.includes.createbutton')
    @include('msg')
    <div class="clearfix">
        <div id="statusUpdate" class="text-primary p-3"></div>
        <table class="table table-striped" id="table_id">
            <thead>
                <tr>
                    <th scope="col">S.N</th>
                    <th scope="col">Exam Name</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Class</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($examInfos as $examInfo)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            <a href="{{ route('results.create', ['exam'=>$examInfo->id]) }}" class="text-primary">
                                {{ $examInfo->name }}
                            </a>
                        </td>
                        <td>{{ $examInfo->subject->name }}</td>
                        <td>{{ $examInfo->className->title }}</td>
                        <td>{{ Carbon\Carbon::parse($examInfo->exam_date)->format('d M y') }}</td>
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
