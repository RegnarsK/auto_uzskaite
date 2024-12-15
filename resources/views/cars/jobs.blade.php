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
                    <form action="{{ route('cars/jobs/updateAll', $car->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($car->jobs as $index => $job)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td style="{{ $job->completed ? 'text-decoration: line-through;' : '' }}">
                                {{ $job->job_description }}
                            </td>
                                        <td>
                                        <input type="hidden" name="jobs[{{ $job->id }}]" value="0">
                                        <input type="checkbox" name="jobs[{{ $job->id }}]" value="1" {{ $job->completed ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success">Update Job Status</button>
                    </form>
                    @endif

                    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
