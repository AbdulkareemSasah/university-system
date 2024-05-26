<?php

namespace App\Filament\Resources\LevelResource\RelationManagers;

use App\Filament\Resources\SubjectResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\RelationManagers\Concerns\Translatable;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubjectsRelationManager extends RelationManager
{
    use Translatable;
    protected static string $relationship = 'subjects';
    public function isReadOnly(): bool
    {
        return true;
    }


    public function table(Table $table): Table
    {
        return SubjectResource::table($table);
    }
}
