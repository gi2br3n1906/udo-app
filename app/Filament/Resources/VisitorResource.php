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
                    ->searchable()
                    ->sortable(),
                TextColumn::make('school_origin')
                    ->label('School')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('class')
                    ->searchable(),
                TextColumn::make('visited_at')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('visited_at')
                    ->form([
                        DatePicker::make('from')
                            ->label('From Date'),
                        DatePicker::make('until')
                            ->label('Until Date'),
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
                            ->withFilename(fn () => 'UDO_Visitors_' . date('Y-m-d'))
                            ->withColumns([
                                Column::make('name')->heading('Name'),
                                Column::make('school_origin')->heading('School'),
                                Column::make('class')->heading('Class'),
                                Column::make('visited_at')->heading('Registered At'),
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
