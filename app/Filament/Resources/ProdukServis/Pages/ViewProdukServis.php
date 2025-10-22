<?php

namespace App\Filament\Resources\ProdukServis\Pages;

use App\Filament\Resources\ProdukServis\ProdukServisResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProdukServis extends ViewRecord
{
    protected static string $resource = ProdukServisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
