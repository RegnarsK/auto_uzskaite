<?php

namespace App\Http\Controllers;
use App\Models\Car;
use App\Models\CarJob;

use Illuminate\Http\Request;

class CarJobController extends Controller
{
    public function create($carId)
    {
        $car = Car::findOrFail($carId);
        return view('admin/car/jobs/create', compact('car'));
    }

    public function store(Request $request, $carId)
    {
        $validated = $request->validate([
            'job_description' => 'required|string',
        ]);

        $car = Car::findOrFail($carId);
        $car->jobs()->create([
            'job_description' => $validated['job_description']
        ]);

        return redirect()->route('admin/cars/show', $carId)->with('success', 'Job added successfully!');
    }
}
