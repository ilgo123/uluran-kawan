<?php

namespace App\Filament\Resources\DonationResource\Pages;

use App\Filament\Resources\DonationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListDonations extends ListRecords
{
    protected static string $resource = DonationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(), // Kita nonaktifkan pembuatan donasi oleh admin

            // 2. Tambahkan ExportAction di sini
            ExportAction::make()
                ->exports([
                    // Membuat satu opsi ekspor bernama "Laporan Donasi"
                    ExcelExport::make('table')->fromTable()
                        ->withFilename('Laporan Donasi - ' . date('Y-m-d'))
                        ->withWriterType(\Maatwebsite\Excel\Excel::CSV), // Bisa diganti ke XLSX jika perlu

                    // Opsi kustom dengan kolom pilihan
                    ExcelExport::make('form')->fromForm()
                        ->withFilename('Detail Donasi Custom')
                        ->withColumns([
                            Column::make('campaign.title')->heading('Judul Campaign'),
                            Column::make('user.name')->heading('Nama Donatur'),
                            Column::make('amount')->heading('Jumlah (Rp)'),
                            Column::make('status')->heading('Status'),
                            Column::make('created_at')->heading('Tanggal Donasi'),
                        ]),
                ])
        ];
    }
}
