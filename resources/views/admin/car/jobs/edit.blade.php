<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                    <h2>Edit Job</h2>

                    <form action="{{ route('admin/car/jobs/update', [$job->car_id, $job->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="job_description">Job Description</label>
                            <textarea name="job_description" id="job_description" class="form-control" rows="4" required>{{ $job->job_description }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Update Job</button>
                        <a href="{{ route('admin/cars/show', $job->car_id) }}" class="btn btn-secondary mt-3">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
