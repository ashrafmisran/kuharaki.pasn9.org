<?php

namespace App\Filament\Resources\Perniagaans\Pages;

use App\Filament\Resources\Perniagaans\PerniagaanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPerniagaan extends EditRecord
{
    protected static string $resource = PerniagaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
