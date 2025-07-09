<?php

namespace App\Filament\Widgets;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Report;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalDonations = Donation::where('status', 'success')->sum('amount');
        $activeCampaigns = Campaign::where('status', 'active')->count();
        $verifiedUsers = User::where('is_verified', true)->count();
        $pendingReports = Report::where('status', 'submitted')->count();

        return [
            Stat::make('Total Donasi Terkumpul', 'Rp ' . number_format($totalDonations, 0, ',', '.'))
                ->description('Semua donasi yang berhasil')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Campaign Aktif', $activeCampaigns)
                ->description('Campaign yang sedang berjalan')
                ->descriptionIcon('heroicon-m-gift')
                ->color('primary'),
            Stat::make('Pengguna Terverifikasi', $verifiedUsers)
                ->description('Mahasiswa yang sudah terverifikasi')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
            Stat::make('Laporan Perlu Ditinjau', $pendingReports)
                ->description('Laporan yang belum diproses')
                ->descriptionIcon('heroicon-m-flag')
                ->color('danger'),
        ];
    }
}
