@extends('layouts.user')

@section('title', 'My Tickets')

@section('contents')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 font-weight-bold">Registered Tickets</h1>
        <a href="{{ route('user/tickets/create') }}" class="btn btn-primary">New</a>
    </div>
    <hr/>

    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Classification</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($ticket->count() > 0)
                    @foreach($ticket as $tk)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $tk->clasification }}</td>
                            <td>{{ $tk->status }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#ticketModal"
                                       data-ticket-id="{{ $tk->id }}"
                                       data-clasification="{{ $tk->clasification }}"
                                       data-details="{{ $tk->details }}"
                                       data-answer="{{ $tk->answer }}"
                                       data-status="{{ $tk->status }}"
                                       data-observation="{{ $tk->observation }}">
                                        Details
                                    </a>

                                    @if($tk->status !== 'Cancelled' && $tk->status !== 'Never Solved' && $tk->status !== 'Completed')
                                        @if($tk->assignment && $tk->assignment->chat)
                                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#answerModal"
                                               data-answer="{{ $tk->assignment->chat->first()->answer }}"
                                               data-chat-id="{{ $tk->assignment->chat->first()->id }}">
                                                Reply
                                            </a>
                                        @endif
                                    @endif

                                    @if($tk->status !== 'Cancelled' && $tk->status !== 'Assigned' && $tk->status !== 'In process' && $tk->status !== 'Never Solved' && $tk->status !== 'Completed')
                                        <a href="{{ route('user/tickets/edit', $tk->id)}}" class="btn btn-success btn-sm">Edit</a>
                                        <form action="{{ route('user/tickets/cancell', $tk->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-secondary btn-sm" disabled>Edit</button>
                                        <button type="button" class="btn btn-secondary btn-sm" disabled>Delete</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center">No Tickets registered</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Modal for ticket details -->
    <div class="modal fade" id="ticketModal" tabindex="-1" aria-labelledby="ticketModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ticketModalLabel">Ticket Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Ticket ID:</strong> <span id="modal-ticket-id"></span></p>
                    <p><strong>Classification:</strong> <span id="modal-clasification"></span></p>
                    <p><strong>Details:</strong> <span id="modal-details"></span></p>
                    <p><strong>Status:</strong> <span id="modal-status"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Modal -->
    <div class="modal fade" id="answerModal" tabindex="-1" aria-labelledby="answerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="answerModalLabel">Answer from the Support Team</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="answerText"></p>
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

    <!-- Comment Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">Reply to the Support Team</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.chats.reply') }}" method="POST">
                    @csrf
                    <input type="hidden" name="chat_id" id="chatId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="comentary" class="form-label">Your Comment</label>
                            <textarea class="form-control" id="comentary" name="comentary" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Send Reply</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
