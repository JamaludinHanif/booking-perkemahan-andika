<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.index', [
            'title' => 'Panagaran Camp'
        ]);
    }

    // profile
    public function thanksGiving($id)
    {
        $booking = Booking::find($id);

        return view('customer.thanksGiving', [
            'title' => 'Terima Kasih',
            'booking' => $booking
        ]);
    }

    // riwayat pembelian
    public function indexPengajuanSaya()
    {
        return view('buyer.historyPayment', [
            'title' => 'Riwayat Pengajuan'
        ]);
    }

    public function detailPengajuanSaya($id)
    {
        return view('buyer.history_detail', [
            'title' => 'Detail',
            'detail' => PengajuanSurat::where('user_id', session('userData')->id)->where('id', $id)->with(['user', 'suratType'])->first()
        ]);
    }

    // product
    public function detailProduct($slug)
    {
        return view('buyer.product_detail', [
            'title' => $slug,
            'product' => Product::where('slug', $slug)->first()
        ]);
    }

    public function searchProduct(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($products);
    }
}