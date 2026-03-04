<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Categories;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CategoriesInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Categories $record): bool => $record->trashed()),
            ]);
    }
}
