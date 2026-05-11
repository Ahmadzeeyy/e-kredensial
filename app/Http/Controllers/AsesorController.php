<?php

namespace App\Http\Controllers;

use App\Models\Kredensial;
use Illuminate\Http\Request;

class AsesorController extends Controller
{
    public function index(Request $request)
    {
        $query = Kredensial::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_asesi', 'like', "%{$search}%")
                  ->orWhere('jabatan', 'like', "%{$search}%")
                  ->orWhere('data_lengkap', 'like', "%{$search}%");
            });
        }

        $kredensials = (clone $query)->whereIn('status', ['Submitted', 'Under Review'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        $history = (clone $query)->where('status', 'Approved')
            ->orderBy('updated_at', 'desc')
            ->get();
            
        return view('asesor.dashboard', compact('kredensials', 'history'));
    }
}
