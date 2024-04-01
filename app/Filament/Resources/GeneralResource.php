<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GeneralResource\Pages;
use App\Filament\Resources\GeneralResource\RelationManagers;
use App\Models\General;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;

class GeneralResource extends Resource
{
    use Translatable;
    protected static ?string $model = General::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('university_name')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('navbar')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('footer')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('logo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('dark_logo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('light_logo')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('logo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dark_logo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('light_logo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGenerals::route('/'),
            'create' => Pages\CreateGeneral::route('/create'),
            'view' => Pages\ViewGeneral::route('/{record}'),
            'edit' => Pages\EditGeneral::route('/{record}/edit'),
        ];
    }
}
