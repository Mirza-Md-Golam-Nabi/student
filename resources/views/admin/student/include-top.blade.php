<div class="mt-4 mb-4">
    <a href="{{ route('export.student.template', ['class' => $class_id]) }}">
        <button type="button" class="btn btn-sm btn-primary">Export Student Template</button>
    </a>
    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#importMarks">Upload
        Student</button>

    <!-- Modal -->
    <div class="modal fade" id="importMarks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import.students') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="exam" value="">
                        <div class="form-group">
                            <label for="excelFile">Upload Excel Student File</label>
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
</div>
