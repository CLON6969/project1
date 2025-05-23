<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\services; // if you're using this for the main services section
use App\Models\services_table; // the detailed service rows

class ServicesController extends Controller
{
    // Display the list of services and their summary cards
    public function showSolutions()
    {
        $services = services::all(); // Main top-level service info
        $services_table = services_table::all(); // Card content

        return view('services', compact('services', 'services_table'));
    }

    // Show a single service detail page based on the service_table row
    public function show($id)
    {
        $service = services_table::findOrFail($id);

        return view('services.show', compact('service'));
    }
}
