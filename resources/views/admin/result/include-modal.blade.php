<!-- Modal -->
<div class="modal fade" id="student{{ $result->student_id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Student Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        {{ __('Student Name') }}
                    </div>
                    <div class="col-md-7">
                        {{ $result->student->name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        {{ __('Student Phone') }}
                    </div>
                    <div class="col-md-7">
                        {{ $result->student->phone }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        {{ __('Father Name') }}
                    </div>
                    <div class="col-md-7">
                        {{ $result->student->father_name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        {{ __('Mother Name') }}
                    </div>
                    <div class="col-md-7">
                        {{ $result->student->mother_name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        {{ __('Father Phone') }}
                    </div>
                    <div class="col-md-7">
                        {{ $result->student->father_phone }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        {{ __('Mother Phone') }}
                    </div>
                    <div class="col-md-7">
                        {{ $result->student->mother_phone }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        {{ __('School Name') }}
                    </div>
                    <div class="col-md-7">
                        {{ $result->student->school_name }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
