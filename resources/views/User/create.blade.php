@extends('dashboard.index')

@section('category')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body align-items-center m-4">
                    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                        @csrf


                        <div class="mb-3">
                            <label  class="form-label">Name <small class="text-danger"></small></label>
                            <input type="text" name="name" class="form-control @error('name')is-invalid @enderror ">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>

                                @enderror
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Email<small class="text-danger"></small></label>
                            <input type="email" name="email" class="form-control @error('name')is-invalid @enderror " value="{{ old('duration') }}">
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>

                                @enderror
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Role<small class="text-danger"></small></label>
                            <select id="role" name="role" class="form-control" placeholder="Enter role">

                                <option value="1">Agent</option>
                                <option value="2">User</option>
                            </select>


                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Password<small class="text-danger"></small></label>
                            <input type="number" name="password" class="form-control @error('expire date')is-invalid @enderror " >
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>

                                @enderror
                        </div>


                        <div class="mb-4">
                            <a href="{{ route('user.index') }}" class="btn btn-outline-dark">Back</a>
                            <button class="btn btn-outline-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
