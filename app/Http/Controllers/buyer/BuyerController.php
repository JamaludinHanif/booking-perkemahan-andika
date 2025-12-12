<?php

namespace App\Http\Controllers\buyer;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;

class BuyerController extends Controller
{
    public function index()
    {
        return view('buyer.index', [
            'title' => 'HomeScreen'
        ]);
    }

    // profile
    public function indexProfile()
    {
        return view('buyer.profile', [
            'title' => 'Profil Ku'
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
