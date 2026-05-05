<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Models\Kredensial;

class KredensialController extends Controller
{
    public function index()
    {
        $competencyList = \App\Helpers\CompetencyHelper::getList();
        return view('index', compact('competencyList'));
    }

    public function dashboard()
    {
        $kredensials = auth()->user()->kredensials()->latest()->get();
        $competencyList = \App\Helpers\CompetencyHelper::getList();
        return view('dashboard', compact('kredensials', 'competencyList'));
    }

    public function storeCompetency(Request $request)
    {
        auth()->user()->update([
            'data_kompetensi' => $request->kompetensi
        ]);
        return back()->with('success', 'Data kompetensi berhasil diperbarui.');
    }

    public function generate(Request $request)
    {
        // Handle JSON decoded fields from FormData
        $consent = json_decode($request->consent, true);
        $umpan = json_decode($request->umpan_balik, true);
        $porto = json_decode($request->portofolio, true);
        $kompetensi = json_decode($request->data_kompetensi, true);

        $data = $request->all();
        $data['consent'] = $consent;
        $data['umpan_balik'] = $umpan;
        $data['portofolio'] = $porto;
        $data['data_kompetensi'] = $kompetensi;

        // Save to Database (Associate with current user)
        $kredensial = Kredensial::create([
            'user_id' => auth()->id(),
            'nama_asesi' => $request->nama_asesi,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'jabatan' => $request->jabatan,
            'tanggal' => $request->tanggal,
            'data_lengkap' => $data,
            'status' => 'Submitted'
        ]);

        // Handle File Uploads
        $filePaths = [];
        $fileFields = ['file_ijazah', 'file_transkrip', 'file_str', 'file_praktik', 'file_sertifikat', 'file_logbook', 'file_form'];
        
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $path = $file->storeAs(
                    "uploads/kredensial_{$kredensial->id}", 
                    $field . '_' . time() . '.pdf'
                );
                $filePaths[$field] = $path;
            }
        }

        if (!empty($filePaths)) {
            $existingData = $kredensial->data_lengkap;
            $existingData['file_paths'] = $filePaths;
            $kredensial->update(['data_lengkap' => $existingData]);
        }

        $d = $data;
        try {
            $templatePath = storage_path('app/templates/PRA_PK_.xlsx');
            
            if (!file_exists($templatePath)) {
                return response()->json(['error' => 'Template file tidak ditemukan'], 500);
            }

            $spreadsheet = IOFactory::load($templatePath);

            // ── FORM-01 ──────────────────────────────────
            $ws1 = $spreadsheet->getSheetByName('FORM -01');
            if ($ws1) {
                $ws1->setCellValue('D7', $d['nama_asesi'] ?? '');
                $ws1->setCellValue('D8', $d['ttl'] ?? '');
                $ws1->setCellValue('D9', $d['jenis_kelamin'] ?? '');
                $ws1->setCellValue('D10', $d['kebangsaan'] ?? 'Indonesia');
                $ws1->setCellValue('D11', $d['alamat'] ?? '');
                $ws1->setCellValue('E12', $d['kode_pos'] ?? '');
                $ws1->setCellValue('D13', "HP: " . ($d['no_hp'] ?? '') . "    E-mail: " . ($d['email'] ?? ''));
                $ws1->setCellValue('D17', $d['nama_sekolah'] ?? '');
                $ws1->setCellValue('D18', $d['jurusan'] ?? '');
                $ws1->setCellValue('D19', $d['strata'] ?? '');
                $ws1->setCellValue('F19', $d['tahun_lulus'] ?? '');
                $ws1->setCellValue('D22', $d['nama_lembaga'] ?? 'RSUD dr. M. Soewandhie');
                $ws1->setCellValue('D23', $d['jabatan'] ?? '');
                $ws1->setCellValue('D24', $d['alamat_kantor'] ?? '');
                $ws1->setCellValue('D26', "Telp: " . ($d['no_telp_kantor'] ?? ''));
                $ws1->setCellValue('D27', "E-mail: " . ($d['email_kantor'] ?? ''));
                $ws1->setCellValue('F304', $d['tanggal'] ?? '');
                $ws1->setCellValue('F306', $d['nama_asessor'] ?? '');
                $ws1->setCellValue('F307', $d['no_reg_asesor'] ?? '');
            }

            // ── FORM-02 ──────────────────────────────────
            $ws2 = $spreadsheet->getSheetByName('FORM-02');
            if ($ws2) {
                $ws2->setCellValue('G3', $d['tanggal'] ?? '');
                $ws2->setCellValue('G4', $d['tempat'] ?? '');
            }

            // ── FORM-03 ──────────────────────────────────
            $ws3 = $spreadsheet->getSheetByName('FORM -03');
            if ($ws3) {
                $ws3->setCellValue('F168', $d['tanggal'] ?? '');
                $ws3->setCellValue('F170', $d['waktu'] ?? '');
                $ws3->setCellValue('F172', $d['tempat'] ?? '');
            }

            // ── FORM-04 ──────────────────────────────────
            $ws4 = $spreadsheet->getSheetByName('FORM-04');
            if ($ws4) {
                $ws4->setCellValue('D8', $d['judul_unit'] ?? '');
                $ws4->setCellValue('D9', '✓');
                $ws4->setCellValue('D10', '✓');
                $ws4->setCellValue('D11', '✓');
                $ws4->setCellValue('D12', '✓');
                
                $consent = $d['consent'] ?? array_fill(0, 6, true);
                foreach ($consent as $i => $jawab) {
                    $baris = 15 + $i;
                    $ws4->setCellValue("G$baris", $jawab ? '✓' : '');
                    $ws4->setCellValue("H$baris", !$jawab ? '✓' : '');
                }
            }

            // ── FORM-05 ──────────────────────────────────
            $ws5 = $spreadsheet->getSheetByName('FORM-05');
            if ($ws5) {
                $ws5->setCellValue('D7', $d['kode_unit'] ?? '');
                $ws5->setCellValue('D8', $d['judul_unit'] ?? '');
            }

            // ── FORM-06 ──────────────────────────────────
            $ws6 = $spreadsheet->getSheetByName('FORM 06');
            if ($ws6) {
                $ws6->setCellValue('D7', $d['kode_unit'] ?? '');
                $ws6->setCellValue('D8', $d['judul_unit'] ?? '');
            }

            // ── FORM-07 ──────────────────────────────────
            $ws7 = $spreadsheet->getSheetByName('FORM-07');
            if ($ws7) {
                $ws7->setCellValue('D5', $d['judul_unit'] ?? '');
            }

            // ── FORM-08 ──────────────────────────────────
            $ws8 = $spreadsheet->getSheetByName('FORM-08');
            if ($ws8) {
                $ws8->setCellValue('D6', $d['judul_unit'] ?? '');
                $umpan = $d['umpan_balik'] ?? array_fill(0, 10, true);
                foreach ($umpan as $i => $jawab) {
                    $baris = 12 + $i;
                    $ws8->setCellValue("H$baris", $jawab ? '✓' : '');
                    $ws8->setCellValue("I$baris", !$jawab ? '✓' : '');
                }
            }

            // ── FORM-09 ──────────────────────────────────
            $ws9 = $spreadsheet->getSheetByName('FORM-09');
            if ($ws9) {
                $ws9->setCellValue('D6', $d['judul_unit'] ?? '');
            }

            // ── FORM-03D ─────────────────────────────────
            $ws3d = $spreadsheet->getSheetByName('FORM 03 D');
            if ($ws3d) {
                $portofolio = $d['portofolio'] ?? [];
                foreach ($portofolio as $i => $pilihan) {
                    $baris = 6 + $i;
                    $ws3d->setCellValue("G$baris", $pilihan == 'ya' ? '✓' : '');
                    $ws3d->setCellValue("H$baris", $pilihan == 'tidak' ? '✓' : '');
                    $ws3d->setCellValue("I$baris", $pilihan == 'belum' ? '✓' : '');
                }
            }

            $fileName = "KREDENSIAL_" . str_replace(' ', '_', ($d['nama_asesi'] ?? 'export')) . ".xlsx";
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
            exit;

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
