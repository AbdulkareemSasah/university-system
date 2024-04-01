<?php

namespace App\Filament\Resources\LevelResource\Pages;

use App\Filament\Resources\LevelResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLevel extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = LevelResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
