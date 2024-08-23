@extends('layouts.admin')

@section('title', 'Divisions')

@section('contents')

<div class="container mt-5">
    <!-- The main header of the page, with the title of the page and the button to create a new division -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Actual Divisions</h1>
        <!-- Create Modal Button -->
        <button type="button" class="btn btn-success" id="createDivisionButton">
            New Division
        </button>
    </div>
    <!-- The horizontal line that separates the header from the table -->
    <hr class="mb-4"/>
    <!-- Alerts -->
    @if(Session::has('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle me-2" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
              </svg>
            <div>
                {{ Session::get('success') }}
            </div>
        </div>
    @endif

    @if(Session::has('updated'))
        <div class="alert alert-warning d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-highlighter me-2" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M11.096.644a2 2 0 0 1 2.791.036l1.433 1.433a2 2 0 0 1 .035 2.791l-.413.435-8.07 8.995a.5.5 0 0 1-.372.166h-3a.5.5 0 0 1-.234-.058l-.412.412A.5.5 0 0 1 2.5 15h-2a.5.5 0 0 1-.354-.854l1.412-1.412A.5.5 0 0 1 1.5 12.5v-3a.5.5 0 0 1 .166-.372l8.995-8.07zm-.115 1.47L2.727 9.52l3.753 3.753 7.406-8.254zm3.585 2.17.064-.068a1 1 0 0 0-.017-1.396L13.18 1.387a1 1 0 0 0-1.396-.018l-.068.065zM5.293 13.5 2.5 10.707v1.586L3.707 13.5z"/>
            </svg>
            <div>
                {{ Session::get('updated') }}
            </div>
        </div>
    @endif

    @if(Session::has('deleted'))
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle me-2" viewBox="0 0 16 16">
                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
              </svg>
            <div>
                {{ Session::get('deleted') }}
            </div>
        </div>
    @endif

    <!-- The table of divisions -->
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if($divisions->count() > 0)
                @foreach($divisions as $dv)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $dv->name }}</td>
                    <td class="w-25">
                        <div class="d-flex gap-2">
                            <!-- Update modal -->
                            <button type="button" class="btn btn-outline-success btn-sm editDivisionButton"
                                    data-division-id="{{ $dv->id }}"
                                    data-division-name="{{ $dv->name }}"
                                    data-update-url="{{ route('admin.divisions.update', ['id' => $dv->id]) }}">
                                Edit
                            </button>

                            <!-- Delete button -->
                            <form action="{{ route('admin/divisions/destroy', $dv->id) }}" method="POST" onsubmit="return confirm('Delete?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="3">No Divisions registered</td>
                </tr>
            @endif
        </tbody>
    </table>

<!-- Create Modal -->
    <div class="modal fade" id="createDivisionModal" tabindex="-1" aria-labelledby="createDivisionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDivisionModalLabel">New Division</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.divisions.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name of the division</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Create</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Edit Division Modal -->
    <div class="modal fade" id="editDivisionModal" tabindex="-1" aria-labelledby="editDivisionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDivisionModalLabel">Change Division Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editDivisionForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editDivisionName" class="form-label">Division Name</label>
                            <input type="text" class="form-control" id="editDivisionName" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
