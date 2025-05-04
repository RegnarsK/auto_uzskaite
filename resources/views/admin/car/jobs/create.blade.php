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
                    <h1>Add Job for {{ $car->brand }} - {{ $car->model }}</h1>

                        <form action="{{ route('admin/car/jobs/store', $car->id) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="job_description">Job Description</label>
                                <textarea name="job_description" id="job_description" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="form-group mt-3">
                            <label for="worker_id">Assign to Worker</label>
                            <select name="worker_id" id="worker_id" class="form-control">
                                <option value="">-- No assignment --</option>
                                @foreach ($workers as $worker)
                                    <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                                @endforeach
                            </select>
                        </div>

                            <button type="submit" class="btn btn-primary mt-3">Save Job</button>
                        </form>

                        
                        


                        <a href="{{ route('admin/cars/show', $car->id) }}" class="btn btn-secondary mt-3">Back to Car Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
