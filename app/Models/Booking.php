<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    // relasi

    public function campsite()
    {
        return $this->belongsTo(Campsite::class, 'campsite_id');
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

    public function getCampsite()
    {
        return $this->campsite ? $this->campsite->name : '-';
    }

    public function payment_proofPath()
    {
        return storage_path('app/public/image/payment_proof/' . $this->payment_proof);
    }

    public function payment_proofLink()
    {
        if ($this->isHaspayment_proof()) {
            return url('storage/image/payment_proof/' . $this->payment_proof);
        } else {
            return url('img/no-image.jpg');
        }
    }

    public function isHaspayment_proof()
    {
        if (empty($this->payment_proof)) {
            return false;
        }

        return File::exists($this->payment_proofPath());
    }

    public function removepayment_proof()
    {
        if ($this->isHaspayment_proof()) {
            File::delete($this->payment_proofPath());
            $this->update([
                'payment_proof' => null,
            ]);
        }

        return $this;
    }

    public function setpayment_proof($request)
    {
        if (!empty($request->payment_proof)) {
            $this->removepayment_proof();
            $file = $request->file('payment_proof');
            $filename = $this->slug ?? date('Ymd_His');
            $filename = $filename . '.' . $file->getClientOriginalExtension();

            $file->move(storage_path('app/public/image/payment_proof/'), $filename);
            $this->update([
                'payment_proof' => $filename,
            ]);
        }

        return $this;
    }

    /**
     *  CRUD methods
     * */
    public static function createBooking($request)
    {
        $booking = self::create([
            'campsite_id' => $request->campsite_id,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 1,
        ]);
        $booking->setpayment_proof($request);

        return $booking;
    }

    public function updateBooking($request)
    {
        $this->update([
            'name' => $request->name,
            'template_view' => $request->template_view,
        ]);

        return $this;
    }

    public function deleteBooking()
    {
        return $this->delete();
    }

    /**
     *  Static methods
     * */
    public static function dataTable($request)
    {
        $data = self::query();

        $data = $data->orderBy('updated_at', 'DESC');

        return DataTables::of($data)
            ->addColumn('status', function ($data) {
                return $data->statusHtml();
            })
            ->addColumn('tanggal_kemah', function ($data) {
                    return \Carbon\Carbon::parse($data->start_date)->translatedFormat('d M Y') 
                        . ' - ' . 
                        \Carbon\Carbon::parse($data->end_date)->translatedFormat('d M Y');
                })
            ->addColumn('campsite', function ($data) {
                return $data->getCampsite();
            })
            ->addColumn('payment_proof', function ($data) {
                $url = $data->payment_proofLink();

                if (!$url) return '-';

                return '
                    <button onclick="showImageModal(\'' . $url . '\')" 
                        class="bg-transparent border-0 p-0" 
                        style="cursor:pointer; color: blue;">
                        Lihat Bukti Pembayaran
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
                                data-approve-href="' . route('admin.booking.approve', $data->id) . '">
                                <i class="fas fa-check-circle mr-1"></i> Setujui
                            </a>
                            <a class="dropdown-item reject text-danger" href="javascript:void(0)"
                                data-reject-message="Yakin ingin menolak ini?"
                                data-reject-href="' . route('admin.booking.reject', $data->id) . '">
                                <i class="fas fa-times-circle mr-1"></i> Tolak
                            </a>
                        </div>
                    </div>
                </div>';
            })
            ->rawColumns(['status', 'tanggal_kemah', 'campsite', 'payment_proof', 'action'])
            ->make(true);
    }
}
