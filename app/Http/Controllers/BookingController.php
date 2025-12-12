<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            // dd($request->all());
            $booking = Booking::createBooking($request);
            DB::commit();

            return response()->json([
                'message' => 'Berhasil',
                'id' => $booking->id
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return \Res::error($e);
        }
    }

    public function approve(Request $request, Booking $booking)
    {
        DB::beginTransaction();

        try {

            // Log
            LogActivity::create([
                'user_id' => session('userData')->id,
                'action' => 'approve booking ' . $booking->nama_lengkap,
            ]);

            // Update database
            $booking->update([
                'status' => 2,
            ]);

            DB::commit();

            return \Res::update("booking Berhasil di Setujui");
        } catch (\Exception $e) {
            DB::rollback();
            return \Res::error($e->getMessage());
        }
    }

    public function reject(Request $request, Booking $booking)
    {
        DB::beginTransaction();

        try {

            // Log
            LogActivity::create([
                'user_id' => session('userData')->id,
                'action' => 'reject booking ' . $booking->nama_lengkap,
            ]);

            // Update database
            $booking->update([
                'status' => 3,
            ]);

            DB::commit();

            return \Res::update("booking di Tolak");
        } catch (\Exception $e) {
            DB::rollback();
            return \Res::error($e->getMessage());
        }
    }

    public function edit(Seller $seller)
    {
        return view('sellers.edit', [
            'title' => 'Edit Penjual',
            'seller' => $seller,
        ]);
    }

    public function update(Request $request, Seller $seller)
    {
        DB::beginTransaction();

        try {
            LogActivity::create([
                'user_id' => session('userData')->id,
                'action' => 'mengubah Penjual' . $seller->id,
            ]);
            $seller->updateSeller($request);
            DB::commit();

            return \Res::update();
        } catch (\Exception $e) {
            DB::rollback();

            return \Res::error($e);
        }
    }

    public function detail(Seller $seller)
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $today = Carbon::now();
        $weeklyIncome = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $today->copy()->startOfWeek()->addDays($i);
            $income = Transaction::where('seller_id', $seller->id)->where('status', 'success')->whereDate('created_at', $date)
                ->sum('amount');
            $weeklyIncome[] = $income;
        }

        $monthlyIncome = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyIncome[] = Transaction::where('seller_id', $seller->id)->whereMonth('created_at', $month)
                ->where('status', 'success')
                ->sum('amount');
        }

        return view('sellers.detail', [
            'title' => 'Detail Penjual',
            'seller' => $seller,
            'weeklyIncomeBersih' => Transaction::where('seller_id', $seller->id)->where('status', 'success')->whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('amount'),
            'weeklyIncome' => $weeklyIncome,
            'monthlyIncome' => $monthlyIncome,
        ]);
    }

    public function delete(Request $request, Seller $seller)
    {
        DB::beginTransaction();

        try {
            LogActivity::create([
                'user_id' => session('userData')->id,
                'action' => 'menghapus Penjual' . $seller->shop_name,
            ]);
            $seller->deleteSeller();
            DB::commit();

            return \Res::delete();
        } catch (\Exception $e) {
            DB::rollback();

            return \Res::error($e);
        }
    }
}
