@extends('admin.layout.app')

@section('maincontent')
    <!-- Main Content -->

    @include('admin.result.include-top')

    @include('msg')

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="inputEmail4">Subject</label>
            <input type="text" class="form-control" value="{{ $exam_info->subject->name }}" readonly>
        </div>
        <div class="form-group col-md-8">
            <label for="inputPassword4">Exam Name</label>
            <input type="text" class="form-control" value="{{ $exam_info->name }}" readonly>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="inputCity">Class</label>
            <input type="text" class="form-control"
                value="{{ $exam_info->className->title . ' (' . $exam_info->className->id . ')' }}" readonly>
        </div>
        <div class="form-group col-md-4">
            <label for="inputState">Exam Date</label>
            <input type="text" class="form-control"
                value="{{ Carbon\Carbon::parse($exam_info->exam_date)->format('d M Y') }}" readonly>
        </div>
        <div class="form-group col-md-4">
            <label for="inputZip">Total Marks</label>
            <input type="text" class="form-control" value="{{ number_format($exam_info->total_marks, 1) }}" readonly>
        </div>
    </div>

    <div class="mt-3">
        <div>
            <span style="color: red">
                SMS Format
                <a href="{{ route('send.test.sms', ['exam' => $exam_info->id]) }}">
                    <button class="btn btn-sm btn-primary">SMS Test</button>
                </a>
            </span>
        </div>
        <div>
            <pre>{{ $exam_info->smsFormat->text ?? 'Not set SMS format.' }}@if ($exam_info->smsFormat->text)<br>Send to : <b>{{ ucwords(str_replace('_', ' ', $exam_info->smsFormat->number)) }}</b>@endif</pre>

        </div>
    </div>

    <div class="form-group mt-4">
        <div class="d-flex justify-content-between">
            <div>
                <label for="" class="text-primary font-weight-bold">Student Result</label>
            </div>
            <div>
                <a href="{{ route('send.all.sms', ['exam' => $exam_info->id]) }}">
                    <button class="btn btn-sm btn-primary px-4">Send All SMS</button>
                </a>
                <a href="{{ route('download.exam.results', ['exam' => $exam_info->id]) }}">
                    <button class="btn btn-sm btn-primary px-4">PDF</button>
                </a>
            </div>
        </div>

        <div>
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Marks</th>
                        <th scope="col">SMS Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td style="cursor: pointer;" class="text-primary" data-toggle="modal"
                                data-target="#student{{ $result->student_id }}">
                                {{ $result->student->name }}
                            </td>
                            <td>{{ number_format($result->get_marks, 1) }}</td>
                            <td>{{ 'Not Send' }}</td>
                            <td>
                                <a href="{{ route('results.edit', $result) }}" class="text-primary">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="#" title="Delete" class="mx-2" style="color: red"
                                    onclick="event.preventDefault(); document.getElementById('result-destroy{{ $result->id }}').submit();">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <form id="result-destroy{{ $result->id }}"
                                    action="{{ route('results.destroy', $result) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @if ($result->got_sms == 1)
                                    <span class="text-secondary">
                                        <i class="fas fa-paper-plane"></i>
                                    </span>
                                @else
                                    <a href="{{ route('send.single.sms', ['result_id'=>$result->id]) }}" class="text-success">
                                        <i class="fas fa-paper-plane"></i>
                                    </a>
                                @endif

                            </td>
                        </tr>
                        @include('admin.result.include-modal')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('extrascript')
@endsection
