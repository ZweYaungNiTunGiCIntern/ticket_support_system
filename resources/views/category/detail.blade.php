@extends('dashboard.index')

@section('category')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5 shadow justify-content-center">


                <table class="table">
                    <thead>
                    <tr>

                        <th scope="col">Name</th>
                    </tr>
                    </thead>
                    <tbody>
                            <tr>


                                <td>{{ $category->name }}</td>
                            </tr>
                    </tbody>
                </table>
                <div class="mb-4">
                    <a href="{{ route('category.index') }}" class="btn btn-outline-primary" type="button">Back</a>
                </div>
            </div class="card-body">

        </div>
    </div>
</div>

@endsection
