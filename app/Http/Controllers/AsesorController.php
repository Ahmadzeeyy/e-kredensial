<?php

namespace App\Http\Controllers;

use App\Models\Kredensial;
use Illuminate\Http\Request;

class AsesorController extends Controller
{
    public function index()
    {
        $kredensials = Kredensial::where('status', 'Submitted')
            ->orWhere('status', 'Under Review')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('asesor.dashboard', compact('kredensials'));
    }
}
