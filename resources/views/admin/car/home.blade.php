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
                                    <a href="{{ route('admin/cars/edit', ['id'=>$car->id]) }}" type="button" class="btn btn-secondary">Edit</a>
                                    <a href="{{ route('admin/cars/delete', ['id'=>$car->id]) }}" type="button" class="btn btn-danger">Delete</a>
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

                    <!-- @foreach ($cars as $car)
    <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
        <div>
            <img src="{{ asset('images/' . $car->image_path) }}" alt="">
        </div>
        <div>
            <h2 class="text-gray-700 font-bold text-5xl pb-4">
                {{ $car->brand }}
            </h2>

           

            <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
            
            </p>

            <a href="" class="uppercase bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                Keep Reading
            </a>

            @if (isset(Auth::user()->id) && Auth::user()->id == $car->user_id)
                <span class="float-right">
                    <a 
                        href=""
                        class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">
                        Edit
                    </a>
                </span>

                <span class="float-right">
                <form 
                action=""
                method="POST">
                @csrf
                @method('delete')
                        <button
                            class="text-red-500 pr-3"
                            type="submit">
                            Delete
                        </button>
                </form>
                </span>
            @endif
        </div>
    </div>    
@endforeach -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
