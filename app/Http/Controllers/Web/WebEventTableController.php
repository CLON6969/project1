<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventTable;

class WebEventTableController extends Controller
{
    public function index()
    {
        $records = EventTable::latest()->get();
        return view('admin.web.event.table.index', compact('records'));
    }

    public function create()
    {
        return view('admin.web.event.table.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'picture' => 'nullable|image',
            'title1' => 'required|string|max:255',
            'title1_content' => 'nullable|string',
            'country' => 'required|string|max:255',
            'town' => 'required|string|max:255',
            'main_tittle' => 'required|string|max:255',
            'main_tittle_content' => 'nullable|string',
            'day' => 'required|string|max:50',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'button1_name' => 'nullable|string|max:255',
            'button1_url' => 'nullable|url|max:255',
        ]);

        $data = $request->only([
            'title1',
            'title1_content',
            'country',
            'town',
            'main_tittle',
            'main_tittle_content',
            'day',
            'date',
            'start_time',
            'end_time',
            'button1_name',
            'button1_url',
        ]);

        if ($request->hasFile('picture')) {
            $filename = $request->file('picture')->store('uploads/events', 'public');
            $data['picture'] = basename($filename);
        }

        EventTable::create($data);

        return redirect()->route('admin.web.event.table.index')->with('success', 'Event created successfully.');
    }

    public function edit(EventTable $table)
    {
        return view('admin.web.event.table.edit', compact('table'));
    }

    public function update(Request $request, EventTable $table)
    {
        $request->validate([
            'picture' => 'nullable|image',
            'title1' => 'required|string|max:255',
            'title1_content' => 'nullable|string',
            'country' => 'required|string|max:255',
            'town' => 'required|string|max:255',
            'main_tittle' => 'required|string|max:255',
            'main_tittle_content' => 'nullable|string',
            'day' => 'required|string|max:50',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'button1_name' => 'nullable|string|max:255',
            'button1_url' => 'nullable|url|max:255',
        ]);

        $data = $request->only([
            'title1',
            'title1_content',
            'country',
            'town',
            'main_tittle',
            'main_tittle_content',
            'day',
            'date',
            'start_time',
            'end_time',
            'button1_name',
            'button1_url',
        ]);

        if ($request->hasFile('picture')) {
            $filename = $request->file('picture')->store('uploads/events', 'public');
            $data['picture'] = basename($filename);
        }

        $table->update($data);

        return redirect()->route('admin.web.event.table.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(EventTable $table)
    {
        $table->delete();
        return back()->with('success', 'Event deleted successfully.');
    }
}
