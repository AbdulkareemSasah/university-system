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
    protected static ?int $navigationSort = 1;
    public static function getModelLabel(): string
    {
        return __("General");
    }
    public static function getPluralModelLabel(): string
    {
        return __('General');
    }
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('university_name')->label(__('University name'))
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')->label(__('Description'))
                    ->maxLength(255),
                Forms\Components\CheckboxList::make('schooling_days')
                    ->label(__('Schooling Days'))
                    ->options([
                        '1' => 'السبت',
                        '2' => 'الأحد',
                        '3' => 'الاثنين',
                        '4' => 'الثلاثاء',
                        '5' => 'الأربعاء',
                        '6' => 'الخميس',
                        '7' => 'الجمعة',
                    ])
                    ->columns(4),
                Forms\Components\FileUpload::make('image')->label(__('image'))->disk("public")->directory("assets")
                    ->image(),
                Forms\Components\FileUpload::make('logo')->label(__('logo'))->disk("public")->directory("assets")
                    ->image(),
                Forms\Components\FileUpload::make('dark_logo')->label(__('dark logo'))->disk("public")->directory("assets")
                    ->image(),
                Forms\Components\FileUpload::make('light_logo')->label(__('light logo'))->disk("public")->directory("assets")
                    ->image(),
                Forms\Components\Builder::make("navbar")->label(__("Table Header"))->schema([
                    Forms\Components\Builder\Block::make("column")->label(__("column"))->schema([
                        Forms\Components\TextInput::make("country")->label(__("Country")),
                        Forms\Components\TextInput::make("ministry")->label(__("Ministry")),
                    ])
                ])->maxItems(1),
                Forms\Components\Builder::make("footer")->label(__("Footer"))->schema([
                    Forms\Components\Builder\Block::make("column")->label(__("column"))->schema([
                        Forms\Components\TextInput::make("position")->label(__("Position")),
                        Forms\Components\TextInput::make("title_name")->label(__("Title Name")),
                        Forms\Components\TextInput::make("name")->label(__("Name")),
                    ])
                ])->maxItems(5)



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('university_name')->label(__("University name"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')->label(__("Description"))
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')->label(__("Image")),
                Tables\Columns\ImageColumn::make('logo')->label(__("Logo"))
                    ->searchable(),
                Tables\Columns\ImageColumn::make('dark_logo')->label(__("Dark Logo"))
                    ->searchable(),
                Tables\Columns\ImageColumn::make('light_logo')->label(__("Light Logo"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label(__("Created At"))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->label("Updated At")
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
            'view' => Pages\ViewGeneral::route('/{record}'),
            'edit' => Pages\EditGeneral::route('/{record}/edit'),
        ];
    }
}
