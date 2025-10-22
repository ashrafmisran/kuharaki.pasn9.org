<?php

namespace App\Filament\Resources\ProdukServis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class ProdukServisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                if (auth()->check()) {
                    // Only ProdukServis belonging to Perniagaan owned by the current user
                    $query->whereHas('perniagaan', function (Builder $q) {
                        $q->where('pemilik', auth()->id());
                    });
                } else {
                    $query->whereRaw('1 = 0');
                }
            })
            ->columns([
                TextColumn::make('nama')
                    ->searchable()
                    ->description(fn (TextColumn $column): string => $column->getRecord()->perniagaan->nama, 'above'),
                IconColumn::make('jenis')
                    ->icon(fn($state) => match($state) {
                        'produk' => 'heroicon-o-cube',
                        'servis' => 'heroicon-o-wrench-screwdriver',
                    }),
                TextColumn::make('harga')
                    ->prefix('RM')
                    ->description(fn (TextColumn $column): string => $column->getRecord()->kategori_harga, 'above')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
