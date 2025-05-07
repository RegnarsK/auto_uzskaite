<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <p>Welcome, {{ Auth::user()->name }}!</p>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2>Jobs for {{ $car->brand }} {{ $car->model }} ({{ $car->number_plate }})</h2>

                    @if ($car->jobs->isEmpty())
                        <p>No jobs available for this car.</p>
                    @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th>Status</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($car->jobs as $index => $job)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $job->job_description }}</td>
                                    <td>
                                        @if ($job->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif ($job->status == 'in_progress')
                                            <span class="badge bg-warning text-dark">In Progress</span>
                                        @else
                                            <span class="badge bg-secondary">Assigned</span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @endif

                    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
