<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Sertakan autoloader Dompdf
require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf
{
    /**
     * Fungsi utama untuk menghasilkan PDF.
     *
     * @param string $html Konten HTML yang akan di-render.
     * @param string $filename Nama file PDF yang akan dihasilkan.
     * @param string $paper Ukuran kertas (contoh: 'A4', 'Legal').
     * @param string $orientation Orientasi kertas ('portrait' atau 'landscape').
     */
    public function generate($html, $filename = 'document', $paper = 'A4', $orientation = 'portrait')
    {
        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE); // Izinkan untuk memuat gambar dari URL eksternal

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);

        // Render HTML sebagai PDF
        $dompdf->render();

        // Outputkan PDF yang dihasilkan ke browser untuk di-preview atau di-download
        // 'Attachment' => 0 akan menampilkan PDF di browser. Ganti jadi 1 untuk langsung download.
        $dompdf->stream($filename . ".pdf", array("Attachment" => 0));
    }
}
