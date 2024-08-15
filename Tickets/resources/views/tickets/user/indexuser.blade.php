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
                                <a href="#" class="text-blue-400 hover:text-blue-800" data-bs-toggle="modal" data-bs-target="#ticketModal"
                                   data-ticket-id="{{ $tk->id }}"
                                   data-clasification="{{ $tk->clasification }}"
                                   data-details="{{ $tk->details }}"
                                   data-answer="{{ $tk->answer }}"
                                   data-status="{{ $tk->status }}"
                                   data-observation="{{ $tk->observation }}">
                                    Details
                                </a>
                                @if($tk->status !== 'Cancelled' && $tk->status !== 'Assigned')
                                    <a href="{{ route('user/tickets/edit', $tk->id)}}" class="text-green-400 hover:text-green-800">Edit</a>
                                    <form action="{{ route('user/tickets/cancell', $tk->id) }}" method="PUT" onsubmit="return confirm('Delete?')" class="inline-block text-red-600 hover:text-red-800">
                                        @csrf
                                        <button type="submit">Delete</button>
                                    </form>
                                @else
                                    <a class="text-green-800 cursor-not-allowed">Edit</a>
                                    <form class="inline-block text-red-800 cursor-not-allowed">
                                        <button type="button" disabled class="cursor-not-allowed">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center px-6 py-4" colspan="5">No Tickets registered</td>
                </tr>
            @endif
        </tbody>
    </table>

<!-- Modal -->
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

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ticketModal = document.getElementById('ticketModal');
        ticketModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var ticketId = button.getAttribute('data-ticket-id');
            var clasification = button.getAttribute('data-clasification');
            var details = button.getAttribute('data-details');
            var status = button.getAttribute('data-status');

            var modalTicketId = ticketModal.querySelector('#modal-ticket-id');
            var modalClasification = ticketModal.querySelector('#modal-clasification');
            var modalDetails = ticketModal.querySelector('#modal-details');
            var modalStatus = ticketModal.querySelector('#modal-status');

            modalTicketId.textContent = ticketId;
            modalClasification.textContent = clasification;
            modalDetails.textContent = details;
            modalStatus.textContent = status;
        });
    });
</script>
@endsection
