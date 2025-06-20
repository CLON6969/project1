<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SolutionTable;
use Illuminate\Http\Request;

class WebPersonalSolutionTableController extends Controller
{
    protected $category = 'personal';

    public function index()
    {
        $records = SolutionTable::where('category', $this->category)->latest()->get();
        return view('admin.web.solution.personal.table.index', compact('records'));
    }

    public function create()
    {
        return view('admin.web.solution.personal.table.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'title1' => 'required|string|max:255',
            'title1_sub_content' => 'nullable|string',
            'button1_name' => 'nullable|string|max:255',
            'button1_url' => 'nullable|url|max:255',
        ]);

        SolutionTable::create([
            'icon' => $request->icon,
            'title1' => $request->title1,
            'title1_sub_content' => $request->title1_sub_content,
            'button1_name' => $request->button1_name,
            'button1_url' => $request->button1_url,
            'category' => $this->category,
        ]);

        return redirect()->route('admin.web.solution.personal.table.index')->with('success', 'Personal solution item created.');
    }

    public function edit(SolutionTable $table)
    {
        return view('admin.web.solution.personal.table.edit', compact('table'));
    }

    public function update(Request $request, SolutionTable $table)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'title1' => 'required|string|max:255',
            'title1_sub_content' => 'nullable|string',
            'button1_name' => 'nullable|string|max:255',
            'button1_url' => 'nullable|url|max:255',
        ]);

        $table->update($request->only([
            'icon', 'title1', 'title1_sub_content', 'button1_name', 'button1_url'
        ]) + ['category' => $this->category]);

        return redirect()->route('admin.web.solution.personal.table.index')->with('success', 'Personal solution item updated.');
    }

    public function destroy(SolutionTable $table)
    {
        $table->delete();
        return back()->with('success', 'Personal solution item deleted.');
    }
}
