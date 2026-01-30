<?php

namespace App\Filament\Exports;

use App\Models\Visitor;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class VisitorExporter extends Exporter
{
    protected static ?string $model = Visitor::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name')
                ->label('Name'),
            ExportColumn::make('school_origin')
                ->label('School Origin'),
            ExportColumn::make('phone')
                ->label('WhatsApp Number'),
            ExportColumn::make('dream_major')
                ->label('Dream Major'),
            ExportColumn::make('visited_at')
                ->label('Registered At'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your visitor export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
