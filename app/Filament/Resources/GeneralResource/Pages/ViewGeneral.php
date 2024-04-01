<?php

namespace App\Filament\Resources\GeneralResource\Pages;

use App\Filament\Resources\GeneralResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGeneral extends ViewRecord
{
    protected static string $resource = GeneralResource::class;
    use ViewRecord\Concerns\Translatable;
    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\LocaleSwitcher::make(),

        ];
    }
}
