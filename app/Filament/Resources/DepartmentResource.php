<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
use App\Filament\Resources\DepartmentResource\RelationManagers;
use App\Filament\Resources\DepartmentResource\RelationManagers\DoctorsRelationManager;
use App\Filament\Resources\DepartmentResource\RelationManagers\SubjectsRelationManager;
use App\Models\Department;
use App\Models\Level;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
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
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use function Laravel\Prompts\spin;

class DepartmentResource extends Resource
{
    use Translatable;
    protected static ?string $model = Department::class;
    protected static ?int $navigationSort = 5;
    public static function getModelLabel(): string
    {
        return __("Department");
    }
    public static function getPluralModelLabel(): string
    {
        return __('Departments');
    }
    protected static ?string $title = "name";
    protected static ?string $navigationIcon = 'heroicon-o-server-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')->tabs([
                    Tabs\Tab::make(__('Information'))->schema([
                        Forms\Components\Split::make([
                            Section::make()->schema([
                                Select::make("collage_id")
                                    ->label(__("Collage"))
                                    ->relationship('collage', 'name')
                                ,
//                                Select::make("levels")->relationship("levels",  "name")->multiple(),
                                TextInput::make("name")->label(__("name")),
                                TextInput::make("slug")->label(__("slug")),
                                Checkbox::make("visible")->label(__("visible")),
                                Textarea::make("description")->label(__("description"))->columnSpanFull(),
                                Repeater::make('levels')->label(__("Levels"))
                                    ->relationship('levels')
                                    ->schema([
                                        Select::make('level_id')
                                            ->label(__('Level'))
                                            ->options(function (callable $get) {

                                                $selectedDepartments = collect($get('levels'))
                                                    ->pluck('level_id')
                                                    ->toArray();

                                                $query = Level::query();

                                                if ($selectedDepartments) {
                                                    $query->whereNotIn('id', $selectedDepartments);
                                                }

                                                return $query->pluck('name', 'id');
                                            })
                                            ->required()
                                            ->reactive()
                                            ->live(),
                                        TextInput::make('count_of_student')
                                            ->label(__('Student count'))
                                            ->required()
                                            ->numeric(),
                                    ])->columnSpanFull()->live()->reactive()
                                    ->columns(2),

                            ])->columns(2)->grow(false),
                            Forms\Components\Split::make([
                                Section::make("")->schema([
                                    FileUpload::make("image")->label(__("image")),
                                ]),
                                Section::make("")->schema([
                                    KeyValue::make("properties")->label(__("properties")),
                                ])
                            ])->from("2xl")
                        ])->from("md")
                    ])->columns(1),
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
                TextColumn::make('name')
                    ->searchable()
                    ->label(__("name"))
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('collage.name')
                    ->searchable()
                    ->label(__("Collage"))
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('levels_sum_count_of_student')
                    ->searchable()
                    ->label(__("count of students"))
                    ->sortable()
                    ->sum("levels", "count_of_student")
                    ->toggleable(),
                TextColumn::make('levels_count')
                    ->label(__("Levels Count"))
                    ->counts('levels')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('description')
                    ->searchable()
                    ->label(__("description"))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('visible')
                    ->boolean()
                    ->label(__("visible"))
                    ->sortable()
                    ->toggleable(),
                TextColumn::make("slug")
                    ->label(__("slug"))
                    ->sortable()
                    ->toggleable(),
                TextColumn::make("created_at")
                    ->label(__("created at"))
                    ->sortable()
                    ->datetime()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make("updated_at")
                    ->label(__("updated at"))
                    ->sortable()
                    ->datetime()
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
            //SubjectsRelationManager::class,
            //DoctorsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'view' => Pages\ViewDepartment::route('/{record}'),
            'edit' => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }
}
