<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisitorResource\Pages;
use App\Models\Visitor;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;

class VisitorResource extends Resource
{
    protected static ?string $model = Visitor::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-users';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Pengunjung';
    protected static ?string $pluralModelLabel = 'Pengunjung';
    protected static ?string $navigationLabel = 'Pengunjung';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Read-only resource, no form needed
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('school_origin')
                    ->label('Asal Sekolah')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->label('No. WhatsApp')
                    ->searchable(),
                TextColumn::make('dream_major')
                    ->label('Jurusan Impian')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('visited_at')
                    ->label('Waktu Kunjungan')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                TextColumn::make('ip_address')
                    ->label('Alamat IP')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('visited_at')
                    ->form([
                        DatePicker::make('from')
                            ->label('Dari Tanggal'),
                        DatePicker::make('until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn ($query, $date) => $query->whereDate('visited_at', '>=', $date))
                            ->when($data['until'], fn ($query, $date) => $query->whereDate('visited_at', '<=', $date));
                    }),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exports([
                        ExcelExport::make('table')
                            ->fromTable()
                            ->withFilename(fn () => 'UDO_Pengunjung_' . date('Y-m-d'))
                            ->withColumns([
                                Column::make('name')->heading('Nama'),
                                Column::make('school_origin')->heading('Asal Sekolah'),
                                Column::make('phone')->heading('No. WhatsApp'),
                                Column::make('dream_major')->heading('Jurusan Impian'),
                                Column::make('visited_at')->heading('Waktu Kunjungan'),
                            ]),
                    ]),
            ])
            ->defaultSort('visited_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVisitors::route('/'),
            'view' => Pages\ViewVisitor::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }
}
