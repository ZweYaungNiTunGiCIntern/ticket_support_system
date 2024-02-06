@extends('dashboard.index')

@section('category')
    <div class="container">
        <div class="justify-content-center">
            <div class="col-md-7">
                <div class="card">

                    <div class="card-body align-items-center m-4">
                        <form action="{{ route('category.update', $category->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div>
                                <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Name <small
                                            class="text-danger">*</small></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name', $category->name) }}" placeholder="Category name">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <button type="submit" class="btn btn-outline-primary" type="button">Update</button>
                                </div>
                            <div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection
