<?php

namespace App\Filament\Resources\DataUserResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\DataUserResource;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Exp;

class ListDataUsers extends ListRecords
{
    protected static string $resource = DataUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Tambah Data Pendaftar'),
            ExportAction::make()
            ->exports([
                ExcelExport::make()
                    ->fromTable()->only([
                        'Nm_pendaftar',
                        'Alamat',
                        'Jenis_kelamin',
                        'No_hp',
                        'Asal_sekolah',
                        'Jurusan',
                        'Tgl_lahir',
                        'NISN',
                    ])
                    ->withFilename(fn ($resource) => $resource::getModelLabel() . '-' . date('Y-m-d'))
                    ->withWriterType(\Maatwebsite\Excel\Excel::XLSX),
                    ]),
        ];
    }
}
