<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-0">Edit Car</h1>
                    <hr />
                    <form action="{{ route('admin/cars/update', $cars->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Car Brand</label>
                                <input type="text" name="brand" class="form-control" placeholder="Brand" value="{{$cars->brand}}">
                                @error('brand')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Model</label>
                                <input type="text" name="model" class="form-control" placeholder="Model" value="{{$cars->model}}">
                                @error('model')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Number plate</label>
                                <input type="text" name="number_plate" class="form-control" placeholder="Numberplate" value="{{$cars->number_plate}}">
                                @error('number_plate')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-grid">
                                <button class="btn btn-warning">Update</button>
                            </div>
                        </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
