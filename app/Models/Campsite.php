<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campsite extends Model
{
    use HasFactory;

    protected $guarded = [];

    // relasi

    /**
     *  Helper methods
     * */

    public function statusHtml()
    {
        if ($this->is_active == true) {
            return '<span class="text-success"> Aktif </span>';
        } else {
            return '<span class="text-danger"> Tidak Aktif </span>';
        }
    }

    /**
     *  CRUD methods
     * */
    public static function createCampsite($request)
    {
        $campsite = self::create([
            'name' => $request->name,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'is_active' => (bool) $request->is_active,
        ]);

        return $campsite;
    }

    public function updateCampsite($request)
    {
        $this->update([
            'name' => $request->name,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'is_active' => $request->is_active,
        ]);

        return $this;
    }

    public function deleteCampsite()
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
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                return $data->statusHtml();
            })
            ->addColumn('action', function ($data) {
                $button = '
                <div class="d-flex justify-content-center">
                    <div class="dropdown">
                        <button class="btn btn-primary px-2 py-1 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pilih Aksi
                        </button>
                    </div>
                </div>';

                return $button;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

}