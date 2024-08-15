@extends('layouts.assistant')

@section('title', 'Assigned Tickets')

@section('contents')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="font-bold text-2xl">Assigned Tickets</h1>
    </div>
    <hr class="mb-4"/>

    <form method="GET" action="{{ route('assistant/tickets') }}" class="mb-4 flex space-x-4">
        <select name="division" class="border rounded p-2">
            <option value="">Select Division</option>
            @foreach($divisions as $division)
                <option value="{{ $division->id }}" {{ request('division') == $division->id ? 'selected' : '' }}>
                    {{ $division->name }}
                </option>
            @endforeach
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
                    <td>{{ $ticket->created_at }}</td>
                    <td>
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
                        <a href="#" class="btn btn-link"> Chat </a>
                        <a href="#" class="btn btn-link"> Solve ticket </a>
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>


    <!-- Modal -->
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var assignmentModal = document.getElementById('assignmentModal');
            assignmentModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var ticketId = button.getAttribute('data-ticket-id');
                var clasification = button.getAttribute('data-clasification');
                var details = button.getAttribute('data-details');
                var status = button.getAttribute('data-status');
                var author = button.getAttribute('data-author');
                var accountableName = button.getAttribute('data-accountable-name');
                var divisionName = button.getAttribute('data-division-name');
                var createdAt = button.getAttribute('data-created-at');
                var updatedAt = button.getAttribute('data-updated-at');

                var modalTicketId = assignmentModal.querySelector('#modal-ticket-id');
                var modalClasification = assignmentModal.querySelector('#modal-clasification');
                var modalDetails = assignmentModal.querySelector('#modal-details');
                var modalStatus = assignmentModal.querySelector('#modal-status');
                var modalAuthor = assignmentModal.querySelector('#modal-author');
                var modalAccountableName = assignmentModal.querySelector('#modal-accountable-name');
                var modalDivisionName = assignmentModal.querySelector('#modal-division-name');
                var modalCreatedAt = assignmentModal.querySelector('#modal-created-at');
                var modalUpdatedAt = assignmentModal.querySelector('#modal-updated-at');

                modalTicketId.textContent = ticketId;
                modalClasification.textContent = clasification;
                modalDetails.textContent = details;
                modalStatus.textContent = status;
                modalAuthor.textContent = author;
                modalAccountableName.textContent = accountableName;
                modalDivisionName.textContent = divisionName;
                modalCreatedAt.textContent = createdAt;
                modalUpdatedAt.textContent = updatedAt;
            });
        });
    </script>

@endsection
