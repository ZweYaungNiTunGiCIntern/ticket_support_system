@extends('dashboard.index')

@section('category')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Edit Ticket</h3>
                </div>
                <div class="card-body align-items-center m-4">
                    <form action="{{ route('ticket.update',$ticket) }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Title <small class="text-danger"></small></label>
                            <input type="text" name="title" class="form-control @error('title')is-invalid @enderror " value="{{ old('title', $ticket->title) }}">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message <small class="text-danger"></small></label>
                            <textarea name="message" class="form-control @error('message')is-invalid @enderror ">{{ old('message', $ticket->message) }}</textarea>
                            @error('message')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Category</label><br>
                            @foreach($categories as $category)
                                <input type="checkbox" value="{{ $category->id }}" name="category_id[]" {{ in_array($category->id, old('category_id', $ticket->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <label for="category{{ $category->id }}">{{ $category->name }}</label><br>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Label</label><br>
                            @foreach($labels as $label)
                                <input type="checkbox" value="{{ $label->id }}" name="label_id[]" {{ in_array($label->id, old('label_id', $ticket->labels->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <label for="label{{ $label->id }}">{{ $label->name }}</label><br>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Priority<small class="text-danger"></small></label>
                            <select name="priority" class="form-control @error('priority')is-invalid @enderror ">
                                <option value="first" {{ old('priority', $ticket->priority) == 'first' ? 'selected' : '' }}>First Priority</option>
                                <option value="second" {{ old('priority', $ticket->priority) == 'second' ? 'selected' : '' }}>Second Priority</option>
                                <option value="third" {{ old('priority', $ticket->priority) == 'third' ? 'selected' : '' }}>Third Priority</option>
                            </select>
                            @error('priority')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            @if($ticket->image)
                                <p>{{ $ticket->image }}</p>
                                <input type="file" id="image" name="image" class="form-control">
                            @else
                                <input type="file" id="image" name="image" class="form-control">
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="assign_agent" class="form-label">Assign Agents</label>
                            <select name="agent_id" class="form-select">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('agent_id', $ticket->agent_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <a href="{{ route('ticket.index') }}" class="btn btn-outline-dark">Back</a>
                            <button class="btn btn-outline-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
