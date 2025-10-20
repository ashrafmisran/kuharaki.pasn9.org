<?php

namespace App\Filament\Resources\Perniagaans\Pages;

use App\Filament\Resources\Perniagaans\PerniagaanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPerniagaans extends ListRecords
{
    protected static string $resource = PerniagaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
