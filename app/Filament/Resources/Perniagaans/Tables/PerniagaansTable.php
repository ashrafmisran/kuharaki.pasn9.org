<?php

namespace App\Filament\Resources\Perniagaans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
class PerniagaansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                if (auth()->check()) {
                    $query->where('pemilik', auth()->id());
                } else {
                    // Ensure no records are shown if not authenticated
                    $query->whereRaw('1 = 0');
                }
            })
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Perniagaan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('bandar.nama')
                    ->label('Bandar')
                    ->searchable()
                    ->sortable(),
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
