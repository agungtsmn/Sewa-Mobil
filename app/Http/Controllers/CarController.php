<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCar = Car::latest()->get();
        return view('content.admin.car', [
            'data' => $dataCar,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'merk' => 'required',
            'model' => 'required',
            'plat_number' => 'required',
            'rental_rates' => 'required',
            'car_img' => 'required|mimes:jpeg,jpg,png|max:5120',
        ]);

        if ($request->file('car_img')) {
            $validasi['car_img'] = $request->file('car_img')->store('berkas_car_img');
        }

        Car::create($validasi);

        return redirect('/manage/car')->with('success', 'Data mobil berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    // public function show(Car $car)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    // public function edit(Car $car)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarRequest  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $validasi = $request->validate([
            'merk' => 'required',
            'model' => 'required',
            'plat_number' => 'required',
            'rental_rates' => 'required',
            'car_img' => 'nullable|mimes:jpeg,jpg,png|max:5120',
        ]);

        if ($request->file('car_img')) {
            if ($car->car_img) {
                Storage::delete($car->car_img);
            }
            $validasi['car_img'] = $request->file('car_img')->store('berkas_car_img');
        }

        $car->update($validasi);

        return redirect('/manage/car')->with('update', 'Data mobil berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        if ($car->car_img) {
            Storage::delete($car->car_img);
        }
        $car->delete();
        return redirect('/manage/car')->with('delete', 'Data mobil berhasil dihapus!');
    }
}
