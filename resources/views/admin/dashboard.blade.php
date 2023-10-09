@extends('admin.layout.app')

@section('maincontent')
    <!-- Main Content -->

    <style>
        .contain {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-gap: 5px;
        }

        .contain-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 5px;
        }

        .bg-soft-success {
            background-color: rgba(68, 207, 156, .25);
        }

        .rounded {
            border-radius: 0.25rem !important;
        }
    </style>

    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <h6 class="card-header text-center alert-primary font-weight-bold">SMS Balance</h6>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="bg-soft-success rounded p-2">
                                <i class="fas fa-credit-card text-success"></i>
                            </span>
                        </div>
                        <div>
                            <span>&#2547;</span> {{ $sms_balance }} ({{ $sms_available }})
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <h6 class="card-header text-center alert-primary font-weight-bold">Active Student</h6>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="bg-soft-success rounded p-2">
                                <i class="fas fa-graduation-cap text-success"></i>
                            </span>
                        </div>
                        <div>
                            32
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extrascript')
    <!-- Extra Script -->
@endsection
