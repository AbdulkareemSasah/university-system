<?php

namespace App\Filament\Resources\CollageResource\Pages;

use App\Filament\Resources\CollageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCollage extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = CollageResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
