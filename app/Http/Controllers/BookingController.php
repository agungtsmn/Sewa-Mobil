<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function booking(Request $request)
    {      
        // dd($request['car_id']);
        $dataBooking = CarBooking::where('status', 'Disewa')->get();
        if (count($dataBooking) != 0){
            foreach ($dataBooking as $booking) {
                if ($request['car_id'] == $booking->car_id) {
                    if (date('Ymd', strtotime($request['start_date'])) >= date('Ymd', strtotime($booking->start_date)) && date('Ymd', strtotime($request['start_date'])) <= date('Ymd', strtotime($booking->finish_date))) {
                        return redirect('/')->with('delete', 'Penyewaan mobil di tanggal tesebut tidak tersedia!');
                    } else if (date('Ymd', strtotime($request['finish_date'])) <= date('Ymd', strtotime($booking->finish_date)) && date('Ymd', strtotime($request['finish_date'])) >= date('Ymd', strtotime($booking->start_date))){
                        return redirect('/')->with('delete', 'Penyewaan mobil di tanggal tesebut tidak tersedia!');
                    }
                }
            }
        }
        
        $dataCar = Car::where('id', $request['car_id'])->first();
        $rentalRates = $dataCar->rental_rates;
        $awal = date_create($request['start_date']);
        $akhir = date_create($request['finish_date']);
        $timeRenting = date_diff($awal, $akhir);
        $totalPrice = $timeRenting->days * $rentalRates;

        $request['total_price'] = $totalPrice;
        $request['status'] = 'Disewa';

        $validasi = $request->validate([
            'user_id' => 'required',
            'car_id' => 'required',
            'start_date' => 'required',
            'finish_date' => 'required',
            'total_price' => 'required',
            'status' => 'required',
        ]);

        CarBooking::create($validasi);

        return redirect('/page/booking')->with('success', 'Anda berhasil menyewa mobil!');
    }

    public function pageBooking()
    {   
        $dataBooking = CarBooking::latest()->where('user_id', Auth::user()->id)->with('car')->get();
        return view('content.client.booking', [
            'bookings' => $dataBooking,
        ]);
    }

    public function return(CarBooking $booking)
    {
        $booking->update([
            'status' => 'Selesai'
        ]);
        return redirect('/page/booking')->with('success', 'Anda berhasil menyelesaikan penyewaan mobil!');
    }
}
