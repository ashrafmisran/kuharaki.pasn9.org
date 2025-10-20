<?php

namespace App\Filament\Resources\Perniagaans\Pages;

use App\Filament\Resources\Perniagaans\PerniagaanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPerniagaan extends ViewRecord
{
    protected static string $resource = PerniagaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
