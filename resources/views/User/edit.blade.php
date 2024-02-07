@extends('dashboard.index')

@section('category')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">


                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data" >
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name <small class="text-danger">*</small></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $user->name) }}"
                                    placeholder="Enter user name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email<small class="text-danger">*</small></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $user->email) }}"
                                    placeholder="Enter email">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role <small
                                        class="text-danger">*</small></label>
                                <select id="role" name="role" class="form-control" placeholder="Enter role" value="{{ old('role', $user->role) }}">
                                    <option value="1">Agent</option>
                                    <option value="2">User</option>
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password"   value = "{{ decrypt($user->password ) }}"
                                    placeholder="Enter password">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Make Admin</label>
                                <input type="checkbox" value="0" id="is_admin" name="is_admin" />
                            </div>


                            <div class="row justify-content-between">
                                <a href="{{ route('user.index') }}" class="btn btn-dark justify-right">Cancel</i></a>
                                <button type="submit" class="btn btn-primary ">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
