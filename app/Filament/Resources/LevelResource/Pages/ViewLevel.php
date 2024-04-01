<?php

namespace App\Filament\Resources\LevelResource\Pages;

use App\Filament\Resources\LevelResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLevel extends ViewRecord
{
    protected static string $resource = LevelResource::class;
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
