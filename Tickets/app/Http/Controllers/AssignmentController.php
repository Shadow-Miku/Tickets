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

        // Crear la asignación y guardar en la base de datos
        $assignment = Assignment::create([
            'ticketid' => $request->ticketid,
            'accountableid' => $request->accountableid,
        ]);

        // Cambiar el estado del ticket a 'Assigned'
        Ticket::where('id', $request->ticketid)->update(['status' => 'Assigned']);

        // Crear un registro en la tabla de chats utilizando el ID de la asignación
        Chat::create([
            'assignment_id' => $assignment->id,
            'answer' => null,
            'comentary' => null,
            'observation' => null,
        ]);

        return redirect()->route('admin/assignedtickets')->with('success', 'Ticket assigned successfully');
    }

    // Show the form for editing the specified resource.
    public function edit(string $id)
    {
        //
    }

    // Update the specified resource in storage.

    public function update(Request $request, string $id)
    {
        //
    }

    // Remove the specified resource from storage.

    public function destroy(string $id)
    {
        //
    }

    public function indexAssignedAssistant(Request $request)
    {
        // Obtener el ID del usuario logeado
        $userId = auth()->user()->id;

        $query = Ticket::query();

        // Filtrar los tickets que están asignados al usuario logeado
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
            $query->where('status', 'Assigned');
        }

        if ($request->filled('author')) {
            $query->whereHas('author', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->author . '%');
            });
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // Traer los tickets con las relaciones necesarias
        $tickets = $query->with(['author.division', 'assignment.accountable'])->orderBy('created_at', 'DESC')->get();
        $divisions = Division::all();

        return view('tickets.assistant.indexassistant', compact('tickets', 'divisions'));
    }

}