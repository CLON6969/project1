<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\personal_solution;
use App\Models\SolutionTable;

class Personal_solutionsController extends Controller
{
    public function showSolutions()
    {
        $personal_solutions = personal_solution::all(); // Fetch all records from the solutions table
        $solutionTables = SolutionTable::all(); // Fetch allsrecords from the solution_tables table

        return view('personal_solutions', compact('personal_solutions', 'solutionTables'));
    }


    // This method shows the detail view for a single solution table
    public function showDetail($id)
    {
        $table = SolutionTable::findOrFail($id);
        return view('personal_solutions.show', compact('table'));
    }


}
