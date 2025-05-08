<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">My Jobs</h2>
    </x-slot>

    <div class="p-6">
        @if ($jobs->isEmpty())
            <p class="text-gray-600 dark:text-gray-300">You have no assigned jobs.</p>
        @endif

        @foreach ($jobs as $job)
            <div class="mb-4 border p-4 rounded bg-white dark:bg-gray-800">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                Car: {{ $job->car->brand ?? 'Unknown' }} {{ $job->car->model ?? '' }} ({{ $job->car->number_plate ?? 'No Plate' }})

                </h3>
                <p class="text-gray-700 dark:text-gray-200">{{ $job->job_description }}</p>

                <form method="POST" action="{{ route('my/jobs/updateStatus', $job->id) }}" class="mt-3">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center gap-4">
                        <select name="status" class="form-select dark:bg-gray-700 dark:text-white">
                            <option value="assigned" {{ $job->status == 'assigned' ? 'selected' : '' }}>Assigned</option>
                            <option value="in_progress" {{ $job->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $job->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        <button type="submit" class="bg-red-600 text-white hover:bg-red-700 px-4 py-2 rounded-md shadow no-underline">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
</x-app-layout>
