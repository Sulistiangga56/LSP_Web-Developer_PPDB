<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\DataUser;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\TextInput;
use pxlrbt\FilamentExcel\Columns\Column;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use App\Filament\Resources\DataUserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\DataUserResource\RelationManagers;

class DataUserResource extends Resource
{
    protected static ?string $model = DataUser::class;

    protected static ?string $modelLabel = 'Data Pendaftar';

    protected static ?string $pluralLabel = 'Pendaftar';

    protected static ?string $pluralModelLabel = 'Data Pendaftar';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('Nm_pendaftar')
                ->label('Nama Pendaftar')
                ->required(),
                TextArea::make('Alamat')
                ->label('Alamat')
                ->required(),
                Select::make('Jenis_kelamin')
                ->label('Jenis Kelamin')
                ->options([
                    'Laki-laki' => 'Laki-laki',
                    'Perempuan' => 'Perempuan',
                ])
                ->required(),
                TextInput::make('No_hp')
                ->numeric()
                ->label('No HP')
                ->required(),
                TextInput::make('Asal_sekolah')
                ->label('Asal Sekolah')
                ->required(),
                Select::make('Jurusan')
                ->options([
                    'RPL' => 'RPL',
                    'TKJ' => 'TKJ',
                    'MM' => 'MM',
                ])
                ->label('Jurusan')
                ->required(),
                DatePicker::make('Tgl_lahir')
                ->format('d/m/Y')
                ->label('Tanggal Lahir')
                ->required(),
                TextInput::make('NISN')
                ->numeric()
                ->label('NISN')
                ->minlength(10)
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')
                ->rowIndex(),
                Tables\Columns\TextColumn::make('Nm_pendaftar')
                ->searchable()
                ->label('Nama Pendaftar'),
                Tables\Columns\TextColumn::make('Alamat')
                ->searchable()
                ->label('Alamat'),
                Tables\Columns\TextColumn::make('Jenis_kelamin')
                ->searchable()
                ->label('Jenis Kelamin'),
                Tables\Columns\TextColumn::make('No_hp')
                ->searchable()
                ->label('No HP'),
                Tables\Columns\TextColumn::make('Asal_sekolah')
                ->searchable()
                ->label('Asal Sekolah'),
                Tables\Columns\TextColumn::make('Jurusan')
                ->searchable()
                ->label('Jurusan'),
                Tables\Columns\TextColumn::make('Tgl_lahir')
                ->searchable()
                ->label('Tanggal Lahir'),
                Tables\Columns\TextColumn::make('NISN')
                ->searchable()
                ->label('NISN'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('Jenis_kelamin')
                ->label('Jenis Kelamin')
                ->options([
                    'Laki-laki' => 'Laki-laki',
                    'Perempuan' => 'Perempuan',
                ])
                ->searchable(),
                Tables\Filters\SelectFilter::make('Jurusan')
                ->label('Jurusan')
                ->options([
                    'RPL' => 'RPL',
                    'TKJ' => 'TKJ',
                    'MM' => 'MM',
                ])
                ->searchable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()->exports([
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
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDataUsers::route('/'),
            'create' => Pages\CreateDataUser::route('/create'),
            'edit' => Pages\EditDataUser::route('/{record}/edit'),
            'view' => Pages\ViewDataUser::route('/{record}'),
        ];
    }

    public static function getPluralLabel(): string
    {
        return static::$pluralLabel;
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                ->schema([
                Fieldset::make('Informasi Data Pendaftar')
                ->schema([
                    TextEntry::make('Nm_pendaftar')
                    ->label('Nama Pendaftar :')
                    ->icon('heroicon-m-user')
                    ->color('secondary'),
                    TextEntry::make('Alamat')
                    ->label('Alamat :')
                    ->color('secondary'),
                    TextEntry::make('Jenis_kelamin')
                    ->label('Jenis Kelamin :')
                    ->color('secondary'),
                    TextEntry::make('No_hp')
                    ->label('Nomor HP :')
                    ->color('secondary'),
                    TextEntry::make('Asal_sekolah')
                    ->label('Asal Sekolah :')
                    ->color('secondary'),
                    TextEntry::make('Jurusan')
                    ->label('Jurusan :')
                    ->color('secondary'),
                    TextEntry::make('Tgl_lahir')
                    ->label('Tanggal Lahir :')
                    ->color('secondary'),
                    TextEntry::make('NISN')
                    ->label('NISN :')
                    ->color('secondary'),
                    ])->columns(2),
                ])
            ]);
    }
}
