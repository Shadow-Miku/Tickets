@extends('layouts.user')

@section('title', 'My Tickets')

@section('contents')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="font-bold text-2xl">Registered Tickets</h1>
        <a href="{{ route('user/tickets/create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">New</a>
    </div>
    <hr class="mb-4"/>

    @if(Session::has('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif

    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3">Clasification</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Accions</th>
            </tr>
        </thead>
        <tbody>
            @if($ticket->count() > 0)
                @foreach($ticket as $tk)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $tk->clasification }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $tk->status }}
                        </td>
                        <td class="px-6 py-4 w-36">
                            <div class="flex items-center space-x-2">
                                {{-- Button to view the ticket details --}}
                                <a href="#" class="text-blue-400 hover:text-blue-800" data-bs-toggle="modal" data-bs-target="#ticketModal"
                                   data-ticket-id="{{ $tk->id }}"
                                   data-clasification="{{ $tk->clasification }}"
                                   data-details="{{ $tk->details }}"
                                   data-answer="{{ $tk->answer }}"
                                   data-status="{{ $tk->status }}"
                                   data-observation="{{ $tk->observation }}">
                                    Details
                                </a>

                                {{-- Button to view the assistant's reply --}}
                                @if($tk->status !== 'Cancelled'  && $tk->status !== 'Never Solved' && $tk->status !== 'Completed')
                                    @if($tk->assignment && $tk->assignment->chat)
                                        <a href="#" class="text-yellow-400 hover:text-yellow-800" data-bs-toggle="modal" data-bs-target="#answerModal"
                                            data-answer="{{ $tk->assignment->chat->first()->answer }}"
                                            data-chat-id="{{ $tk->assignment->chat->first()->id }}">
                                            Reply
                                        </a>
                                    @endif
                                @endif
                                {{-- Buttons to edit or delete the ticket if the ticket is not in the cancelled, assigned or in process status --}}
                                @if($tk->status !== 'Cancelled' && $tk->status !== 'Assigned' && $tk->status !== 'In process')
                                    <a href="{{ route('user/tickets/edit', $tk->id)}}" class="text-green-400 hover:text-green-800">Edit</a>
                                    <form action="{{ route('user/tickets/cancell', $tk->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline-block text-red-600 hover:text-red-800">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit">Delete</button>
                                    </form>
                                @else
                                    <a class="text-green-800 cursor-not-allowed">Edit</a>
                                    <button type="button" disabled class="cursor-not-allowed inline-block text-red-800">Delete</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center px-6 py-4" colspan="4">No Tickets registered</td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Modal for ticket details -->
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

   <!-- Chat Modal -->
    <div class="modal fade" id="answerModal" tabindex="-1" aria-labelledby="answerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
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
        <div class="modal-dialog">
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
