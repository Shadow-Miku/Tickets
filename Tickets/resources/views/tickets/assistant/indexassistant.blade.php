@extends('layouts.assistant')

@section('title', 'Assigned Tickets')

@section('contents')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 fw-bold">Assigned Tickets</h1>
    </div>
    <hr class="mb-4"/>

    <!-- Search form -->

    <form method="GET" action="{{ route('assistant/tickets') }}" class="row g-3 mb-4">
        <div class="col-md-2">
            <select name="division" class="form-select">
                <option value="">Select Division</option>
                @foreach($divisions as $division)
                    <option value="{{ $division->id }}" {{ request('division') == $division->id ? 'selected' : '' }}>
                        {{ $division->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">Select Status</option>
                <option value="Assigned" {{ request('status') == 'Assigned' ? 'selected' : '' }}>Assigned</option>
                <option value="In process" {{ request('status') == 'In process' ? 'selected' : '' }}>In process</option>
                <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="Never Solved" {{ request('status') == 'Never Solved' ? 'selected' : '' }}>Never Solved</option>
                <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="col-md-2">
            <input type="text" name="author" placeholder="Author" value="{{ request('author') }}" class="form-control" />
        </div>

        <div class="col-md-2">
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control" />
        </div>

        <div class="col-md-2">
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control" />
        </div>

        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

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

    <!-- Tickets Table -->
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Clasification</th>
                <th>Author</th>
                <th>Created at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($tickets->count() > 0)
                @foreach($tickets as $ticket)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $ticket->clasification }}</td>
                        <td>{{ $ticket->author->name }}</td>
                        <td>{{ $ticket->created_at }}</td>
                        <td>
                            <a href="#" class="btn btn-link text-primary" data-bs-toggle="modal" data-bs-target="#assignmentModal"
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
                            @if($ticket->status !== 'Cancelled'  && $ticket->status !== 'Never Solved' && $ticket->status !== 'Completed')
                                @if($ticket->assignment && $ticket->assignment->chat)
                                        <a href="#" class="btn btn-link text-primary" data-bs-toggle="modal" data-bs-target="#answerModal"
                                            data-answer="{{ $ticket->assignment->chat->first()->answer }}"
                                            data-coment="{{ $ticket->assignment->chat->first()->comentary }}"
                                            data-observation="{{ $ticket->assignment->chat->first()->observation }}"
                                            data-chat-id="{{ $ticket->assignment->chat->first()->id }}">
                                            Chat
                                        </a>
                                @endif
                            @endif
                            @if($ticket->status !== 'Cancelled'  && $ticket->status !== 'Never Solved' && $ticket->status !== 'Completed')
                                <a href="{{ route('assistant/tickets/attend', $ticket->id) }}" class="btn btn-link text-primary">Solve ticket</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">No tickets found.</td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Assignment Modal -->
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

    <!-- Chat Modal -->
    <div class="modal fade" id="answerModal" tabindex="-1" aria-labelledby="answerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="answerModalLabel">Answer from the Support Team</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Answer:</strong></p>
                    <p id="answerText"></p>

                    <p><strong>Comments:</strong></p>
                    <p id="comentText"></p>

                    <p><strong>Observations:</strong></p>
                    <p id="observationText"></p>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#replyModal"
                                data-chat-id="" id="replyButton">
                            Reply
                        </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Answer Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">observations to Support Team</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('assistant.chats.answer') }}" method="POST">
                    @csrf
                    <input type="hidden" name="chat_id" id="chatId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="answer" class="form-label">Your Answer</label>
                            <textarea class="form-control" id="answer" name="answer" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Send</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
