<?php

namespace App\Http\Controllers;

use App\Models\CarBooking;
use App\Http\Requests\StoreCarBookingRequest;
use App\Http\Requests\UpdateCarBookingRequest;

class CarBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarBookingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarBookingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarBooking  $carBooking
     * @return \Illuminate\Http\Response
     */
    public function show(CarBooking $carBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarBooking  $carBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(CarBooking $carBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarBookingRequest  $request
     * @param  \App\Models\CarBooking  $carBooking
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarBookingRequest $request, CarBooking $carBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarBooking  $carBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarBooking $carBooking)
    {
        //
    }
}
