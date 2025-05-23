<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solution;
use App\Models\SolutionTable;

class SolutionController extends Controller
{
    public function showSolutions()
    {
        $solutions = Solution::all();
        $solutionTables = SolutionTable::all();

        return view('solutions', compact('solutions', 'solutionTables'));
    }

    // This method shows the detail view for a single solution table
    public function showDetail($id)
    {
        $table = SolutionTable::findOrFail($id);
        return view('solutions.show', compact('table'));
    }
}
