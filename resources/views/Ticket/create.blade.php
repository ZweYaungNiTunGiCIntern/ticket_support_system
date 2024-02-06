@extends('dashboard.index')

@section('category')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Create Ticket</h3>
                </div>
                <div class="card-body align-items-center m-4">
                    <form action="{{ route('ticket.store') }}" method="post" enctype="multipart/form-data">
                        @csrf


                        <div class="mb-3">
                            <label  class="form-label">Title <small class="text-danger"></small></label>
                            <input type="text" name="title" class="form-control @error('title')is-invalid @enderror ">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>

                                @enderror
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Message <small class="text-danger"></small></label>
                            <textarea type="text" name="message" class="form-control @error('email')is-invalid @enderror " value="{{ old('duration') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>

                                @enderror
                            </textarea>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Category</label><br>
                            @foreach($categories as $category)
                                <input type="checkbox" value="{{ $category->id }}" name="category_id[]">
                                <label for="category{{ $category->id }}">{{ $category->name }}</label><br>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Label</label><br>
                            @foreach($labels as $label)
                                <input type="checkbox" value="{{ $label->id }}" name="label_id[]">
                                <label for="label{{ $label->id }}">{{ $label->name }}</label><br>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Priority<small class="text-danger"></label>
                            <select type="text" name="priority" class="form-control @error('priority')is-invalid @enderror " >
                                <option value="first">First Priority</option>
                                <option value="second">Second Priority</option>
                                <option value="third">Third Priority</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="file_paths" class="form-label">File Paths</label>
                            <input type="file" id="image" name="image" class="form-control">
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
