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
                <h1>Car Details</h1>

                <div class="card">
                    <div class="card-header">
                        <h3>{{ $car->brand }} - {{ $car->model }}</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>Brand:</strong> {{ $car->brand }}</p>
                        <p><strong>Model:</strong> {{ $car->model }}</p>
                        <p><strong>Number Plate:</strong> {{ $car->number_plate }}</p>
                        

                        
                        <a href="{{ route('admin/cars') }}" class="btn btn-primary">Back to Cars List</a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>