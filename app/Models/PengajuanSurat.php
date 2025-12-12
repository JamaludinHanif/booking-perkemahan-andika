<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $guarded = [];

    // relasi
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function suratType()
    {
        return $this->belongsTo(SuratTypes::class, 'surat_type_id');
    }

    /**
     *  Helper methods
     * */

    public function statusHtml()
    {
        if ($this->status == '1') {
            return '<span class="text-warning"> Menunggu </span>';
        } else if ($this->status == '2') {
            return '<span class="text-success"> Disetujui </span>';
        } else {
            return '<span class="text-danger"> Ditolak </span>';
        }
    }

    public function getSuratType()
    {
        return $this->suratType ? $this->suratType->name : '-';
    }

    public static function generateNomorSurat()
    {
        return 'SURAT-' . date('Ymd') . '-' . strtoupper(Str::random(5));
    }

    public function keteranganPath()
    {
        return storage_path('app/public/image/foto_kk/' . $this->keterangan);
    }

    public function keteranganLink()
    {
        if ($this->isHasKeterangan()) {
            return url('storage/image/foto_kk/' . $this->keterangan);
        } else {
            return url('img/no-image.jpg');
        }
    }

    public function isHasKeterangan()
    {
        if (empty($this->keterangan)) {
            return false;
        }

        return File::exists($this->keteranganPath());
    }

    public function removeKeterangan()
    {
        if ($this->isHasKeterangan()) {
            File::delete($this->keteranganPath());
            $this->update([
                'keterangan' => null,
            ]);
        }

        return $this;
    }

    public function setKeterangan($request)
    {
        if (!empty($request->keterangan)) {
            $this->removeKeterangan();
            $file = $request->file('keterangan');
            $filename = $this->slug ?? date('Ymd_His');
            $filename = $filename . '.' . $file->getClientOriginalExtension();

            $file->move(storage_path('app/public/image/foto_kk/'), $filename);
            $this->update([
                'keterangan' => $filename,
            ]);
        }

        return $this;
    }

    /**
     *  CRUD methods
     * */
    public static function createPengajuanSurat($request)
    {
        $pengajuanSurat = self::create([
            'user_id' => session('userData')->id,
            'surat_type_id' => $request->surat_type_id,
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_perkawinan,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'keperluan' => $request->keperluan,
            'status' => 1,
        ]);
        $pengajuanSurat->setKeterangan($request);

        return $pengajuanSurat;
    }

    public function updatePengajuanSurat($request)
    {
        $this->update([
            'name' => $request->name,
            'template_view' => $request->template_view,
        ]);

        return $this;
    }

    public function deleteSuratType()
    {
        return $this->delete();
    }

    /**
     *  Static methods
     * */
    public static function dataTable($request)
    {
        $data = self::where('status', 1);

        $data = $data->orderBy('updated_at', 'DESC');

        return DataTables::of($data)
            ->addColumn('status', function ($data) {
                return $data->statusHtml();
            })
            ->addColumn('surat_type', function ($data) {
                return $data->getSuratType();
            })
            ->addColumn('keterangan', function ($data) {
                $url = $data->keteranganLink();

                if (!$url) return '-';

                return '
                    <button onclick="showImageModal(\'' . $url . '\')" 
                        class="text-primary bg-transparent border-0 p-0" 
                        style="cursor:pointer;">
                        Lihat Gambar
                    </button>
                ';
            })
            ->addColumn('action', function ($data) {

                // Jika status bukan 1 → tampilkan teks "Tidak ada aksi"
                if ($data->status != 1) {
                    return '
                    <div class="d-flex justify-content-center">
                        <div class="dropdown">
                            <button class="btn btn-primary px-2 py-1 dropdown-toggle" type="button" data-toggle="dropdown">
                                Pilih Aksi
                            </button>
                            <div class="dropdown-menu text-center">
                                <span class="dropdown-item text-muted">Tidak ada aksi</span>
                            </div>
                        </div>
                    </div>';
                }

                // Jika status = 1 → tampilkan tombol Approve & Reject
                return '
                <div class="d-flex justify-content-center">
                    <div class="dropdown">
                        <button class="btn btn-primary px-2 py-1 dropdown-toggle" type="button" data-toggle="dropdown">
                            Pilih Aksi
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item approve text-success" href="javascript:void(0)"
                                data-approve-message="Yakin ingin menyetujui ini?"
                                data-approve-href="' . route('admin.pengajuanSurat.approve', $data->id) . '">
                                <i class="fas fa-check-circle mr-1"></i> Setujui
                            </a>
                            <a class="dropdown-item reject text-danger" href="javascript:void(0)"
                                data-reject-message="Yakin ingin menolak ini?"
                                data-reject-href="' . route('admin.pengajuanSurat.reject', $data->id) . '">
                                <i class="fas fa-times-circle mr-1"></i> Tolak
                            </a>
                        </div>
                    </div>
                </div>';
            })
            ->rawColumns(['status', 'surat_type', 'keterangan', 'action'])
            ->make(true);
    }

    public static function dataTableArsip($request)
    {
        $data = self::where('status', 2);

        $data = $data->orderBy('updated_at', 'DESC');

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('surat_type', function ($data) {
                return $data->getSuratType();
            })
            ->addColumn('keterangan', function ($data) {
                $url = $data->keteranganLink();

                if (!$url) return '-';

                return '
                    <button onclick="showImageModal(\'' . $url . '\')" 
                        class="text-primary bg-transparent border-0 p-0" 
                        style="cursor:pointer;">
                        Lihat Gambar
                    </button>
                ';
            })
            ->addColumn('file_surat', function ($data) {
                return '
                    <a class="text-primary" style="cursor:pointer;"
                        href="' . route('surat.download', $data->id) . '">
                        <i class="fas fa-download mr-1"></i> Download Surat
                    </a>
                ';
            })
            ->rawColumns(['surat_type', 'keterangan', 'file_surat'])
            ->make(true);
    }
}
