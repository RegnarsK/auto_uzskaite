<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::orderBy('id', 'desc')->get();
        $total = Car::count();
        return view('admin.car.home', compact(['cars', 'total']));
    }

    public function create()
    {
        return view('admin.car.create');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'number_plate' => 'required',
        ]);
        $data = Car::create($validation);
        if ($data) {
            session()->flash('success', 'car Added Successfully');
            return redirect(route('admin/cars'));
        } else {
            session()->flash('error', 'Error');
            return redirect(route('admin.cars/create'));
        }
    
    }

    public function edit($id)
    {
        $cars = Car::findOrFail($id);
        return view('admin.car.update', compact('cars'));
    }

    public function update(Request $request, $id)
    {
        $cars = Car::findOrFail($id);
        $brand = $request->brand;
        $model = $request->model;
        $number_plate = $request->number_plate;
 
        $cars->brand = $brand;
        $cars->model = $model;
        $cars->number_plate = $number_plate;
        $data = $cars->save();
        if ($data) {
            session()->flash('success', 'Car Updated Successfully');
            return redirect(route('admin/cars'));
        } else {
            session()->flash('error', 'error');
            return redirect(route('admin/cars/update'));
        }
    }

    public function delete($id)
    {
        $cars = Car::findOrFail($id)->delete();
        if ($cars) {
            session()->flash('success', 'Car Deleted Successfully');
            return redirect(route('admin/cars'));
        } else {
            session()->flash('error', 'error');
            return redirect(route('admin/cars'));
        }
    }

    public function showcase()
{
    $cars = Car::all(); 
    return view('dashboard', compact('cars'));
}
public function show($id)
{
    $car = Car::findOrFail($id); 

    return view('admin.car.show', compact('car'));
}

}
