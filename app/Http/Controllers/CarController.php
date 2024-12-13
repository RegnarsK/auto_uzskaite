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
}
