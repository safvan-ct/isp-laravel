@extends('layouts.admin')

@section('content')
    <div class="row">
        @role('Vendor')
            <div class="col-xl-12 col-md-12">
                <div class="card {{ auth()->user()->vendor?->status == 'approved' ? 'bg-success' : 'bg-danger' }}">
                    <div class="card-body p-2">
                        <h3 class="text-white text-center mb-0">{{ auth()->user()->vendor?->name }} -
                            {{ auth()->user()->vendor?->status }}</h3>
                    </div>
                </div>
            </div>
        @endrole

        <div class="col-xl-4 col-md-6">
            <div class="card bg-secondary-dark dashnum-card text-white overflow-hidden">
                <span class="round small"></span>
                <span class="round big"></span>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="avtar avtar-lg">
                                <i class="text-white ti ti-users"></i>
                            </div>
                        </div>
                    </div>
                    <span class="text-white d-block f-34 f-w-500 my-2">
                        {{ $userCount }}
                        <i class="ti ti-arrow-up-right-circle opacity-50"></i>
                    </span>
                    <p class="mb-0 opacity-50">Total Users</p>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary-dark dashnum-card text-white overflow-hidden">
                <span class="round small"></span>
                <span class="round big"></span>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="avtar avtar-lg">
                                <i class="text-white ti ti-user-check"></i>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="chart-tab-tabContent">
                        <div class="tab-pane show active" id="chart-tab-home" role="tabpanel"
                            aria-labelledby="chart-tab-home-tab" tabindex="0">
                            <div class="row">
                                <div class="col-6">
                                    <span class="text-white d-block f-34 f-w-500 my-2">
                                        {{ $staffCount }}
                                        <i class="ti ti-arrow-up-right-circle opacity-50"></i>
                                    </span>
                                    <p class="mb-0 opacity-50">Total Staffs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-12">
            <div class="card bg-primary-dark dashnum-card dashnum-card-small text-white overflow-hidden">
                <span class="round bg-primary small"></span>
                <span class="round bg-primary big"></span>
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <div class="avtar avtar-lg">
                            <i class="text-white ti ti-credit-card"></i>
                        </div>
                        <div class="ms-2">
                            <h4 class="text-white mb-1">{{ $rolesCount }}</h4>
                            <p class="mb-0 opacity-75 text-sm">Total Roles</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card dashnum-card dashnum-card-small overflow-hidden">
                <span class="round bg-warning small"></span>
                <span class="round bg-warning big"></span>
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <div class="avtar avtar-lg bg-light-warning">
                            <i class="text-warning ti ti-credit-card"></i>
                        </div>
                        <div class="ms-2">
                            <h4 class="mb-1">00000</h4>
                            <p class="mb-0 opacity-75 text-sm">Dummy Data</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
