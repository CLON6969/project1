<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\services;

class WebServicesController extends Controller
{
    public function edit()
    {
        $service = services::first(); // Load the first service entry
        return view('admin.web.services.edit', compact('service'));
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
            'background_picture' => 'nullable|image',
        ]);

        $service = services::first();

        $service->title1 = $request->title1;
        $service->title1_content = $request->title1_content;
        $service->button1_name = $request->button1_name;
        $service->button1_url = $request->button1_url;
        $service->button2_name = $request->button2_name;
        $service->button2_url = $request->button2_url;
        $service->title2 = $request->title2;
        $service->title3 = $request->title3;
        $service->title3_content = $request->title3_content;

        if ($request->hasFile('background_picture')) {
            $filename = $request->file('background_picture')->store('uploads/pics', 'public');
            $service->background_picture = basename($filename);
        }

        if ($request->hasFile('picture1')) {
            $filename = $request->file('picture1')->store('uploads/pics', 'public');
            $service->picture1 = basename($filename);
        }

        $service->save();

        return redirect()->route('admin.web.services.edit')->with('success', 'Services content updated successfully.');
    }
}
