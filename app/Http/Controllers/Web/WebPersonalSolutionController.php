<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\personal_solution;

class WebPersonalSolutionController extends Controller
{
    public function edit()
    {
        $solution = personal_solution::first(); // Assumes single record
        return view('admin.web.solution.personal.edit', compact('solution'));
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
            'picture1' => 'nullable|image',
            'title3' => 'nullable|string|max:255',
            'title3_content' => 'nullable|string',
            'button3_name' => 'nullable|string|max:255',
            'button3_url' => 'nullable|url',
            'background_picture' => 'nullable|image',
        ]);

        $solution = personal_solution::first() ?? new personal_solution();

        $solution->fill($request->only([
            'title1',
            'title1_content',
            'button1_name',
            'button1_url',
            'button2_name',
            'button2_url',
            'title2',
            'title3',
            'title3_content',
            'button3_name',
            'button3_url'
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

        return redirect()->route('admin.web.solution.personal.edit')->with('success', 'Solution content updated successfully.');
    }
}
