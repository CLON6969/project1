<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\more_table;

class WebMoreTableController extends Controller
{
    protected $category = 'industrial'; // Optional, if you still want to filter by category

    public function index()
    {
        // If there's a 'category' column, you can filter by it; otherwise, just fetch all
        $records = more_table::where('category', $this->category)->latest()->get();
        return view('admin.web.solution.more.table.index', compact('records'));
    }

    public function create()
    {
        return view('admin.web.solution.more.table.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'title1' => 'required|string|max:255',
            'title1_sub_content' => 'nullable|string',
            'title2' => 'nullable|string|max:255',
            'title2_content' => 'nullable|string',
            'title2_sub_content' => 'nullable|string',
            'button1_name' => 'nullable|string|max:255',
            'button1_url' => 'nullable|url|max:255',
        ]);

        more_table::create([
            'icon' => $request->icon,
            'title1' => $request->title1,
            'title1_sub_content' => $request->title1_sub_content,
            'title2' => $request->title2,
            'title2_content' => $request->title2_content,
            'title2_sub_content' => $request->title2_sub_content,
            'button1_name' => $request->button1_name,
            'button1_url' => $request->button1_url,
            'category' => $this->category, // if your table has a category field
        ]);

        return redirect()->route('admin.web.solution.more.table.index')->with('success', 'More table item created successfully.');
    }

    public function edit(more_table $table)
    {
        return view('admin.web.solution.more.table.edit', compact('table'));
    }

    public function update(Request $request, more_table $table)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'title1' => 'required|string|max:255',
            'title1_sub_content' => 'nullable|string',
            'title2' => 'nullable|string|max:255',
            'title2_content' => 'nullable|string',
            'title2_sub_content' => 'nullable|string',
            'button1_name' => 'nullable|string|max:255',
            'button1_url' => 'nullable|url|max:255',
        ]);

        $table->update($request->only([
            'icon',
            'title1',
            'title1_sub_content',
            'title2',
            'title2_content',
            'title2_sub_content',
            'button1_name',
            'button1_url'
        ]) + ['category' => $this->category]);

        return redirect()->route('admin.web.solution.more.table.index')->with('success', 'More table item updated successfully.');
    }

    public function destroy(more_table $table)
    {
        $table->delete();
        return back()->with('success', 'More table item deleted successfully.');
    }
}
