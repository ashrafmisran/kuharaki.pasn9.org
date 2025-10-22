<?php

namespace App\Filament\Resources\ProdukServis\Pages;

use App\Filament\Resources\ProdukServis\ProdukServisResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProdukServis extends CreateRecord
{
    protected static string $resource = ProdukServisResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ensure the selected perniagaan belongs to the user; otherwise abort
        if (auth()->check() && isset($data['perniagaan_id'])) {
            $owns = \App\Models\Perniagaan::where('id', $data['perniagaan_id'])
                ->where('pemilik', auth()->id())
                ->exists();

            abort_unless($owns, 403);
        }

        return $data;
    }
}
