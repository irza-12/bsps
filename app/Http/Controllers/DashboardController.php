<?php

namespace App\Http\Controllers;

use App\Models\Bsps;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalData = Bsps::count();
        $currentYear = date('Y');
        $dataThisYear = Bsps::where('tahun', $currentYear)->count();
        $dusunStats = Bsps::selectRaw('dusun, COUNT(*) as total')
            ->groupBy('dusun')
            ->orderBy('total', 'desc')
            ->get();
        $latestData = Bsps::orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard', compact('totalData', 'dataThisYear', 'dusunStats', 'latestData', 'currentYear'));
    }
}
