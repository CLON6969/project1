<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomepageContent;
use Illuminate\Support\Facades\Storage;

class HomepageContentController extends Controller
{
    public function edit()
    {
        $content = HomepageContent::first();
        return view('admin.web.homepage.content.edit', compact('content'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title1' => 'required|string|max:255',
            'title1_content' => 'nullable|string',
            'title2' => 'required|string|max:255',
            'title2_content' => 'nullable|string',
            'background_picture' => 'nullable|image',
            'picture1' => 'nullable|image',
        ]);

        $content = HomepageContent::first();

        $content->title1 = $request->title1;
        $content->title1_content = $request->title1_content;
        $content->title2 = $request->title2;
        $content->title2_content = $request->title2_content;

        if ($request->hasFile('background_picture')) {
            $filename = $request->file('background_picture')->store('uploads/pics', 'public');
            $content->background_picture = basename($filename);
        }

        if ($request->hasFile('picture1')) {
            $filename = $request->file('picture1')->store('uploads/pics', 'public');
            $content->picture1 = basename($filename);
        }

        $content->save();

        return redirect()->route('admin.web.homepage.content.edit')->with('success', 'Homepage content updated successfully.');
    }
}
