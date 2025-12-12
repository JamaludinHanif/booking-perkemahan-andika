@extends('layouts.buyer')
@section('content')

    <body class="bg-white">
        <div class="max-w-7xl mx-auto">
            {{-- riwayat pembelian --}}
            <div class="rounded-md">
                <div class="bg-white">
                    <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
                        <div class="max-w-xl">
                            <h1 id="your-orders-heading" class="text-xl font-bold tracking-tight text-gray-900">
                                {{ $title }}</h1>
                        </div>

                        <div class="mt-8 space-y-5 lg:mt-10">
                            @php
                                $pengajuanSurat = \App\Models\PengajuanSurat::where('user_id', session('userData')->id)
                                    ->with(['user', 'suratType'])
                                    ->orderBy('created_at', 'desc');
                            @endphp
                            @forelse ($pengajuanSurat->get() as $index => $pengajuanSurat)
                                <div
                                    class="md:flex md:items-baseline md:space-x-4 md:space-y-0 border-t-2 shadow-lg border-blue-600 py-3 px-2 rounded-lg">
                                    <div class="flex justify-between items-center">
                                        <h2 id="" class="text-lg font-medium text-gray-900 md:shrink-0">
                                            #{{ $pengajuanSurat->nomor_surat ?? $index + 1 }}</h2>
                                        <span
                                            class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset
                                                    {{ $pengajuanSurat->status == '2' ? 'bg-green-400/10 text-green-400 ring-green-400/30' : '' }}
                                                    {{ $pengajuanSurat->status == '1' ? 'bg-yellow-400/10 text-yellow-400 ring-yellow-400/30' : '' }}
                                                    {{ $pengajuanSurat->status == '3' ? 'bg-red-400/10 text-red-400 ring-red-400/30' : '' }}">
                                            {!! $pengajuanSurat->statusHtml() !!}
                                        </span>
                                    </div>
                                    <div
                                        class="space-y-5 sm:flex sm:items-baseline sm:justify-between sm:space-y-0 md:min-w-0 md:flex-1">
                                        <p class="text-xs font-medium text-gray-500">
                                            Diajukan Pada Tanggal
                                            {{ $pengajuanSurat->created_at->translatedFormat('d F Y') }}
                                        </p>
                                        <div class="flex text-xs font-medium">
                                            <a href="{{ route('masyarakat.detail.pengajuanSaya', $pengajuanSurat->id) }}"
                                                class="text-indigo-600 hover:text-indigo-500">Detail
                                                Pengajuan</a>
                                            @if ($pengajuanSurat->status == '2')
                                                <div class="ml-4 border-l border-gray-200 pl-4 sm:ml-6 sm:pl-6">
                                                    <a href="{{ route('surat.download', $pengajuanSurat->id) }}"
                                                        class="text-indigo-600 hover:text-indigo-500">Download
                                                        Surat</a>
                                                    <li class="ml-1 text-indigo-600 hover:text-indigo-500 fas fa-download">
                                                    </li>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="grid min-h-full place-items-center bg-white my-20 px-6 lg:px-8">
                                    <div class="text-center">
                                        <p class="text-base font-semibold text-indigo-600">404</p>
                                        <h1
                                            class="mt-4 text-balance text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">
                                            {{ $title }} Kamu Kosong</h1>
                                        <div class="mt-10 flex items-center justify-center gap-x-6">
                                            <a href="{{ route('buyer.index') }}"
                                                class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold hover:text-white text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                                Buat Pengajuan</a>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @if ($pengajuanSurat->count() <= 7)
            <div style="height: 500px"></div>
        @endif

    </body>
@endsection
