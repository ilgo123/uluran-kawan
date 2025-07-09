<?php

namespace App\Filament\Widgets;

use App\Models\Donation;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class DonationsChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Donasi (14 Hari Terakhir)';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Donation::where('status', 'success')
            ->where('created_at', '>=', now()->subDays(14))
            ->selectRaw('DATE(created_at) as date, SUM(amount) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Donasi Masuk',
                    'data' => $data->map(fn ($value) => $value->total)->toArray(),
                    'backgroundColor' => 'rgba(34, 197, 94, 0.2)',
                    'borderColor' => 'rgb(34, 197, 94)',
                ],
            ],
            'labels' => $data->map(fn ($value) => Carbon::parse($value->date)->format('d M'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
