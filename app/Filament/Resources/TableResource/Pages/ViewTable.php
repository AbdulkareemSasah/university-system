<?php

namespace App\Filament\Resources\TableResource\Pages;

use App\Filament\Resources\TableResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTable extends ViewRecord
{
    protected static string $resource = TableResource::class;
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
