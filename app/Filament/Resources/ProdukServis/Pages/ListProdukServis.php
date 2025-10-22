<?php

namespace App\Filament\Resources\ProdukServis\Pages;

use App\Filament\Resources\ProdukServis\ProdukServisResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProdukServis extends ListRecords
{
    protected static string $resource = ProdukServisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
