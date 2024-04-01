<?php

namespace App\Filament\Resources\TermResource\Pages;

use App\Filament\Resources\TermResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTerm extends ViewRecord
{
    protected static string $resource = TermResource::class;
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
