<?php

namespace App\Filament\Resources\CollageResource\Pages;

use App\Filament\Resources\CollageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCollage extends EditRecord
{
    protected static string $resource = CollageResource::class;
    use EditRecord\Concerns\Translatable;
    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
