<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Division;

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

}
