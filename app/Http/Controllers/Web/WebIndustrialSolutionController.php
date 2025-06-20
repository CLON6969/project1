<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Solution;

class WebIndustrialSolutionController extends Controller
{
    public function edit()
    {
        $solution = Solution::first(); // Load the first (and only) solution entry
        return view('admin.web.solution.industrial.edit', compact('solution'));
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

        $solution = Solution::first();

        $solution->title1 = $request->title1;
        $solution->title1_content = $request->title1_content;
        $solution->button1_name = $request->button1_name;
        $solution->button1_url = $request->button1_url;
        $solution->button2_name = $request->button2_name;
        $solution->button2_url = $request->button2_url;
        $solution->title2 = $request->title2;
        $solution->title3 = $request->title3;
        $solution->title3_content = $request->title3_content;
        $solution->button3_name = $request->button3_name;
        $solution->button3_url = $request->button3_url;

        if ($request->hasFile('background_picture')) {
            $filename = $request->file('background_picture')->store('uploads/pics', 'public');
            $solution->background_picture = basename($filename);
        }

        if ($request->hasFile('picture1')) {
            $filename = $request->file('picture1')->store('uploads/pics', 'public');
            $solution->picture1 = basename($filename);
        }

        $solution->save();

        return redirect()->route('admin.web.solution.industrial.edit')->with('success', 'Solution content updated successfully.');
    }
}



