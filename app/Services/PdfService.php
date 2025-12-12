<?php

namespace App\Services;

use Mpdf\Mpdf;
use App\Models\AppConfig;

class PdfService
{
    /**
     * Buat PDF dari HTML
     *
     * @param string $html
     * @param string $filename
     * @param string $format (A4, F4, Letter, dll)
     * @param string $orientation (P = portrait, L = landscape)
     * @param string $outputMode (I = inline/stream, D = download)
     */
    public static function create(
        $html, 
        $filename = 'document.pdf', 
        $format = 'A4', 
        $orientation = 'P', 
        $outputMode = 'I'
    ) {
        $mpdf = new Mpdf([
            'format' => $format,
            'orientation' => $orientation,
            'margin_top' => 40,
            'margin_bottom' => 40,
        ]);

        $appConfigNama = 'Dinas Rakyat Sejahtera';
        $appConfigAlamat = 'Desa Cikaso, Kec. Kramatmulya, Kab. Kuningan, Kode Pos. 4553';
        $appConfigLogo = 'img/logo_kop.jpg';
        $appConfigPhone = '+62 895-1319-5552';
        $appConfigEmail = 'liihhhhhh_';
        $waNumber = preg_replace('/[^0-9]/', '', $appConfigPhone);
        if (substr($waNumber, 0, 1) === '0') {
            $waNumber = '62' . substr($waNumber, 1);
        }

        $header = '
            <table width="100%" style="border-bottom:2px solid black; font-size:12pt; padding-bottom:1px;">
                <tr>
                    <td style="width:20%; text-align:left;">
                        <img src="'.public_path($appConfigLogo).'" style="height:70px;">
                    </td>
                    <td style="width:80%; text-align:right; font-size:10px; line-height:1.4;">
                        <b style="color:black; font-size:15px;">'.$appConfigNama.'</b><br>
                        '.$appConfigAlamat.'<br>
                        Instagram: <a href="https://www.instagram.com/'.$appConfigEmail.'">@'.$appConfigEmail.'</a> | 
                        Telp: <a href="https://wa.me/'.$waNumber.'">'.$appConfigPhone.'</a>
                    </td>
                </tr>
            </table>
        ';
        $mpdf->SetHTMLHeader($header, 'all');

        $footer = '
            <p style="text-align:right;font-size: 10px">Halaman {PAGENO} dari {nb}</p>
            <table width="100%" style="border-top:1px solid black; font-size:12pt; padding-top:5px;">
                <tr>
                    <td style="text-align:left; font-size:10px; line-height:1.6; width:90%;">
                        <b style="color: black">'.$appConfigNama.'</b><br>
                        '.$appConfigAlamat.'<br>
                        Instagram: <a href="https://www.instagram.com/'.$appConfigEmail.'">@'.$appConfigEmail.'</a> |
                        Telp: <a href="https://wa.me/'.$waNumber.'">'.$appConfigPhone.'</a>
                    </td>
                    <td style="width:10%;">&nbsp;</td>
                </tr>
            </table>
        ';
        $mpdf->SetHTMLFooter($footer, 'all');

        $mpdf->WriteHTML($html);

        return $mpdf->Output($filename, $outputMode);
    }
}

