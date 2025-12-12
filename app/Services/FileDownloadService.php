<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileDownloadService
{
    /**
     * Download file PDF dari storage
     *
     * @param string $path path relatif dari storage (contoh: 'surat/abc.pdf')
     * @param string|null $downloadName nama file untuk user
     */
    public static function downloadPdf($path, $downloadName = null)
    {
        $fullPath = 'public/' . $path;

        if (!Storage::exists($fullPath)) {
            abort(404, 'File tidak ditemukan');
        }

        $downloadName = $downloadName ?? basename($path);

        return Storage::download($fullPath, $downloadName, [
            'Content-Type' => 'application/pdf'
        ]);
    }
}
