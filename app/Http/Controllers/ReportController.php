<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'reportable_id' => 'required|integer',
            'reportable_type' => 'required|string',
            'reason' => 'required|string|min:10',
        ]);

        // Cek apakah user sudah pernah melaporkan konten yang sama
        $existingReport = Report::where('reporter_id', auth()->id())
            ->where('reportable_id', $request->reportable_id)
            ->where('reportable_type', $request->reportable_type)
            ->exists();

        if ($existingReport) {
            return back()->with('error', 'Anda sudah pernah melaporkan konten ini.');
        }

        Report::create([
            'reporter_id' => auth()->id(),
            'reportable_id' => $request->reportable_id,
            'reportable_type' => $request->reportable_type,
            'reason' => $request->reason,
            'status' => 'submitted', // Status awal laporan
        ]);

        return back()->with('success', 'Laporan Anda telah terkirim. Terima kasih atas kontribusi Anda.');
    }
}
