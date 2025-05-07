<?php

namespace App\Http\Controllers;
use App\Models\Car;
use App\Models\CarJob;
use App\Models\User;


use Illuminate\Http\Request;

class CarJobController extends Controller
{
    public function create($carId)
    {

        $car = Car::findOrFail($carId);
        $workers = User::where('usertype', 'user')->get(); // Only mechanics
    
        return view('admin/car/jobs/create', compact('car', 'workers'));
    }

    public function store(Request $request, $carId)
    {
        $validated = $request->validate([
            'job_description' => 'required|string',
            'worker_id' => 'nullable|exists:users,id',
        ]);

        $car = Car::findOrFail($carId);
        $car->jobs()->create([
            'job_description' => $validated['job_description'],
            'worker_id' => $validated['worker_id'] ?? null, 
            'status' => $validated['worker_id'] ? 'assigned' : 'unassigned',
        ]);

        return redirect()->route('admin/cars/show', $carId)->with('success', 'Job added successfully!');
    }

    public function edit($carId, $jobId)
    {
        $job = CarJob::where('id', $jobId)
        ->where('car_id', $carId)
        ->firstOrFail();

    $workers = User::where('usertype', 'user')->get(); // Regular workers
    $statuses = ['assigned', 'in_progress', 'completed'];

    return view('admin/car/jobs/edit', compact('job', 'workers', 'statuses'));
    }

        public function update(Request $request, $carId, $jobId)
        {
            $validated = $request->validate([
                'job_description' => 'required|string|max:255',
                'worker_id' => 'nullable|exists:users,id',
            ]);

            $job = CarJob::where('id', $jobId)->where('car_id', $carId)->firstOrFail();
            $job->update([
                'job_description' => $validated['job_description'],
                'worker_id' => $validated['worker_id'] ?? null,
                'status' => $validated['worker_id'] ? 'assigned' : 'unassigned',
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

    // public function updateAllJobs(Request $request, $carId)
    // {
    //     $validated = $request->validate([
    //         'jobs' => 'array',
    //         'jobs.*' => 'boolean', 
    //     ]);

    //     foreach ($validated['jobs'] as $jobId => $completed) {
    //         $job = CarJob::findOrFail($jobId);
    //         $job->completed = (bool) $completed;
    //         $job->save();
    //     }

    //     return redirect()->route('cars/jobs/show', $carId)->with('success', 'Job statuses updated!');
    // }

    public function myJobs()
    {
            $userId = auth()->id();

            $jobs = CarJob::with('car')
                ->where('worker_id', auth()->id())
                ->where('status', '!=', 'completed')
                ->get();

            return view('jobs/my-jobs', compact('jobs'));
        }

        public function updateStatus(Request $request, CarJob $job)
        {
            $request->validate(['status' => 'required|in:assigned,in_progress,completed']);

           if ($job->worker_id !== auth()->id() && auth()->user()->usertype !== 'admin') {
                    abort(403);
                }

            $job->status = $request->status;
            $job->save();

            return back()->with('success', 'Status updated');
    }

    public function adminUserOverview()
    {
        $users = User::with('jobs.car')->where('usertype', 'user')->get();
    
        return view('admin/users/index', compact('users'));
    }
    
    public function jobArchive()
    {
        $completedJobs = CarJob::with('car', 'worker')
            ->where('status', 'completed')
            ->get();

        return view('admin/car/jobs/archive', compact('completedJobs'));
    }


}
