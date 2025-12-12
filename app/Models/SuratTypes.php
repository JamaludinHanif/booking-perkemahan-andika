<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratTypes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'template_view',
    ];

    // relasi

    /**
     *  Helper methods
     * */

    //tidak ada

    /**
     *  CRUD methods
     * */
    public static function createSuratType($request)
    {
        $suratType = self::create([
            'name' => $request->name,
            'template_view' => $request->template_view,
        ]);

        return $suratType;
    }

    public function updateSuratType($request)
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
        $data = self::query();
        $data = $data->orderBy('updated_at', 'DESC');

        return DataTables::of($data)
            ->addIndexColumn()
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
            ->rawColumns(['action'])
            ->make(true);
    }

}
