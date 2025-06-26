<?php

namespace App\Http\Controllers\Web\General;

use App\Http\Controllers\Controller;
use App\Models\Icon;
use Illuminate\Http\Request;

class IconController extends Controller
{
    public function index()
    {
        $icons = Icon::latest()->get();
        return view('admin.web.general.icons.index', compact('icons'));
    }

    public function create()
    {
        return view('admin.web.general.icons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'picture2' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'title' => 'required|string|max:255',
        ]);

        $data = $request->only(['title']);

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('uploads/pics', 'public');
            $data['picture'] = basename($path);
        }

        if ($request->hasFile('picture2')) {
            $path2 = $request->file('picture2')->store('uploads/pics', 'public');
            $data['picture2'] = basename($path2);
        }

        Icon::create($data);

        return redirect()->route('admin.web.general.icons.index')->with('success', 'Icon created successfully.');
    }

    public function edit(Icon $icon)
    {
        return view('admin.web.general.icons.edit', compact('icon'));
    }

    public function update(Request $request, Icon $icon)
    {
        $request->validate([
            'picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'picture2' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'title' => 'required|string|max:255',
        ]);

        $data = $request->only(['title']);

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('uploads/pics', 'public');
            $data['picture'] = basename($path);
        }

        if ($request->hasFile('picture2')) {
            $path2 = $request->file('picture2')->store('uploads/pics', 'public');
            $data['picture2'] = basename($path2);
        }

        $icon->update($data);

        return redirect()->route('admin.web.general.icons.index')->with('success', 'Icon updated successfully.');
    }

    public function destroy(Icon $icon)
    {
        $icon->delete();
        return back()->with('success', 'Icon deleted successfully.');
    }
}
