<?php

namespace App\Filament\Resources\TableResource\RelationManagers;

use App\Models\ClassRoom;
use App\Models\SubjectLevelDoctor;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LecturesRelationManager extends RelationManager
{
    protected static string $relationship = 'lectures';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('subject_level_doctor_id')
                    ->required()
                    ->relationship('subjectLevelDoctor', 'subject_level_doctor_id')
                    ->getOptionLabelFromRecordUsing(fn (SubjectLevelDoctor $record) => "{$record->subject->name} - {$record->user->name} - {$record->level->name}")->live(),
                Select::make("class_room_id")->reactive()
                    ->options(function (callable $get) {
                        $subjectLevelDoctor = $get('subject_level_doctor_id');
                        if (!$subjectLevelDoctor) {
                            return [];
                        }

                        $level = SubjectLevelDoctor::find($subjectLevelDoctor)->level;
                        $numberOfStudents = $level->count_of_student;
                        return ClassRoom::where('capacity', '>=', $numberOfStudents)
                            ->pluck('name', 'id')
                            ->toArray();
                    })
                    ->getOptionLabelsUsing(function ($value, $key, ?ClassRoom $classroom) {
                        return "{$classroom->name} (سعة: {$classroom->capacity})";
                    }),
                KeyValue::make("properties"),
                TimePicker::make("start"),
                TimePicker::make("end"),
                Select::make("day")
                    ->options([
                        1 =>  "Saterday",
                        2 =>  "Sunday",
                        3 =>  "Monday",
                        4 =>  "Tuesday",
                        5 =>  "Wednesday",
                        6 =>  "Thursday",
                        7 =>  "Friday",
                    ]),
                Checkbox::make("visible"),
                RichEditor::make("content"),

            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subjectLevelDoctor.subject.name')->label('المادة'),
                Tables\Columns\TextColumn::make('subjectLevelDoctor.user.name')->label('الدكتور'),
                Tables\Columns\TextColumn::make('subjectLevelDoctor.level.name')->label('level'),
                Tables\Columns\TextColumn::make('classRoom.name')->label('classroom'),
                Tables\Columns\TextColumn::make('day')->label('Day'),
                Tables\Columns\TextColumn::make('start')->label('start'),
                Tables\Columns\TextColumn::make('end')->label('end'),
                Tables\Columns\IconColumn::make('visible')->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
