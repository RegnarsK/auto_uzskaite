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

                            <!-- Job Description -->
                            <div class="form-group">
                                <label for="job_description">Job Description</label>
                                <textarea name="job_description" id="job_description" class="form-control" rows="4" required>{{ $job->job_description }}</textarea>
                            </div>

                            <!-- Assign to Worker -->
                            <div class="form-group mt-4">
                                <label for="assigned_user_id">Assign to Worker</label>
                                <select name="assigned_user_id" id="assigned_user_id" class="form-control">
                                    <option value="">-- None --</option>
                                    @foreach($workers as $worker)
                                        <option value="{{ $worker->id }}" {{ $job->assigned_user_id == $worker->id ? 'selected' : '' }}>
                                            {{ $worker->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status -->
                            <div class="form-group mt-4">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ $job->status === $status ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4">Update Job</button>
                            <a href="{{ route('admin/cars/show', $job->car_id) }}" class="btn btn-secondary mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
