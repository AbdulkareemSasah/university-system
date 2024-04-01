<?php

namespace App\Filament\Resources\GeneralResource\Pages;

use App\Filament\Resources\GeneralResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGenerals extends ListRecords
{
    protected static string $resource = GeneralResource::class;
    use ListRecords\Concerns\Translatable;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
