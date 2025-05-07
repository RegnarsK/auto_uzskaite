<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Users & Assigned Jobs</h2>
    </x-slot>

    <div class="p-6">
        @foreach ($users as $user)
            <div class="mb-6 border p-4 rounded bg-white dark:bg-gray-800">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $user->name }} ({{ $user->email }})</h3>

                @if ($user->jobs->isEmpty())
                    <p class="text-gray-600 dark:text-gray-300">No jobs assigned.</p>
                @else
                    <ul class="mt-2 list-disc list-inside text-gray-700 dark:text-gray-200">
                        @foreach ($user->jobs as $job)
                            <li>
                            <div>
                                <strong>Job:</strong> {{ $job->job_description }}
                            </div>
                            <div>
                                <strong>Car:</strong> {{ $job->car->brand ?? 'Unknown' }} {{ $job->car->model ?? '' }} ({{ $job->car->number_plate ?? '' }})
                            </div>
                            <div>
                                <strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $job->status)) }}
                            </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    </div>
</x-app-layout>
