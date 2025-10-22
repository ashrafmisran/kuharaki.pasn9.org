<?php

namespace App\Filament\Resources\Perniagaans\Pages;

use App\Filament\Resources\Perniagaans\PerniagaanResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePerniagaan extends CreateRecord
{
    protected static string $resource = PerniagaanResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (auth()->check()) {
            $data['pemilik'] = auth()->id();
        }
        return $data;
    }
}
