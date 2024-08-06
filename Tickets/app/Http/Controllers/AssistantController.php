<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AssistantController extends Controller
{
    public function assistantprofilepage()
    {
        return view('assistantprofile');
    }
}
