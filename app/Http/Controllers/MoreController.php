<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\more;
use App\Models\more_table;

class MoreController extends Controller
{
    public function showSolutions()
    {
        $more = more::all(); // Fetch all records from the solutions table
        $more_table = more_table::all(); // Fetch all records from the solution_tables table

        return view('more', compact('more', 'more_table'));
    }
}
