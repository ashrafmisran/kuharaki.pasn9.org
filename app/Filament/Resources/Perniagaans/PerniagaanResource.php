<?php

namespace App\Filament\Resources\Perniagaans;

use App\Filament\Resources\Perniagaans\Pages\CreatePerniagaan;
use App\Filament\Resources\Perniagaans\Pages\EditPerniagaan;
use App\Filament\Resources\Perniagaans\Pages\ListPerniagaans;
use App\Filament\Resources\Perniagaans\Pages\ViewPerniagaan;
use App\Filament\Resources\Perniagaans\Schemas\PerniagaanForm;
use App\Filament\Resources\Perniagaans\Schemas\PerniagaanInfolist;
use App\Filament\Resources\Perniagaans\Tables\PerniagaansTable;
use App\Models\Perniagaan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PerniagaanResource extends Resource
{
    protected static ?string $model = Perniagaan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Schema $schema): Schema
    {
        return PerniagaanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PerniagaanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PerniagaansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPerniagaans::route('/'),
            //'create' => CreatePerniagaan::route('/create'),
            'view' => ViewPerniagaan::route('/{record}'),
            'edit' => EditPerniagaan::route('/{record}/edit'),
        ];
    }
}
