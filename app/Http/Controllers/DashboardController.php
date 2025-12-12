<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\MyClass;
use Carbon\Carbon;
use App\Models\Note;
use App\Models\User;
use App\Models\Product;
use App\Models\Paylater;
use App\Models\PaymentCode;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use App\Models\TransactionItem;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            return Booking::dataTable($request);
        }

        return view('dashboard.dashboard', [
            // header
            'title' => 'Dashboard',
            'title2' => 'Selamat datang Tn.' . ' ' . session('userData')->username,
        ]);
    }

    public function transactionChart()
    {
        $successData = [];
        $billData = [];
        $paylaterData = [];

        // Looping untuk setiap bulan (1-12)
        for ($month = 1; $month <= 12; $month++) {
            // Hitung jumlah transaksi per jenis pembayaran berdasarkan bulan
            $successData[] = Transaction::whereMonth('created_at', $month)
                ->where('status', 'success')
                ->sum('amount');
        }

        // Return data sebagai JSON
        return response()->json([
            'success' => $successData,
        ]);
    }

    public function getWeeklyIncome()
    {
        $today = Carbon::now();

        $weeklyIncome = [];

        for ($i = 0; $i < 7; $i++) {
            $date = $today->copy()->startOfWeek()->addDays($i);
            $income = PengajuanSurat::whereDate('created_at', $date)
                ->count();
            $weeklyIncome[] = $income;
        }

        // Mengembalikan data dalam format JSON
        return response()->json($weeklyIncome);
    }

    // send message
    public function modalSendMessage($id)
    {
        return view('dashboard.sendWhatsapp', [
            'title' => 'Send message',
            'data' => Paylater::with('user')->where('id', $id)->first(),
        ]);
    }

    public function sendMessage(Request $request)
    {
        // dd($request->all());
        $myClass = new MyClass();
        $responseApiWa = $myClass->sendMessageWhatsapp($request->noHp, $request->message);

        return response()->json($responseApiWa);
    }

    // notes
    public function modalNotes($id)
    {
        return view('dashboard.notes.addNotes', [
            'title' => 'Buat Catatan',
            'data' => User::where('id', $id)->first(),
        ]);
    }

    public function getNotes()
    {
        $notes = Note::with('user')->orderBy('created_at', 'desc')->get();

        foreach ($notes as $note) {
            $note->formatted_created_at = Carbon::parse($note->created_at)->format('d M Y  |  H : i');
        }

        return response()->json($notes);
    }

    public function storeNotes(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'user_id' => 'required',
            'note' => 'required',
        ]);

        $data = $request->all();
        $data['status'] = 1;

        $note = Note::create($data);
        return response()->json(['success' => 'Berhasil menambahkan catatan']);
    }
}
