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

    public function edit($carId, $jobId)
    {
        $job = CarJob::where('id', $jobId)->where('car_id', $carId)->firstOrFail();
        return view('admin/car/jobs/edit', compact('job'));
    }

    public function update(Request $request, $carId, $jobId)
    {
        $validated = $request->validate([
            'job_description' => 'required|string|max:255',
        ]);

        $job = CarJob::where('id', $jobId)->where('car_id', $carId)->firstOrFail();
        $job->update([
            'job_description' => $validated['job_description'],
        ]);

        return redirect()->route('admin/cars/show', $carId)->with('success', 'Job updated successfully!');
    }

    public function destroy($carId, $jobId)
    {
        $job = CarJob::where('id', $jobId)->where('car_id', $carId)->firstOrFail();
        $job->delete();

        return redirect()->route('admin/cars/show', $carId)->with('success', 'Job deleted successfully!');
    }

    public function showJobs($carId)
    {
        
        $car = Car::with('jobs')->findOrFail($carId);

        return view('cars/jobs', compact('car'));
    }



}
