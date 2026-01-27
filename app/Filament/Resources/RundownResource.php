<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RundownResource\Pages;
use App\Models\Rundown;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RundownResource extends Resource
{
    protected static ?string $model = Rundown::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                DateTimePicker::make('start_time')
                    ->required()
                    ->seconds(false),
                DateTimePicker::make('end_time')
                    ->required()
                    ->seconds(false)
                    ->after('start_time'),
                Textarea::make('description')
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start_time')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                TextColumn::make('end_time')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('start_time', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRundowns::route('/'),
            'create' => Pages\CreateRundown::route('/create'),
            'edit' => Pages\EditRundown::route('/{record}/edit'),
        ];
    }
}
