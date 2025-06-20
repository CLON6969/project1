<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\services_table;
use Illuminate\Http\Request;

class WebServicesTableController extends Controller
{
    public function index()
    {
        $records = services_table::latest()->get();
        return view('admin.web.services.table.index', compact('records'));
    }

    public function create()
    {
        return view('admin.web.services.table.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'title1' => 'required|string|max:255',
            'title1_sub_content' => 'nullable|string',
            'button1_name' => 'nullable|string|max:255',
            'button1_url' => 'nullable|url|max:255',
            'category' => 'nullable|string|max:255',
        ]);

        services_table::create($request->only([
            'icon',
            'title1',
            'title1_sub_content',
            'button1_name',
            'button1_url',
            'category'
        ]));

        return redirect()->route('admin.web.services.table.index')->with('success', 'Service item created successfully.');
    }

    public function edit(services_table $table)
    {
        return view('admin.web.services.table.edit', compact('table'));
    }

    public function update(Request $request, services_table $table)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'title1' => 'required|string|max:255',
            'title1_sub_content' => 'nullable|string',
            'button1_name' => 'nullable|string|max:255',
            'button1_url' => 'nullable|url|max:255',
            'category' => 'nullable|string|max:255',
        ]);

        $table->update($request->only([
            'icon',
            'title1',
            'title1_sub_content',
            'button1_name',
            'button1_url',
            'category'
        ]));

        return redirect()->route('admin.web.services.table.index')->with('success', 'Service item updated successfully.');
    }

    public function destroy(services_table $table)
    {
        $table->delete();
        return back()->with('success', 'Service item deleted successfully.');
    }
}
