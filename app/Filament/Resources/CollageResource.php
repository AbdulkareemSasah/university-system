<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CollageResource\Pages;
use App\Filament\Resources\CollageResource\RelationManagers;
use App\Filament\Resources\CollageResource\RelationManagers\DepartmentsRelationManager;
use App\Models\Collage;
use Filament\Forms;
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
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CollageResource extends Resource
{
    use Translatable;
    protected static ?string $model = Collage::class;
    protected static ?int $navigationSort = 4;
    public static function getModelLabel(): string
    {
        return __("Collage");
    }
    public static function getPluralModelLabel(): string
    {
        return __('Collages');
    }
    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')->tabs([
                    Tabs\Tab::make(__('Information'))->schema([
                        Forms\Components\Split::make([
                            Section::make("")->schema([
                                TextInput::make("name")->label(__("name")),
                                TextInput::make("slug")->label(__("slug")),
                                Textarea::make("description")->label(__("description")),
                                Checkbox::make("visible")->label(__("visible")),
                            ]),
                            Forms\Components\Split::make([
                                Section::make("")->schema([
                                    FileUpload::make("image")->label(__("image")),
                                ]),
                                Section::make("")->schema([
                                    KeyValue::make("properties")->label(__("properties")),
                                ])
                            ])->from("2xl")
                        ])->from("md")
                    ]),
                    Tabs\Tab::make(__('Content'))->schema([
                        Section::make(__("Write This Content If you want make page for this"))->schema([
                            Builder::make(__('content'))
                                ->blocks([
                                    Builder\Block::make('heading')->label(__('heading'))
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
                                    Builder\Block::make('paragraph')->label(__('paragraph'))
                                        ->schema([
                                            Textarea::make('content')
                                                ->label('Paragraph')
                                                ->required(),
                                        ]),
                                    Builder\Block::make('image')->label(__('image'))
                                        ->schema([
                                            FileUpload::make('url')
                                                ->label('Image')
                                                ->image()
                                                ->required(),
                                            TextInput::make('alt')
                                                ->label('Alt text')
                                                ->required(),
                                        ]),
                                    Builder\Block::make('richfield')->label(__('richfield'))
                                        ->schema([
                                            RichEditor::make('content')
                                                ->required(),
                                        ]),
                                    Builder\Block::make('markdown')->label(__('markdown'))
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
                ImageColumn::make('image')->label(__("image")),
                TextColumn::make('name')->searchable()->label(__("name"))->sortable()
                    ->toggleable(),
                TextColumn::make('departments_count')->label(__("Departments"))->counts('departments')->sortable()
                    ->toggleable(),
                TextColumn::make('description')->searchable()->label(__("description"))->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('visible')->boolean()->label(__("visible"))->sortable()
                    ->toggleable(),
                TextColumn::make("slug")->label(__("slug"))->sortable()
                    ->toggleable(),
                TextColumn::make("created_at")->label(__("created at"))->sortable()->datetime()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make("updated_at")->label(__("updated at"))->sortable()->datetime()
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
            DepartmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCollages::route('/'),
            'create' => Pages\CreateCollage::route('/create'),
            'view' => Pages\ViewCollage::route('/{record}'),
            'edit' => Pages\EditCollage::route('/{record}/edit'),
        ];
    }
}
