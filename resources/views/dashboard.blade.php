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
                     
                    
                        
                        <div class="container">
                            <h2>Available Cars</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach ($cars as $car)
                                    <div class="bg-white shadow rounded-lg p-4">
                                        <h3 class="text-xl font-semibold">{{ $car->brand }}</h3>
                                        <p class="text-gray-600">{{ $car->model }}</p>
                                        <p class="text-gray-500 font-bold">Number plate: {{ $car->number_plate }}</p>
                                        <a href="{{ route('cars/jobs/show', $car->id) }}" class="btn btn-primary">Show Jobs</a>
                                    </div>
                                @endforeach
                            
                            </div>
                        </div>
                        
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
