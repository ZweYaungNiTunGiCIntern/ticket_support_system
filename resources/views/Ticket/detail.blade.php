@extends('dashboard.index')

@section('category')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header align-items-center">
                        <h5 class="card-title">Ticket Detail</h5>
                    </div>

                    <div class="card-body align-items-center m-4">
                        <!-- Ticket details -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="fw-bold fs-4">Title</div>
                            </div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-7">{{ $ticket->title }}</div>
                        </div>

                        <!-- Add more ticket details here -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="fw-bold fs-4">Message</div>
                            </div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-7">{{ $ticket->message }}</div>
                        </div>

                        <!-- Category -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="fw-bold fs-4">Category</div>
                            </div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-7">
                                @foreach ($ticket->categories as $category)
                                    <span>{{ $category->name }}</span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Label -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="fw-bold fs-4">Label</div>
                            </div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-7">
                                @foreach ($ticket->labels as $label)
                                    <span>{{ $label->name }}</span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Comments section -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="card-title">Comments</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($ticket->comments as $comment)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-10">
                                                <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment_text }}
                                                </div>
                                                <div class="col-md-2">
                                                    <form action="{{route('comment.destroy',$comment->id) }}" method="post" class="d-inline-block" onsubmit="return confirm('Are you sure to delete this item');" >
                                                        @method('delete')

                                                        @csrf
                                                        <button class="btn btn-outline-danger">

                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comment form -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body align-items-center m-4">
                        <form action="{{ route('comment.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="">
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}" />
                                <input type="text" name="comment_text" />
                            </div>

                            <div class="mt-3 align-item-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
