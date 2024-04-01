<?php

namespace App\Filament\Resources\ClassroomResource\Pages;

use App\Filament\Resources\ClassroomResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateClassroom extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = ClassroomResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
