<?php

namespace App\Filament\Resources\TermResource\Pages;

use App\Filament\Resources\TermResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTerm extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = TermResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
