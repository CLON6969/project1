<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Plan;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebPackageController extends Controller
{
    // --- Index all packages with their plans and features ---
    public function index()
    {
        $packages = Package::with('plans.features')->latest()->get();
        return view('admin.web.package.index', compact('packages'));
    }

    // --- Show create form ---
    public function create()
    {
        return view('admin.web.package.create');
    }

    // --- Store package with plans and features ---
    public function store(Request $request)
    {
        $request->validate([
            'package_tittle' => 'required|string|max:255',
            'statement' => 'nullable|string',
            // other package fields...

            'plans' => 'required|array',
            'plans.*.plan_tittle' => 'required|string|max:255',
            'plans.*.amount' => 'required|numeric',
            'plans.*.currency' => 'required|string|max:10',
            'plans.*.features' => 'nullable|array',
            'plans.*.features.*.name' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            $package = Package::create($request->only([
                'package_tittle', 'statement', 'tittle1', 'tittle1_content',
                'tittle2', 'tittle2_content', 'tittle3', 'tittle3_content',
                'tittle4', 'tittle4_content', 'tittle5', 'tittle5_content'
            ]));

            foreach ($request->plans as $planData) {
                $features = $planData['features'] ?? [];
                unset($planData['features']);
                $plan = $package->plans()->create($planData);

                foreach ($features as $featureData) {
                    $plan->features()->create($featureData);
                }
            }
        });

        return redirect()->route('admin.web.package.index')->with('success', 'Package created successfully with plans and features.');
    }

    // --- Show edit form ---
    public function edit(Package $package)
    {
        $package->load('plans.features');
        return view('admin.web.package.edit', compact('package'));
    }

    // --- Update package with plans and features ---
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'package_tittle' => 'required|string|max:255',
            'statement' => 'nullable|string',

            'plans' => 'required|array',
            'plans.*.id' => 'nullable|exists:plans,id',
            'plans.*.plan_tittle' => 'required|string|max:255',
            'plans.*.amount' => 'required|numeric',
            'plans.*.currency' => 'required|string|max:10',
            'plans.*.features' => 'nullable|array',
            'plans.*.features.*.id' => 'nullable|exists:features,id',
            'plans.*.features.*.name' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request, $package) {
            $package->update($request->only([
                'package_tittle', 'statement', 'tittle1', 'tittle1_content',
                'tittle2', 'tittle2_content', 'tittle3', 'tittle3_content',
                'tittle4', 'tittle4_content', 'tittle5', 'tittle5_content'
            ]));

            // Sync plans
            $existingPlanIds = $package->plans()->pluck('id')->toArray();
            $newPlanIds = [];

            foreach ($request->plans as $planData) {
                $features = $planData['features'] ?? [];
                unset($planData['features']);

                if (isset($planData['id'])) {
                    $plan = Plan::find($planData['id']);
                    $plan->update($planData);
                } else {
                    $plan = $package->plans()->create($planData);
                }
                $newPlanIds[] = $plan->id;

                // Sync features
                $existingFeatureIds = $plan->features()->pluck('id')->toArray();
                $newFeatureIds = [];

                foreach ($features as $featureData) {
                    if (isset($featureData['id'])) {
                        $feature = Feature::find($featureData['id']);
                        $feature->update($featureData);
                    } else {
                        $feature = $plan->features()->create($featureData);
                    }
                    $newFeatureIds[] = $feature->id;
                }

                // Delete removed features
                $plan->features()->whereNotIn('id', $newFeatureIds)->delete();
            }

            // Delete removed plans
            $package->plans()->whereNotIn('id', $newPlanIds)->delete();
        });

        return redirect()->route('admin.web.package.index')->with('success', 'Package updated successfully.');
    }

    // --- Delete package and related plans/features ---
    public function destroy(Package $package)
    {
        $package->delete(); // Cascade should be handled in DB or with model events
        return back()->with('success', 'Package deleted successfully.');
    }
}
