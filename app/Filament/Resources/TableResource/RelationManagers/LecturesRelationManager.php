<?php

namespace App\Filament\Resources\TableResource\RelationManagers;

use App\Models\ClassRoom;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Lecture;
use App\Models\Level;

use App\Models\LevelDepartment;
use App\Tables\Columns\DepartmentsColumn;
use App\Tables\Columns\LectureColumn;
use App\Tables\Columns\LectureLevelOne;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LecturesRelationManager extends RelationManager
{
    protected static string $relationship = 'lectures';
    public ?string $tableGroupingDirection = "vertical";

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __("Lectures");
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make(__("Subject , Level and Time"))
                        ->schema([
                            Forms\Components\Section::make()->schema([
                                Select::make('subject_id')
                                    ->required()->label(__("Subject"))
                                    ->relationship('subject', 'name')
                                    ->live(),
                                Select::make('level_id')->label(__("Level"))
                                    ->required()
                                    ->relationship('level', 'name')
                                    ->live(),
                                Forms\Components\Fieldset::make('Time')
                                    ->schema([
                                        TimePicker::make("start")->label(__("Start in"))
                                            ->datalist([
                                                '08:00',
                                                '08:15',
                                                '08:30',
                                                '08:45',
                                                '09:00',
                                                '09:15',
                                                '09:30',
                                                '09:45',
                                                '10:00',
                                                '10:15',
                                                '10:30',
                                                '10:45',
                                                '11:00',
                                                '11:15',
                                                '11:30',
                                                '11:45',
                                                '12:00',
                                                '12:15',
                                                '12:30',
                                                '12:45',
                                                '01:00',
                                                '01:15',
                                                '01:30',
                                                '01:45',
                                                '02:00',
                                                '02:15',
                                                '02:30',
                                                '02:45',
                                                '03:00',
                                                '03:15',
                                                '03:30',
                                                '03:45',
                                                '04:00',
                                                '04:15',
                                                '04:30',
                                                '04:45',
                                                '05:00',
                                            ])->required(),
                                        TimePicker::make("end")->label(__("End in"))->datalist([
                                            '08:00',
                                            '08:15',
                                            '08:30',
                                            '08:45',
                                            '09:00',
                                            '09:15',
                                            '09:30',
                                            '09:45',
                                            '10:00',
                                            '10:15',
                                            '10:30',
                                            '10:45',
                                            '11:00',
                                            '11:15',
                                            '11:30',
                                            '11:45',
                                            '12:00',
                                            '12:15',
                                            '12:30',
                                            '12:45',
                                            '01:00',
                                            '01:15',
                                            '01:30',
                                            '01:45',
                                            '02:00',
                                            '02:15',
                                            '02:30',
                                            '02:45',
                                            '03:00',
                                            '03:15',
                                            '03:30',
                                            '03:45',
                                            '04:00',
                                            '04:15',
                                            '04:30',
                                            '04:45',
                                            '05:00',
                                        ])->required(),
                                        Select::make("day")
                                            ->options(days_availabel())->required(),
                                    ])->columns(3)->columnSpanFull()

                            ])->columns(2)

                        ]),
                    Wizard\Step::make(__("Doctor and Departments"))
                        ->schema([
                            Select::make('doctor_id')->label(__("Doctor"))
                                ->required()
                                ->options(function (callable $get) {
                                    $day = $get('day');
                                    return Doctor::cursor()
                                        ->filter(function (Doctor $doctor) use ($day) {
                                            return in_array($day, $doctor->days_available);
                                        })
                                        ->mapWithKeys(function ($doctor) {
                                            return [$doctor->id => $doctor->name];
                                        })
                                        ->toArray();
                                })
                                ->live(),
                            Forms\Components\CheckboxList::make('departments')->label(__("Departments"))
                                ->relationship(
                                    titleAttribute: 'name',
                                )->options(function (callable $get) {
                                    $levelId = $get('level_id');
                                    return Department::whereHas('levels', function ($query) use ($levelId) {
                                        return $query->where('level_id', $levelId);
                                    })->pluck('name', 'id');
                                })->live()->reactive(),
                            Checkbox::make("type")->label(__("is theoretical"))
                        ]),
                    Wizard\Step::make(__("Classroom"))
                        ->schema([
                            Select::make("class_room_id")->label(__("class room"))
                                ->relationship("classRoom", "name")
                                ->reactive()
                                ->options(function (callable $get) {
                                    $level = $get('level_id');
                                    $departmentsIds = $get("departments");
                                    if (!$level) {
                                        return [];
                                    }
                                    $query = LevelDepartment::query();
                                    $query->where("level_id", $level);
                                    $query->whereIn("department_id", $departmentsIds);
                                    $numberOfStudents = $query->sum("count_of_student");
                                    return ClassRoom::where("capacity", ">=", $numberOfStudents)
                                       ->pluck('name', 'id')
                                       ->toArray();
                                })
                                ->createOptionForm([
                                    Forms\Components\TextInput::make('name')
                                        ->required(),
                                    Forms\Components\TextInput::make('slug')
                                        ->required(),
                                    Forms\Components\TextInput::make('capacity')
                                        ->required()
                                        ->numeric(),
                                ])->createOptionUsing(function (array $data) {
                                    return ClassRoom::create([
                                        "name" => $data["name"],
                                        "capacity" => $data["capacity"]
                                    ]);
                                }),
                        ]),
                    Wizard\Step::make("Last")->schema([
                        KeyValue::make("properties")->label(__("properties")),
                        Checkbox::make("visible")->label(__("visible")),
                        RichEditor::make("content")->label(__("content")),
                    ])
                ]),





            ])->columns(1);
    }
    public function list_days($key) {
        switch ($key) {
            case 1:
                return __("Saturday");
            case 2:
                return __("Sunday");
            case 3:
                return __("Monday");
            case 4:
                return __("Tuesday");
            case 5:
                return __("Wednesday");
            case 6:
                return __("Thursday");
            case 7:
                return __("Friday");
            default:
                return __("Not Found");
        }

    }

    public function table(Table $table): Table
    {

        return $table

            ->columns([
                Tables\Columns\Layout\Grid::make()->schema([
                    LectureColumn::make(""),
                ])->columns(1)
            ])->defaultGroup('day')->contentGrid([
                "md" => 2,
                "lg" => 3
            ])
        ->groups([
            Tables\Grouping\Group::make('day')->label(__("day"))
                ->getTitleFromRecordUsing(fn (Lecture $record): string => $this->list_days($record->day)),
            Tables\Grouping\Group::make('level_id')->label(__("Level"))
                ->getTitleFromRecordUsing(fn (Lecture $record): string => $record->level->name),
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
