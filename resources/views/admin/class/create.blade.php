<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Class Create</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('classes.store') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="class_name_id">Class Name</label>
                        @php $old = old('class_name_id'); @endphp
                        <select name="class_name_id" id="class_name_id"
                            class="form-control @error('class_name_id') is-invalid @enderror" required autofocus>
                            <option value="">Please Select One</option>
                            @foreach ($class_list as $cls)
                                @if ($old == $cls->id)
                                    <option value="{{ $cls->id }}" selected>{{ $cls->title }}</option>
                                @else
                                    <option value="{{ $cls->id }}">{{ $cls->title }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('class_name_id')
                            <span style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>
