<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LevelResource\Pages;
use App\Filament\Resources\LevelResource\RelationManagers;
use App\Models\Level;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;

class LevelResource extends Resource
{
    use Translatable;
    protected static ?string $model = Level::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')->tabs([
                    Tabs\Tab::make(__('Information'))->schema([
                        Section::make(__("Create New Level"))->schema([
                            Select::make("department")->label(__("Department"))->relationship('department', 'name'),
                            TextInput::make("name")->label(__("name")),
                            TextInput::make("slug")->label(__("slug")),
                            Textarea::make("description")->label(__("description")),
                            Checkbox::make("visible")->label(__("visible")),

                        ]),
                        Section::make("")->schema([
                            KeyValue::make(__("properties")),
                            FileUpload::make(__("image")),
                        ])
                    ])->columns(2),
                    Tabs\Tab::make(__('Content'))->schema([
                        Section::make(__("Write This Content If you want make page for this"))->schema([
                            Builder::make(__('content'))
                                ->blocks([
                                    Builder\Block::make('heading')
                                        ->schema([
                                            TextInput::make('content')
                                                ->label('Heading')
                                                ->required(),
                                            Select::make('level')
                                                ->options([
                                                    'h1' => 'Heading 1',
                                                    'h2' => 'Heading 2',
                                                    'h3' => 'Heading 3',
                                                    'h4' => 'Heading 4',
                                                    'h5' => 'Heading 5',
                                                    'h6' => 'Heading 6',
                                                ])
                                                ->required(),
                                        ])
                                        ->columns(2),
                                    Builder\Block::make('paragraph')
                                        ->schema([
                                            Textarea::make('content')
                                                ->label('Paragraph')
                                                ->required(),
                                        ]),
                                    Builder\Block::make('image')
                                        ->schema([
                                            FileUpload::make('url')
                                                ->label('Image')
                                                ->image()
                                                ->required(),
                                            TextInput::make('alt')
                                                ->label('Alt text')
                                                ->required(),
                                        ]),
                                    Builder\Block::make('richfield')
                                        ->schema([
                                            RichEditor::make('content')
                                                ->required(),
                                        ]),
                                    Builder\Block::make('markdown')
                                        ->schema([
                                            MarkdownEditor::make('content')
                                                ->required(),
                                        ]),
                                ])
                                ->columnSpanFull(),
                        ])
                    ]),
                ])

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('department_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('count_of_student')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('visible')
                    ->boolean(),
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
            'index' => Pages\ListLevels::route('/'),
            'create' => Pages\CreateLevel::route('/create'),
            'view' => Pages\ViewLevel::route('/{record}'),
            'edit' => Pages\EditLevel::route('/{record}/edit'),
        ];
    }
}
