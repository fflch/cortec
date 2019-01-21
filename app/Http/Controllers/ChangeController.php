<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Change;

class ChangeController extends Controller
{
    public function index()
    {
        $changes = Change::orderBy('created_at', 'desc')
               ->take(10)
               ->get();

        return view('changes.index', compact('changes'));
    }
}
