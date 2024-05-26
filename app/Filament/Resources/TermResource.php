<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TermResource\Pages;
use App\Filament\Resources\TermResource\RelationManagers;
use App\Models\Term;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
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
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TermResource extends Resource
{
    use Translatable;
    protected static ?string $model = Term::class;
    protected static ?int $navigationSort = 3;
    public static function getModelLabel(): string
    {
        return __("Term");
    }
    public static function getPluralModelLabel(): string
    {
        return __('Terms');
    }
    protected static ?string $navigationIcon = 'heroicon-o-view-columns';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')->tabs([
                    Tabs\Tab::make(__('Information'))->schema([
                        Section::make()->schema([
                            Select::make("year_id")->label(__("Year"))->relationship('year', 'name'),
                            TextInput::make("name")->label(__("name")),
                            TextInput::make("slug")->label(__("slug")),
                            Textarea::make("description")->label(__("description")),
                            Checkbox::make("visible")->label(__("visible")),

                        ]),
                        Section::make("")->schema([
                            KeyValue::make("properties")->label(__("properties")),
                            FileUpload::make("image")->label(__("image")),
                        ])
                    ])->columns(2),
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
                TextColumn::make('year.name')->searchable()->label(__("year"))->sortable()
                    ->toggleable(),

                TextColumn::make('tables_count')->label(__("tables_count"))->counts('tables')->sortable()
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
            ->filters([])
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
            'index' => Pages\ListTerms::route('/'),
            'create' => Pages\CreateTerm::route('/create'),
            'view' => Pages\ViewTerm::route('/{record}'),
            'edit' => Pages\EditTerm::route('/{record}/edit'),
        ];
    }
}
