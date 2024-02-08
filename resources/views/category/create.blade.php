@extends('dashboard.index')

@section('category')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Create Category</h3>
                </div>
                <div class="card-body align-items-center m-4">
                    <form action="{{ route('category.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label  class="form-label">Name <small class="text-danger"></small></label>
                            <input type="text" name="name" class="form-control @error('name')is-invalid @enderror " value="{{ old('duration') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>

                                @enderror
                        </div>

                        <div class="mb-4">
                            <a href="{{ route('category.index') }}" class="btn btn-outline-dark">Back</a>
                            <button class="btn btn-outline-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
