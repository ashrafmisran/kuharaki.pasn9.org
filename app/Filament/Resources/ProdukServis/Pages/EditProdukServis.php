<?php

namespace App\Filament\Resources\ProdukServis\Pages;

use App\Filament\Resources\ProdukServis\ProdukServisResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditProdukServis extends EditRecord
{
    protected static string $resource = ProdukServisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
