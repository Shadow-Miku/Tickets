<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function assistantHome()
    {
        // User ID from authenticated user
        $assistantId = Auth::id();

        // Obtain the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Obtain the total number of tickets assigned
            //$assignedTickets = Ticket::where('status', 'assigned')->count();
        $assignedTickets = Ticket::whereHas('assignment', function ($query) use ($assistantId) {
                                $query->where('accountableid', $assistantId);
                            })
                            ->where('status', 'assigned')
                            ->whereMonth('created_at', $currentMonth)
                            ->whereYear('created_at', $currentYear)
                            ->count();

        // Obtain the total number of tickets pending
            //$pendingTickets = Ticket::where('status', 'pending')->count();
        $pendingTickets = Ticket::whereHas('assignment', function ($query) use ($assistantId) {
                                $query->where('accountableid', $assistantId);
                            })
                            ->where('status', 'pending')
                            ->whereMonth('created_at', $currentMonth)
                            ->whereYear('created_at', $currentYear)
                            ->count();

        // Obtain the total number of tickets completed
            //$resolvedTickets = Ticket::where('status', 'completed')->count();
        $resolvedTickets = Ticket::whereHas('assignment', function ($query) use ($assistantId) {
                                $query->where('accountableid', $assistantId);
                            })
                            ->where('status', 'completed')
                            ->whereMonth('created_at', $currentMonth)
                            ->whereYear('created_at', $currentYear)
                            ->count();

        return view('landing', compact(
            'assignedTickets',
            'pendingTickets',
            'resolvedTickets'));
    }

    public function adminHome()
    {
        // Obtain the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Obtain the total number of users
        $totalUsers = User::count();

        // Obtain the total number of tickets
            //$totalTickets = Ticket::count();
        $totalTickets = Ticket::whereMonth('created_at', $currentMonth)
                            ->whereYear('created_at', $currentYear)
                            ->count();

        // Obtain the total number of tickets assigned
            //$assignedTickets = Ticket::where('status', 'assigned')->count();
        $assignedTickets = Ticket::where('status', 'assigned')
                            ->whereMonth('created_at', $currentMonth)
                            ->whereYear('created_at', $currentYear)
                            ->count();

        // Obtain the total number of tickets pending
            //$pendingTickets = Ticket::where('status', 'pending')->count();
        $pendingTickets = Ticket::where('status', 'pending')
                            ->whereMonth('created_at', $currentMonth)
                            ->whereYear('created_at', $currentYear)
                            ->count();

        // Obtain the total number of tickets completed
            //$resolvedTickets = Ticket::where('status', 'completed')->count();
        $resolvedTickets = Ticket::where('status', 'completed')
                            ->whereMonth('created_at', $currentMonth)
                            ->whereYear('created_at', $currentYear)
                            ->count();

        // Return the view with the data
        return view('dashboard', compact(
            'totalUsers',
            'totalTickets',
            'assignedTickets',
            'pendingTickets',
            'resolvedTickets'
        ));
    }


}
