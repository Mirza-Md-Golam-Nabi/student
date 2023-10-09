<div class="mt-4 mb-4">
    <a href="{{ route('results.create', ['exam' => $exam_info->id]) }}">
        <button type="button" class="btn btn-sm btn-primary">Result Create</button>
    </a>
    <a href="{{ route('results.history', ['exam' => $exam_info->id]) }}">
        <button type="button" class="btn btn-sm btn-primary">Result History</button>
    </a>
    <a href="{{ route('export.exam.participants', ['exam' => $exam_info->id]) }}">
        <button type="button" class="btn btn-sm btn-primary">Export Student</button>
    </a>
    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#importMarks">
        Upload Marks
    </button>
    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#setSms">
        Set SMS
    </button>

    <!-- Modal -->
    <div class="modal fade" id="importMarks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Result</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import.exam.participants.marks') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="exam" value="{{ $exam_info->id }}">
                        <div class="form-group">
                            <label for="excelFile">Upload Excel Result File</label>
                            <input type="file" class="form-control" name="file" id="excelFile" required>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="setSms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Set SMS Format</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('exam.msg.set') }}" method="POST">
                        @csrf
                        <input type="hidden" name="exam" value="{{ $exam_info->id }}">
                        <div>
                            <table class="table table-bordered">
                                <tr>
                                    <td>$student = Student Name</td>
                                    <td>$father = Father Name</td>
                                </tr>
                                <tr>
                                    <td>$mother = Mother Name</td>
                                    <td>$subject = Subject Name</td>
                                </tr>
                                <tr>
                                    <td>$total_marks = Total Exam Marks</td>
                                    <td>$get_marks = Student Get Marks</td>
                                </tr>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="setSmsFormat">Set your SMS format</label>
                            <textarea name="sms_format" class="form-control" id="setSmsFormat" rows="5" required>{{ old('sms_format') ?? ($exam_info->smsFormat->text ?? null) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="setNumber">To whom send sms</label>
                            <select name="set_number" id="setNumber" class="form-control" required>
                                @php
                                    $numbers = [
                                        'student_phone' => 'Student Phone',
                                        'father_phone' => 'Father Phone',
                                        'mother_phone' => 'Mother Phone',
                                    ];
                                    $number = $exam_info->smsFormat->number ?? null;
                                @endphp
                                <option value="">Please select one</option>
                                @foreach ($numbers as $key => $value)
                                    @if ($key == $number)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary px-3">Set</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
