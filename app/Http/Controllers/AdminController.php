<?php

namespace App\Http\Controllers;

use App\Models\Kredensial;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_kredensial' => \App\Models\Kredensial::count(),
            'total_users' => \App\Models\User::count(),
            'total_admin' => \App\Models\User::where('role', 'admin')->count(),
            'total_asesor' => \App\Models\User::where('role', 'asesor')->count(),
            'latest_kredensials' => \App\Models\Kredensial::latest()->take(5)->get()
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function listKredensial()
    {
        $kredensials = \App\Models\Kredensial::orderBy('created_at', 'desc')->get();
        return view('admin.kredensial.index', compact('kredensials'));
    }

    public function showAses($id)
    {
        $kredensial = Kredensial::findOrFail($id);
        return view('admin.ases', compact('kredensial'));
    }

    public function storeAses(Request $request, $id)
    {
        $kredensial = Kredensial::findOrFail($id);
        $kredensial->update([
            'data_asesor' => $request->ases
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Penilaian asesor berhasil disimpan.');
    }

    public function showForm5($id)
    {
        $kredensial = Kredensial::findOrFail($id);
        return view('admin.form5', compact('kredensial'));
    }

    public function storeForm5(Request $request, $id)
    {
        $kredensial = Kredensial::findOrFail($id);
        $kredensial->update([
            'data_form5' => $request->form5
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Form 5 berhasil disimpan');
    }

    public function showForm6($id)
    {
        $kredensial = Kredensial::findOrFail($id);
        return view('admin.form6', compact('kredensial'));
    }

    public function storeForm6(Request $request, $id)
    {
        $kredensial = Kredensial::findOrFail($id);
        $kredensial->update([
            'data_form6' => $request->form6
        ]);

        \App\Models\ActivityLog::log("Menilai Form 6 untuk pengajuan #{$id}", $kredensial);

        return redirect()->route('admin.kredensial.index')->with('success', 'Form 6 berhasil disimpan');
    }

    public function showForm7($id)
    {
        $kredensial = Kredensial::findOrFail($id);
        $competencyList = \App\Helpers\CompetencyHelper::getList();
        return view('admin.form7', compact('kredensial', 'competencyList'));
    }

    public function storeForm7(Request $request, $id)
    {
        $kredensial = Kredensial::findOrFail($id);
        $kredensial->update([
            'data_form7' => $request->form7
        ]);

        \App\Models\ActivityLog::log("Menilai Form 7 untuk pengajuan #{$id}", $kredensial);

        return redirect()->route('admin.kredensial.index')->with('success', 'Form 7 berhasil disimpan');
    }

    public function showForm9($id)
    {
        $kredensial = Kredensial::findOrFail($id);
        return view('admin.form9', compact('kredensial'));
    }

    public function storeForm9(Request $request, $id)
    {
        $kredensial = Kredensial::findOrFail($id);
        $kredensial->update([
            'data_form9' => $request->form9
        ]);

        \App\Models\ActivityLog::log("Menilai Form 9 untuk pengajuan #{$id}", $kredensial);

        return redirect()->route('admin.kredensial.index')->with('success', 'Form 9 berhasil disimpan');
    }

    public function showForm3A($id)
    {
        $kredensial = Kredensial::findOrFail($id);
        return view('admin.form3a', compact('kredensial'));
    }

    public function storeForm3A(Request $request, $id)
    {
        $kredensial = Kredensial::findOrFail($id);
        $kredensial->update([
            'data_form3a' => $request->form3a
        ]);

        \App\Models\ActivityLog::log("Menilai Form 3A untuk pengajuan #{$id}", $kredensial);

        return redirect()->route('admin.kredensial.index')->with('success', 'Form 3A berhasil disimpan');
    }

    public function showForm3B($id)
    {
        $kredensial = Kredensial::findOrFail($id);
        return view('admin.form3b', compact('kredensial'));
    }

    public function storeForm3B(Request $request, $id)
    {
        $kredensial = Kredensial::findOrFail($id);
        $kredensial->update([
            'data_form3b' => $request->form3b
        ]);

        \App\Models\ActivityLog::log("Menilai Form 3B untuk pengajuan #{$id}", $kredensial);

        return redirect()->route('admin.kredensial.index')->with('success', 'Form 3B berhasil disimpan');
    }

    public function showForm3D($id)
    {
        $kredensial = Kredensial::findOrFail($id);
        return view('admin.form3d', compact('kredensial'));
    }

    public function storeForm3D(Request $request, $id)
    {
        $kredensial = Kredensial::findOrFail($id);
        $kredensial->update([
            'data_form3d' => $request->form3d
        ]);

        \App\Models\ActivityLog::log("Menilai Form 3D untuk pengajuan #{$id}", $kredensial);

        return redirect()->route('admin.kredensial.index')->with('success', 'Form 3D berhasil disimpan');
    }

    public function download($id)
    {
        $kredensial = Kredensial::findOrFail($id);
        $d = $kredensial->data_lengkap;
        $a = $kredensial->data_asesor ?? [];

        try {
            $templatePath = storage_path('app/templates/PRA_PK_.xlsx');
            
            if (!file_exists($templatePath)) {
                return redirect()->back()->with('error', 'Template file tidak ditemukan');
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
                $ws1->setCellValue('F306', $d['nama_asessor'] ?? '');
                $ws1->setCellValue('F307', $d['no_reg_asesor'] ?? '');

                // --- BAGIAN 3 (Mapping Komperensi Umum) ---
                $startRow = 44; // Estimasi baris awal tabel kompetensi
                $currentRow = $startRow;
                
                $savedKomp = $a['kompetensi'] ?? [];
                $savedBukti = $a['bukti_text'] ?? [];
                $list = \App\Helpers\CompetencyHelper::getList();

                foreach ($list as $cat) {
                    $currentRow++; // Baris kategori utama (1, 2, 3...)
                    foreach ($cat as $key => $val) {
                        if (is_array($val)) {
                            $currentRow++; // Baris sub-kategori (A, B, C...)
                            foreach ($val['items'] as $subKey => $subVal) {
                                // Kolom G = Bukti, Kolom I = Kesesuaian
                                if (isset($savedBukti[$subKey])) {
                                    $ws1->setCellValue("G$currentRow", $savedBukti[$subKey]);
                                }
                                if (isset($savedKomp[$subKey])) {
                                    $ws1->setCellValue("I$currentRow", '✓');
                                }
                                $currentRow++;
                            }
                        } else {
                            if (isset($savedBukti[$key])) {
                                $ws1->setCellValue("G$currentRow", $savedBukti[$key]);
                            }
                            if (isset($savedKomp[$key])) {
                                $ws1->setCellValue("I$currentRow", '✓');
                            }
                            $currentRow++;
                        }
                    }
                }
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
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function viewFile($id, $type)
    {
        $kredensial = Kredensial::findOrFail($id);
        $files = $kredensial->data_lengkap['files'] ?? [];
        
        if (!isset($files[$type])) {
            abort(404, 'File tidak ditemukan');
        }

        $path = storage_path('app/' . $files[$type]);
        if (!file_exists($path)) {
            abort(404, 'File fisik tidak ditemukan');
        }

        return response()->file($path);
    }

    public function updateStatus(Request $request, $id)
    {
        $kredensial = Kredensial::findOrFail($id);
        $oldStatus = $kredensial->status;
        $kredensial->update([
            'status' => $request->status,
            'notes' => $request->notes ?? $kredensial->notes
        ]);

        \App\Models\ActivityLog::log("Mengubah status pengajuan #{$id} dari {$oldStatus} ke {$request->status}", $kredensial);

        return back()->with('success', 'Status pengajuan berhasil diperbarui');
    }
}

