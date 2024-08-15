@extends('layouts.admin')

@section('title', 'Users')

@section('contents')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Users</h1>
        <a href="{{ route('admin/users/create') }}" class="btn btn-warning">Add User</a>
    </div>

    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Type</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($users->count() > 0)
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td class="text-capitalize">{{ $user->type }}</td>
                <td>
                    <a href="#" class="text-info text-decoration-none" data-bs-toggle="modal" data-bs-target="#userModal{{ $user->id }}">
                        <i class="fas fa-info-circle"></i> Details
                    </a>
                    <a href="{{ route('admin/users/edit', $user->id) }}" class="text-warning text-decoration-none ms-3">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    @if ($user->id !== $currentUserId)
                        <form action="{{ route('admin/users/destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete?')" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger text-decoration-none ms-3 p-0">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        @endif
    </table>
</div>

@foreach ($users as $user)
<!-- Modal -->
<div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userModalLabel{{ $user->id }}">User Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex">
        <!-- Left Column: Info -->
        <div class="w-50 me-3">
            <div class="mb-3">
                <label class="form-label" style="font-weight: bold;">Full Name</label>
                <p>{{ $user->name }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label" style="font-weight: bold;">Email</label>
                <p>{{ $user->email }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label" style="font-weight: bold;">Rank</label>
                <p style="text-transform: capitalize;">{{ $user->type }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label" style="font-weight: bold;">Division</label>
                <p>{{$user->division->name ?? 'No division'}}</p>
            </div>
        </div>
        <!-- Right Column: Image -->
        <div class="w-50">
            <label class="form-label" style="font-weight: bold;">Profile Image</label>
            <br>
            <img src="{{ asset('storage/' . $user->url) }}" alt="Profile Image" class="img-fluid">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach

<!-- Import Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">

<!-- Import Bootstrap JS (necessary for modals) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.min.js"></script>

@endsection
