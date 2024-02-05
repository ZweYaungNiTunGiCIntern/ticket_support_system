@extends('dashboard.index')

@section('category')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">


                    <div class="card-body align-items-center m-4">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="fw-bold fs-4">Name</div>
                            </div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-7">{{ $user->name }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="fw-bold fs-4">Email</div>
                            </div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-7">{{ $user->email }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="fw-bold fs-4">Role</div>
                            </div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-7">
                                @if ($user->role == 1)
                                        Agent
                                @elseif ($user->role == 2)
                                        User
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
