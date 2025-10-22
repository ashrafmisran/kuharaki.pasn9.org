<?php

namespace App\Filament\Resources\ProdukServis\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;

class ProdukServisForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('perniagaan_id')
                    ->label('Perniagaan')
                    ->required()
                    ->relationship('perniagaan', 'nama', function (Builder $query) {
                        if (auth()->check()) {
                            $query->where('pemilik', auth()->id());
                        } else {
                            $query->whereRaw('1 = 0');
                        }
                    })
                    ->preload(),
                TextInput::make('nama')
                    ->required()
                    ->columnSpanFull(),
                Select::make('jenis')
                    ->options([
                        'produk' => 'Produk',
                        'servis' => 'Servis',
                    ])
                    ->required(),
                RichEditor::make('keterangan')
                    ->columnSpanFull(),
                Select::make('kategori_harga')
                    ->options([
                        'tetap' => 'Tetap',
                        'bermula dari' => 'Bermula dari',
                    ])
                    ->required()
                    ->default('tetap'),
                TextInput::make('harga')
                    ->required()
                    ->prefix('RM'),
            ]);
    }
}
