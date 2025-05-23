<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Pricing;
use Illuminate\Support\Facades\View;

class PackageController extends Controller
{
    // Show initial pricing page
    public function pricingPage()
    {
        $pricing = Pricing::all();
        $packages = Package::with('plans.features')->get();
        
        return view('pricing', compact('packages', 'pricing'));
    }

    // Load more packages (AJAX)
public function loadMore(Request $request)
{
    $offset = (int) $request->query('offset', 0);

    $packages = Package::with('plans.features')
                ->skip($offset)
                ->take(2)
                ->get();

    $html = '';

    foreach ($packages as $package) {
        $html .= view('components.package', compact('package'))->render();
    }

    return response($html);
}

}
