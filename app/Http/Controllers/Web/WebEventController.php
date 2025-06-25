<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class WebEventController extends Controller
{
    public function edit()
    {
        $event = Event::first(); // Assuming only one row exists
        return view('admin.web.event.edit', compact('event'));
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
            'background_picture' => 'nullable|image',
        ]);

        $event = Event::first() ?? new Event();

        $event->fill($request->only([
            'title1',
            'title1_content',
            'button1_name',
            'button1_url',
            'button2_name',
            'button2_url',
            'title2'
        ]));

        if ($request->hasFile('background_picture')) {
            $filename = $request->file('background_picture')->store('uploads/pics', 'public');
            $event->background_picture = basename($filename);
        }

        $event->save();

        return redirect()->route('admin.web.event.edit')->with('success', 'Event content updated successfully.');
    }
}
