<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Change;

class ChangeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $changes = Change::orderBy('created_at', 'desc')
               ->take(10)
               ->get();

        return view('changes.index', compact('changes'));
    }
}
