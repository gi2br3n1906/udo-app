<?php

namespace App\Filament\Resources\RundownResource\Pages;

use App\Filament\Resources\RundownResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRundowns extends ListRecords
{
    protected static string $resource = RundownResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
