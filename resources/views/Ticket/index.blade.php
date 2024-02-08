@extends('dashboard.index')

@section('category')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5 md-4 shadow">
                <div class="card-header">
                    <h3>Ticket List</h3>
                </div>
                <div class="card-body">
                    @if(session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if(session()->get('update'))
                        <div class="alert alert-success">
                            {{ session()->get('update') }}
                        </div>
                    @endif
                    @if(session()->get('delete'))
                        <div class="alert alert-danger">
                            {{ session()->get('delete') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Message</th>
                                <th scope="col">File</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                                <tr>
                                    <th scope="row"> {{ $loop->index + 1 }}</th>
                                    <td>{{ $ticket->title }}</td>
                                    <td>{{ $ticket->message }}</td>
                                    <td>
                                        <img src="{{ asset('storage/gallery/'. $ticket->image) }}" alt="{{ $ticket->name }}" style="max-width: 50px; max-height: 50px;" >
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-right">
                                            <a href="{{route('ticket.edit',$ticket->id) }}" class="btn btn-outline-warning"">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{route('ticket.show',$ticket->id) }}" class="btn btn-outline-primary">
                                                <i class="fa fa-info"></i>
                                            </a>
                                            <div>
                                                <form action="{{route('ticket.destroy',$ticket->id) }}" method="post" class="d-inline-block" onsubmit="return confirm('Are you sure to delete this item');" >
                                                    @method('delete')

                                                    @csrf
                                                    <button class="btn btn-outline-danger">

                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
