<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kredensial;

class KredensialController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->check()) {
            $role = auth()->user()->role;
            if (in_array($role, ['admin', 'super_admin'])) return redirect()->route('admin.dashboard');
            if ($role === 'asesor') return redirect()->route('asesor.dashboard');
            
            // Redirect to dashboard if they have existing submissions and not editing specific one
            if (!$request->id && auth()->user()->kredensials()->exists()) {
                return redirect()->route('dashboard');
            }
        }

        $existing = null;
        if ($request->id) {
            $existing = Kredensial::where('user_id', auth()->id())->find($request->id);
        }

        $competencyList = \App\Helpers\CompetencyHelper::getList();
        return view('index', compact('competencyList', 'existing'));
    }

    public function dashboard()
    {
        if (auth()->check()) {
            $role = auth()->user()->role;
            if (in_array($role, ['admin', 'super_admin'])) return redirect()->route('admin.dashboard');
            if ($role === 'asesor') return redirect()->route('asesor.dashboard');
        }

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
        // Decode JSON fields from FormData
        $consent = json_decode($request->consent, true);
        $umpan = json_decode($request->umpan_balik, true);
        $porto = json_decode($request->portofolio, true);
        $kompetensi = json_decode($request->data_kompetensi, true);
        $pelatihan = json_decode($request->pelatihan, true);
        $iki = json_decode($request->iki, true);
        $asesmen_history = json_decode($request->asesmen_history, true);

        // Exclude file objects from data (not JSON-serializable)
        $data = $request->except([
            'file_ijazah', 'file_transkrip', 'file_str', 
            'file_praktik', 'file_sertifikat', 'file_logbook', 'file_form',
            '_token'
        ]);
        
        // Override with decoded JSON values
        $data['consent'] = $consent;
        $data['umpan_balik'] = $umpan;
        $data['portofolio'] = $porto;
        $data['data_kompetensi'] = $kompetensi;
        $data['pelatihan'] = $pelatihan;
        $data['iki'] = $iki;
        $data['asesmen_history'] = $asesmen_history;

        // Process STR Expiry for warning system
        $strExpiry = null;
        if (!empty($data['berlaku_str'])) {
            $strStr = strtolower(trim($data['berlaku_str']));
            if (str_contains($strStr, 'seumur hidup')) {
                $strExpiry = '9999-12-31';
            } else {
                // Try to parse dd/mm/yyyy
                try {
                    $date = \Carbon\Carbon::createFromFormat('d/m/Y', $data['berlaku_str']);
                    $strExpiry = $date->format('Y-m-d');
                } catch (\Exception $e) {
                    // Fallback or leave null if format is wrong
                    $strExpiry = null;
                }
            }
        }

        // Update or Create Kredensial record
        $kredensial = Kredensial::updateOrCreate(
            [
                'id' => $request->existing_id,
                'user_id' => auth()->id()
            ],
            [
                'nama_asesi' => $request->nama_asesi,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'jabatan' => $request->jabatan,
                'tanggal' => $request->tanggal,
                'str_expiry' => $strExpiry,
                'data_lengkap' => $data,
                'status' => 'Submitted'
            ]
        );

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

        return response()->json([
            'success' => true, 
            'message' => 'Pengajuan berhasil dikirim.',
            'id' => $kredensial->id
        ]);
    }
}
