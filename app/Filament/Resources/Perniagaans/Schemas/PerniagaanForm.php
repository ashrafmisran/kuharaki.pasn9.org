<?php

namespace App\Filament\Resources\Perniagaans\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\FileUpload;

class PerniagaanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->label('Nama Perniagaan')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('logo')
                    ->label('Logo Perniagaan')
                    ->image()
                    ->disk('public')
                    ->maxSize(2048) // 2MB
                    ->directory('img/logo')
                    ->nullable(),
                Hidden::make('pemilik')
                    ->default(auth()->id()),
                TextInput::make('no_telefon')
                    ->label('Nombor Telefon')
                    ->tel()
                    ->required()
                    ->maxLength(20),
                TextInput::make('emel')
                    ->label('Alamat Emel')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('alamat_baris_1')
                    ->label('Alamat Perniagaan')
                    ->required()
                    ->maxLength(500),
                TextInput::make('alamat_baris_2')
                    ->label('Alamat Baris 2')
                    ->maxLength(500),
                TextInput::make('poskod')
                    ->label('Poskod')
                    ->required()
                    ->maxLength(10),
                Select::make('bandar_id')
                    ->label('Bandar')
                    ->relationship('bandar', 'nama')
                    ->required()
                    ->createOptionForm([
                        TextInput::make('nama')
                            ->label('Nama Bandar')
                            ->required()
                            ->maxLength(255),
                        Select::make('negeri_id')
                            ->label('Negeri')
                            ->relationship('negeri', 'nama')
                            ->required()
                            ->createOptionForm([
                                TextInput::make('nama')
                                    ->label('Nama Negeri')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                    ]),
                Select::make('negeri_id')
                    ->label('Negeri')
                    ->relationship('negeri', 'nama')
                    ->required()
                    ->createOptionForm([
                        TextInput::make('nama')
                            ->label('Nama Negeri')
                            ->required()
                            ->maxLength(255),
                    ]),
                Select::make('kategori')
                    ->label('Kategori Perniagaan')
                    ->options([
                        'fizikal' => 'Fizikal',
                        'atas talian' => 'Atas Talian',
                        'hibrid' => 'Hibrid',
                    ])
                    ->required(),
            ]);
    }
}
