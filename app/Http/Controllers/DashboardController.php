<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Penilaian;
use App\Models\Soal;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalPeserta' => Penilaian::count(),
            'totalPetugas' => User::where('role', 'petugas')->count(),
            'totalSoal' => Soal::count(),
            'recentPenilaian' => Penilaian::latest()->take(5)->get(),
        ]);
    }
}
