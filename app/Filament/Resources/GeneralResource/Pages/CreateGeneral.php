<?php

namespace App\Filament\Resources\GeneralResource\Pages;

use App\Filament\Resources\GeneralResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGeneral extends CreateRecord
{

    use CreateRecord\Concerns\Translatable;
    protected static string $resource = GeneralResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
