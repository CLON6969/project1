<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\HomepageContentTable;
use Illuminate\Http\Request;

class HomepageContentTableController extends Controller
{
    public function index()
    {
        $records = HomepageContentTable::latest()->get();
        return view('admin.web.homepage.table.index', compact('records'));
    }

    public function create()
    {
        return view('admin.web.homepage.table.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url_name' => 'required|string|max:255',
            'url' => 'required|url',
            'picture' => 'required|image|max:2048',
        ]);

        $path = $request->file('picture')->store('uploads/pics', 'public');

        HomepageContentTable::create([
            'url_name' => $request->url_name,
            'url' => $request->url,
            'picture' => $path,
        ]);

        return redirect()->route('admin.web.homepage.table.index')->with('success', 'Content added successfully.');
    }

    public function edit(HomepageContentTable $table)
    {
        return view('admin.web.homepage.table.edit', compact('table'));
    }

    public function update(Request $request, HomepageContentTable $table)
    {
        $request->validate([
            'url_name' => 'required|string|max:255',
            'url' => 'required|url',
            'picture' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['url_name', 'url']);

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('uploads/pics', 'public');
        }

        $table->update($data);

        return redirect()->route('admin.web.homepage.table.index')->with('success', 'Content updated successfully.');
    }

    public function destroy(HomepageContentTable $table)
    {
        $table->delete();
        return back()->with('success', 'Content deleted successfully.');
    }
}
