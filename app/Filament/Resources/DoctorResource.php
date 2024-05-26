<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorResource\Pages;
use App\Filament\Resources\DoctorResource\RelationManagers;
use App\Models\Doctor;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;
    protected static ?int $navigationSort = 10;
    public static function getModelLabel(): string
    {
        return __("Doctor");
    }
    public static function getPluralModelLabel(): string
    {
        return __('Doctors');
    }
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Split::make([
                    Forms\Components\Section::make()->schema([
                        Forms\Components\TextInput::make('name')->label(__("Name"))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')->label(__("Email"))
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DateTimePicker::make('email_verified_at')->label(__("Email verified at")),
                        Forms\Components\TextInput::make('password')->label(__("Password"))
                            ->password()
                            ->required()
                            ->maxLength(255),

                    ]),
                    Forms\Components\Split::make([
                        Forms\Components\Section::make()->schema([
                            Forms\Components\Select::make("degree")
                                ->label(__("Degree"))
                                ->options([
                                    "Doctor" => "Doctor",
                                    "Master" => "Master",
                                    "Bacaloria" => "Bacaloria"
                                ]),
                            Forms\Components\CheckboxList::make('days_available')
                                ->label(__('Days Available'))
                                ->options(days_availabel()
                               )
                                ->columns(4),
                        ]),
                        Forms\Components\Section::make([
                            Forms\Components\FileUpload::make("avatar")->image()->label(__("Avatar")),
                        ])
                    ])->from("2xl"),
                ])->from("md")



            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(__("Name"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')->label(__("Email"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')->label(__("Email verified at"))
                    ->dateTime()
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'view' => Pages\ViewDoctor::route('/{record}'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
        ];
    }
}
