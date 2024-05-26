<?php

namespace App\Filament\Resources\LevelResource\RelationManagers;

use App\Filament\Resources\UserResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\Concerns\Translatable;

class DoctorsRelationManager extends RelationManager
{
    protected static string $relationship = 'doctors';
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __("Doctors");
    }
    public function isReadOnly(): bool
    {
        return true;
    }

    public function table(Table $table): Table
    {
        return UserResource::table($table);
    }
}
