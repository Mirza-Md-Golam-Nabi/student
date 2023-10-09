@extends('admin.layout.app')

@section('maincontent')
    <!-- Main Content -->

    @include('msg')


    <div class="row">
        @foreach ($classes as $class)
            <div class="col-sm-3">
                <a href="{{ route('students.index', ['class' => $class->class_name_id]) }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-secondary">
                                        Class
                                    </span>
                                </div>
                                <div style="line-height: 1">
                                    <div class="text-center" style="font-size: 50px">
                                        {{ $class->className->id }}
                                    </div>
                                    <div class="text-muted small text-center">
                                        {{ $class->className->title }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection

@section('extrascript')
@endsection
