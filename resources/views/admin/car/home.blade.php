<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin cars') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                    <h1 class="mb-0">List cars</h1>
                    <a href="{{ route('admin/cars/create') }}" class="btn btn-primary">Add Car</a>

                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Number plate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cars as $car)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $car->brand }}</td>
                                <td class="align-middle">{{ $car->model }}</td>
                                <td class="align-middle">{{ $car->number_plate }}</td>
                                <td class="align-middle">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="" type="button" class="btn btn-secondary">Edit</a>
                                        <a href="" type="button" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="5">car not found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>