<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Completed Job Archive</h2>
    </x-slot>

    <div class="p-6">
        @foreach ($completedJobs as $job)
            <div class="mb-4 border p-4 rounded bg-white dark:bg-gray-800">
                <p><strong>Job:</strong> {{ $job->job_description }}</p>
                <p><strong>Car:</strong> {{ $job->car->brand }} {{ $job->car->model }} ({{ $job->car->number_plate }})</p>
                <p><strong>Mechanic:</strong> {{ $job->worker->name ?? 'N/A' }}</p>
                <p><strong>Status:</strong> {{ ucfirst($job->status) }}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>
