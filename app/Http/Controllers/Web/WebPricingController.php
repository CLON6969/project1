<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pricing;

class WebPricingController extends Controller
{
    public function edit()
    {
        $pricing = pricing::first(); // Assumes there's only one row
        return view('admin.web.pricing.edit', compact('pricing'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title1' => 'required|string|max:255',
            'title2' => 'nullable|string|max:255',
            'title2_content' => 'nullable|string',
            'title3' => 'nullable|string|max:255',
            'title4' => 'nullable|string|max:255',
        ]);

        $pricing = pricing::first() ?? new pricing();

        $pricing->fill($request->only([
            'title1',
            'title2',
            'title2_content',
            'title3',
            'title4',
        ]));

        $pricing->save();

        return redirect()->route('admin.web.pricing.edit')->with('success', 'Pricing content updated successfully.');
    }
}
