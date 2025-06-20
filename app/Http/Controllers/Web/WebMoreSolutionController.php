<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\more;

class WebMoreSolutionController extends Controller
{
    public function edit()
    {
        $solution = more::first(); // Assumes only one row
        return view('admin.web.solution.more.edit', compact('solution'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title1' => 'required|string|max:255',
            'title1_content' => 'nullable|string',
            'button1_name' => 'nullable|string|max:255',
            'button1_url' => 'nullable|url',
            'button2_name' => 'nullable|string|max:255',
            'button2_url' => 'nullable|url',
            'title2' => 'required|string|max:255',
            'title2_content' => 'nullable|string',
            'picture1' => 'nullable|image',
            'background_picture' => 'nullable|image',
        ]);

        $solution = more::first() ?? new more();

        $solution->fill($request->only([
            'title1',
            'title1_content',
            'button1_name',
            'button1_url',
            'button2_name',
            'button2_url',
            'title2',
            'title2_content'
        ]));

        if ($request->hasFile('background_picture')) {
            $filename = $request->file('background_picture')->store('uploads/pics', 'public');
            $solution->background_picture = basename($filename);
        }

        if ($request->hasFile('picture1')) {
            $filename = $request->file('picture1')->store('uploads/pics', 'public');
            $solution->picture1 = basename($filename);
        }

        $solution->save();

        return redirect()->route('admin.web.solution.more.edit')->with('success', 'More solution content updated successfully.');
    }
}
