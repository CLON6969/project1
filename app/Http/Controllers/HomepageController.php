<?php

namespace App\Http\Controllers;

use App\Models\HomepageContent;
use App\Models\HomepageContentTable;
use App\Models\Package;
use App\Models\CompanyStatement;

class HomepageController extends Controller
{
    public function index()
    {
         $homepageContentTable = HomepageContentTable::all();
        $homepageContent = HomepageContent::first(); // Get the first row of content
        $packages = Package::with('plans.features')->get(); // Load packages with plans and features
        $statements = CompanyStatement::all(); // Get all company statements (mission, vision, etc.)

        return view('welcome', compact('homepageContent', 'packages', 'statements', 'homepageContentTable')); // Pass to view
    }
}
