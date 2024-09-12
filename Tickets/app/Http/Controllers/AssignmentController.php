<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Chat;
use App\Models\Division;
use App\Models\Ticket;
use App\Models\User;

class AssignmentController extends Controller
{
    // Display a listing of the resource.
    public function indexAssignedAdmin(Request $request) // View all the Tickets (admin)
    {
        $query = Ticket::query();

        if ($request->filled('division')) {
            $query->whereHas('author.division', function($q) use ($request) {
                $q->where('id', $request->division);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('author')) {
            $query->whereHas('author', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->author . '%');
            });
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $tickets = $query->with(['author.division', 'assignment.accountable'])->orderBy('created_at', 'DESC')->get();
        $divisions = Division::all();

        return view('tickets.admin.indexassigned', compact('tickets', 'divisions'));
    }

    // Show the form for creating a new ticket assignment.

    public function assignAdmin($id) // Create Ticket Assignment
    {
        $ticket = \App\Models\Ticket::findOrFail($id);

        $supportDivision = \App\Models\Division::where('name', 'support')->first();
        $assistants = $supportDivision
            ? \App\Models\User::where('divisionid', $supportDivision->id)
                ->where('type', '!=', '1') // exclude admins type = (1)
                ->get()
            : collect();

        $tickets = \App\Models\Ticket::where('status', 'Pending')->get(); // filter just the pending tickets

        return view('tickets.admin.assignadmin', compact('tickets', 'assistants','ticket'));
    }

    // Store a newly created resource in storage.

    public function storeAssigment(Request $request)  // Store Ticket Assignment
    {
        $request->validate([
            'ticketid' => 'required|exists:tickets,id',
            'accountableid' => 'required|exists:users,id',
        ]);

        // Creates the assignment and saves it in the database
        $assignment = Assignment::create([
            'ticketid' => $request->ticketid,
            'accountableid' => $request->accountableid,
        ]);

        // Changes the status of the ticket to 'Assigned'
        Ticket::where('id', $request->ticketid)->update(['status' => 'Assigned']);

        // Create a chat record using the assignment ID
        Chat::create([
            'assignment_id' => $assignment->id,
            'answer' => null,
            'comentary' => null,
            'observation' => null,
        ]);

        return redirect()->route('admin.assignedtickets')->with('success', 'Ticket assigned successfully');
    }

    // Assistant Functions
    public function indexAssignedAssistant(Request $request)
    {
        // Obtains the ID of the current user
        $userId = auth()->user()->id;

        // Filters the tickets that are assigned to the user
        $query = Ticket::query();
        $query->whereHas('assignment', function ($q) use ($userId) {
            $q->where('accountableid', $userId);
        });

        if ($request->filled('division')) {
            $query->whereHas('author.division', function ($q) use ($request) {
                $q->where('id', $request->division);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else {
            $query->where(function ($q) {
                $q->where('status', 'Assigned')
                ->orWhere('status', 'In process');
            });
        }

        if ($request->filled('author')) {
            $query->whereHas('author', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->author . '%');
            });
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // Filters the tickets by the necessary fields
        $tickets = $query->with(['author.division', 'assignment.accountable'])->orderBy('created_at', 'DESC')->get();
        $divisions = Division::all();

        return view('tickets.assistant.indexassistant', compact('tickets', 'divisions'));
    }

    public function attend(string $id)
    {
        // Filters the ticket and the chat for the specified assignment
        $ticket = Ticket::findOrFail($id);
        $chat = Chat::where('assignment_id', $ticket->assignment->id)->first();

        return view('tickets.assistant.editassistant', compact('ticket', 'chat'));
    }

    public function updateAttend(Request $request, string $id)
    {
        // Validates the request
        $request->validate([
            'status' => 'required|string',
            'answer' => 'required|string',
        ]);

        // Updates the status of the ticket
        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            'status' => $request->input('status'),
        ]);

        // Updates the answer of the chat associated
        $chat = Chat::where('assignment_id', $ticket->assignment->id)->first();
        $chat->update([
            'answer' => $request->input('answer'),
        ]);

        return redirect()->route('assistant/tickets')->with('success', 'The ticket has been attended successfully');
    }

}
