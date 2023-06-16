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
                    <th style="text-align:center;" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($examInfos as $examInfo)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            <a href="{{ route('examinfos.show', $examInfo) }}" class="text-primary">
                                {{ $examInfo->name }}
                            </a>
                        </td>
                        <td>{{ $examInfo->subject->name }}</td>
                        <td>{{ $examInfo->className->title }}</td>
                        <td>{{ Carbon\Carbon::parse($examInfo->exam_date)->format('d M y') }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('examinfos.edit', $examInfo) }}" title="Edit" class="text-primary">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="#" title="Delete" class="text-primary"
                                onclick="event.preventDefault(); document.getElementById('examinfo-destroy').submit();">
                                <i class="fas fa-trash"></i>
                            </a>
                            <form id="examinfo-destroy" action="{{ route('examinfos.destroy', $examInfo) }}" method="POST"
                                class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                            <div class="d-inline custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input exam-info"
                                    id="customSwitch{{ $loop->index }}" data-examinfoid={{ $examInfo->id }}
                                    data-status={{ $examInfo->status }} @if ($examInfo->status) checked @endif>
                                <label class="custom-control-label" for="customSwitch{{ $loop->index }}"></label>
                            </div>
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


            $('.exam-info').click(function() {
                var selectedId = this.id;
                var examId = $(this).data('examinfoid');
                var status = $(this).data('status');
                console.log('examId = ' + examId + ' & status = ' + status);
                $.ajax({
                    url: "{!! route('exam-info-status-update') !!}?examinfoid=" + examId + "&status=" + status,
                    method: 'GET',
                    success: function(data) {
                        $('#statusUpdate').html(data);
                        var updateStatus = status == 1 ? 0 : 1;
                        $('#' + selectedId).data('status', updateStatus);
                    }
                });
            });

        });
    </script>
@endsection
