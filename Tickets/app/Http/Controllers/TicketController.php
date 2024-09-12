<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Division;
use App\Models\Assignment;

class TicketController extends Controller
{
    /**
     * Display a listing of the user tickets.
     */
    public function indexUser()
    {
        // ID from authenticated user
        $userId = auth()->user()->id;

        // Filtered tickets by user id
        $ticket = Ticket::where('autorid', $userId)
                        ->orderBy('created_at', 'DESC')
                        ->get();

        return view('tickets.user.indexuser', compact('ticket'));
    }

    /**
     * Show the form for creating a new ticket.
     */
    public function create()
    {
        return view('tickets.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Ticket::create($request->all());

        return redirect()->route('user/tickets')->with('success', 'Ticket created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editUser($id)
    {
        $ticket = Ticket::findOrFail($id);

        return view('tickets.user.edituser', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->update($request->all());

        return redirect()->route('user/tickets')->with('success', 'Ticket updated successfully');
    }

    /**
     * Remove the specified ticket from storage. (Pending usage)
     */
    public function cancell(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = 'Cancelled';
        $ticket->save();

        return redirect()->route('user/tickets')->with('success', 'Ticket status changed to Cancelled successfully');
    }

    public function generatePdfAdmin(Request $request)
    {
        $query = Ticket::query();
        // Obtener las divisiones
        $divisions = Division::all();

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

        return view('tickets.admin.ticketsPDF', compact('tickets'));
    }


}
