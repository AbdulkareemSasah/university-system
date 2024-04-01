<?php

namespace App\Filament\Resources\CollageResource\Pages;

use App\Filament\Resources\CollageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCollages extends ListRecords
{
    protected static string $resource = CollageResource::class;
    use ListRecords\Concerns\Translatable;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
