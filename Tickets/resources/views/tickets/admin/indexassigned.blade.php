@extends('layouts.admin')

@section('title', 'All Tickets')

@section('contents')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="font-bold text-2xl">All Tickets</h1>
    </div>
    <hr class="mb-4"/>

    <form method="GET" action="{{ route('admin/assignedtickets') }}" class="mb-4 flex space-x-4">
        <select name="division" class="border rounded p-2">
            <option value="">Select Division</option>
            @foreach($divisions as $division)
                <option value="{{ $division->id }}" {{ request('division') == $division->id ? 'selected' : '' }}>
                    {{ $division->name }}
                </option>
            @endforeach
        </select>

        <select name="status" class="border rounded p-2">
            <option value="">Select Status</option>
            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Assigned" {{ request('status') == 'Assigned' ? 'selected' : '' }}>Assigned</option>
            <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
        </select>

        <input type="text" name="author" placeholder="Author" value="{{ request('author') }}" class="border rounded p-2" />

        <input type="date" name="start_date" value="{{ request('start_date') }}" class="border rounded p-2" />
        <input type="date" name="end_date" value="{{ request('end_date') }}" class="border rounded p-2" />

        <button type="submit" class="bg-blue-500 text-white rounded p-2">Search</button>
    </form>

    @if(Session::has('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Clasification</th>
                <th>Autor</th>
                <th>Status</th>
                <th>Created at</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @if($tickets->count() > 0)
            @foreach($tickets as $ticket)
                <tr>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                        {{ $loop->iteration }}
                    </th>
                    <td>{{ $ticket->clasification }}</td>
                    <td>{{ $ticket->author->name }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>{{ $ticket->created_at }}</td>
                    <td>
                            @if($ticket->status !== 'Pending' && $ticket->status !== 'Cancelled')
                                <a href="#" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#assignmentModal"
                                    data-ticket-id="{{ $ticket->id }}"
                                    data-clasification="{{ $ticket->clasification }}"
                                    data-details="{{ $ticket->details }}"
                                    data-status="{{ $ticket->status }}"
                                    data-author="{{ $ticket->author->name }}"
                                    data-accountable-name="{{ $ticket->assignment->accountable->name ?? 'N/A' }}"
                                    data-division-name="{{ $ticket->author->division->name ?? 'N/A' }}"
                                    data-created-at="{{ $ticket->created_at }}"
                                    data-updated-at="{{ $ticket->updated_at }}">
                                    View Assignment
                                </a>
                            @else
                                <a href="#" class="text-blue-400 hover:text-blue-800" data-bs-toggle="modal" data-bs-target="#ticketModal"
                                    data-ticket-id="{{ $ticket->id }}"
                                    data-clasification="{{ $ticket->clasification }}"
                                    data-details="{{ $ticket->details }}"
                                    data-status="{{ $ticket->status }}">
                                    Ticket Details
                                </a>
                            @endif

                            @if($ticket->status !== 'Cancelled' && $ticket->status !== 'Assigned')
                                <a href="{{ route('admin/tickets/assignAdmin', $ticket->id) }}" class="text-green-400 hover:text-green-800">Assign</a>
                            @else

                            @endif
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    <!-- Ticket Modal -->
    <div class="modal fade" id="ticketModal" tabindex="-1" aria-labelledby="ticketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ticketModalLabel">Ticket Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Ticket ID:</strong> <span id="modal-ticket-id"></span></p>
                    <p><strong>Clasification:</strong> <span id="modal-clasification"></span></p>
                    <p><strong>Details:</strong> <span id="modal-details"></span></p>
                    <p><strong>Status:</strong> <span id="modal-status"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Assigned Modal -->
    <div class="modal fade" id="assignmentModal" tabindex="-1" aria-labelledby="assignmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignmentModalLabel">Assignment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Ticket ID:</strong> <span id="modal-ticket-id"></span></p>
                    <p><strong>Clasification:</strong> <span id="modal-clasification"></span></p>
                    <p><strong>Details:</strong> <span id="modal-details"></span></p>
                    <p><strong>Status:</strong> <span id="modal-status"></span></p>
                    <p><strong>Author:</strong> <span id="modal-author"></span></p>
                    <p><strong>Accountable:</strong> <span id="modal-accountable-name"></span></p>
                    <p><strong>Division:</strong> <span id="modal-division-name"></span></p>
                    <p><strong>Created:</strong> <span id="modal-created-at"></span></p>
                    <p><strong>Last Update:</strong> <span id="modal-updated-at"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
