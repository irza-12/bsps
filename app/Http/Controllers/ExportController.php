<?php

namespace App\Http\Controllers;

use App\Models\Bsps;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use OpenSpout\Writer\XLSX\Writer;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Common\Entity\Style\Style;
use OpenSpout\Common\Entity\Style\Border;
use OpenSpout\Common\Entity\Style\BorderPart;
use OpenSpout\Common\Entity\Style\Color;

class ExportController extends Controller
{
    public function exportExcel(Request $request)
    {
        $query = Bsps::query();

        if ($request->has('tahun') && $request->tahun != '') {
            $query->where('tahun', $request->tahun);
        }

        if ($request->has('dusun') && $request->dusun != '') {
            $query->where('dusun', $request->dusun);
        }

        $data = $query->orderBy('id')->get();
        $tahun = $request->tahun ?? date('Y');

        $writer = new Writer();
        $fileName = 'BSPS_Terjun_Gajah_' . $tahun . '_' . date('Ymd_His') . '.xlsx';
        $tempFile = storage_path('app/' . $fileName);

        $writer->openToFile($tempFile);

        // Header Style (Clean & Professional)
        $headerStyle = (new Style())
            ->withFontBold(true)
            ->withFontSize(11)
            ->withBackgroundColor(Color::rgb(240, 240, 240))
            ->withBorder((new Border((new BorderPart(
                \OpenSpout\Common\Entity\Style\BorderName::BOTTOM,
                Color::BLACK,
                \OpenSpout\Common\Entity\Style\BorderWidth::THIN,
                \OpenSpout\Common\Entity\Style\BorderStyle::SOLID
            )))));

        // Title rows (Official Format)
        $bold12 = (new Style())->withFontBold(true)->withFontSize(12);
        $bold14 = (new Style())->withFontBold(true)->withFontSize(14);
        $bold = (new Style())->withFontBold(true);

        $writer->addRow(Row::fromValuesWithStyle(['PEMERINTAH KABUPATEN TANJUNG JABUNG BARAT'], $bold12));
        $writer->addRow(Row::fromValuesWithStyle(['KECAMATAN BETARA'], $bold12));
        $writer->addRow(Row::fromValuesWithStyle(['DESA TERJUN GAJAH'], $bold14));
        $writer->addRow(Row::fromValues(['']));
        $writer->addRow(Row::fromValuesWithStyle(['DAFTAR USULAN BANTUAN STIMULAN PERUMAHAN SWADAYA (BSPS)'], $bold12));
        $writer->addRow(Row::fromValuesWithStyle(['TAHUN ANGGARAN ' . $tahun], $bold));
        $writer->addRow(Row::fromValues(['']));


        // Header row with clean style
        $writer->addRow(Row::fromValuesWithStyle(
            ['NO', 'NO KK', 'NIK', 'NAMA', 'ALAMAT', 'RT', 'DUSUN', 'TAHUN'],
            $headerStyle
        ));

        // Data rows
        $no = 1;
        foreach ($data as $row) {
            $writer->addRow(Row::fromValues([
                $no++,
                $row->no_kk,
                $row->nik,
                $row->nama,
                $row->alamat,
                $row->rt,
                $row->dusun,
                $row->tahun
            ]));
        }

        $writer->close();

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }

    public function exportPdf(Request $request)
    {
        $query = Bsps::query();

        if ($request->has('tahun') && $request->tahun != '') {
            $query->where('tahun', $request->tahun);
        }

        if ($request->has('dusun') && $request->dusun != '') {
            $query->where('dusun', $request->dusun);
        }

        $data = $query->orderBy('id')->get();
        $tahun = $request->tahun ?? date('Y');
        $dusun = $request->dusun ?? 'Semua Dusun';

        $pdf = Pdf::loadView('exports.pdf', [
            'data' => $data,
            'tahun' => $tahun,
            'dusun' => $dusun,
        ]);

        $pdf->setPaper('a4', 'landscape');

        $fileName = 'BSPS_Terjun_Gajah_' . $tahun . '.pdf';

        return $pdf->stream($fileName);
    }
}
