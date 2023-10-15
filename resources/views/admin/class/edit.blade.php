<!-- Modal -->
<div class="modal fade" id="editModal{{ $class->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Class Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('classes.update', $class) }}" method="post">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="class_name_id">Class Name</label>
                        <select name="class_name_id" id="class_name_id"
                            class="form-control @error('class_name_id') is-invalid @enderror" required>
                            <option value="">Please Select One</option>
                            @php
                                $class_id = old('class_name_id') ?? $class->class_name_id;
                            @endphp
                            @foreach ($class_list as $clas)
                                @if ($clas->id == $class_id)
                                    <option value="{{ $clas->id }}" selected>{{ $clas->title }}</option>
                                @else
                                    <option value="{{ $clas->id }}">{{ $clas->title }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>
