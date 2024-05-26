<?php

namespace App\Filament\Resources\CollageResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\Concerns\Translatable;

class DepartmentsRelationManager extends RelationManager
{
    use Translatable;
    protected static string $relationship = 'departments';
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __("Departments");
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__("Create New Department"))->schema([
                    TextInput::make("name")->label(__("name")),
                    TextInput::make("slug")->label(__("slug")),
                    Textarea::make("description")->label(__("description")),
                    Checkbox::make("visible")->label(__("visible")),
                ]),
                Section::make("")->schema([
                    FileUpload::make("image")->label(__("image")),
                ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label(__("image")),
                Tables\Columns\TextColumn::make('name')->label(__("name")),
                Tables\Columns\TextColumn::make('slug')->label(__("slug")),
                Tables\Columns\IconColumn::make('visible')->label(__("visible"))->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\LocaleSwitcher::make(),
                Tables\Actions\CreateAction::make()->label(__("Create Department")),
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
