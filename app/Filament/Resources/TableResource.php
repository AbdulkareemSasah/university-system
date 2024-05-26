<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TableResource\Pages;
use App\Filament\Resources\TableResource\RelationManagers;
use App\Filament\Resources\TableResource\RelationManagers\LecturesRelationManager;
use App\Models\Table;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table as FilamentTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;

class TableResource extends Resource
{
    use Translatable;
    protected static ?string $model = Table::class;
    protected static ?int $navigationSort = 8;
    public static function getModelLabel(): string
    {
        return __("Table");
    }
    public static function getPluralModelLabel(): string
    {
        return __('Tables');
    }
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('year_id')->label(__("Year"))
                        ->required()
                        ->relationShip("year", "name"),
                    Forms\Components\Select::make('term_id')->label(__("Term"))
                        ->required()
                        ->relationShip("term", "name"),
                    Forms\Components\Select::make('collage_id')->label(__("Collage"))
                        ->required()
                        ->relationShip("collage", "name"),
                    Forms\Components\KeyValue::make('properties')->label(__("properties"))
                        ->columnSpanFull(),
                ])->columns(2)
            ]);
    }

    public static function table(FilamentTable $table): FilamentTable
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('year.name')->label(__("Year"))
                    ->sortable(),
                Tables\Columns\TextColumn::make('term.name')->label(__("Term"))
                    ->sortable(),
                Tables\Columns\TextColumn::make('collage.name')->label(__("Collage"))
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label(__("Created At"))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->label(__("Updated At"))
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
    public static function getTableQuery()
    {
        return parent::getTableQuery()
            ->loadMissing(['lectures.subjectLevelDoctor.subject', 'lectures.subjectLevelDoctor.doctor']);
    }
    public static function getRelations(): array
    {
        return [
            LecturesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTables::route('/'),
            'create' => Pages\CreateTable::route('/create'),
            'view' => Pages\ViewTable::route('/{record}'),
            'edit' => Pages\EditTable::route('/{record}/edit'),
            'schedule' => Pages\LectureScheduleTable::route('/{record}/schedule')
        ];
    }
}
