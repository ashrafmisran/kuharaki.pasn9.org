<?php

namespace App\Filament\Resources\ProdukServis;

use App\Filament\Resources\ProdukServis\Pages\CreateProdukServis;
use App\Filament\Resources\ProdukServis\Pages\EditProdukServis;
use App\Filament\Resources\ProdukServis\Pages\ListProdukServis;
use App\Filament\Resources\ProdukServis\Pages\ViewProdukServis;
use App\Filament\Resources\ProdukServis\Schemas\ProdukServisForm;
use App\Filament\Resources\ProdukServis\Schemas\ProdukServisInfolist;
use App\Filament\Resources\ProdukServis\Tables\ProdukServisTable;
use App\Models\ProdukServis;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProdukServisResource extends Resource
{
    protected static ?string $model = ProdukServis::class;

    public static function getLabel(): string
    {
        return 'Produk & Servis';
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Schema $schema): Schema
    {
        return ProdukServisForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProdukServisInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProdukServisTable::configure($table);
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
            'index' => ListProdukServis::route('/'),
            //'create' => CreateProdukServis::route('/create'),
            'view' => ViewProdukServis::route('/{record}'),
            'edit' => EditProdukServis::route('/{record}/edit'),
        ];
    }
}
