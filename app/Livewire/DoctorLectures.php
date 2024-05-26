<?php

namespace App\Livewire;

use App\Models\Doctor;
use App\Models\Lecture;
use App\Tables\Columns\LectureColumn;
use Filament\Facades\Filament;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;


class DoctorLectures extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

//    public Collection $lectures;
//    public function mount()
//    {
//        $this->lectures = Lecture::with("subject", "level", "departments", "doctor")->where("doctor_id", Auth::id())->get();
//    }
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

    public function table(Table $table) : Table
    {
        return  $table
            ->query(Lecture::query()->where("doctor_id", Auth::id()))

            ->columns([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\TextColumn::make("subject.name")->size("text-2xl")->weight("font-extrabold")->alignCenter(),
                    Tables\Columns\TextColumn::make("level.name")->size("text-md")->alignCenter(),
                    Tables\Columns\TextColumn::make("doctor.name")->size("text-md")->alignCenter(),
                    Tables\Columns\TagsColumn::make("departments.slug")->color("primary")->alignCenter(),
                    Tables\Columns\Layout\Split::make([
                        Tables\Columns\TagsColumn::make("start")->size("text-md"),
                        Tables\Columns\TagsColumn::make("end")->icon("heroicon-s-arrow-left"),
                    ])->grow(),
                ])->space(3)->alignCenter()
            ])->defaultGroup('day')->contentGrid([
                "md" => 3,
                "lg" => 4
            ])
            ->groups([
                Tables\Grouping\Group::make('day')->label(__("day"))
                    ->getTitleFromRecordUsing(fn (Lecture $record): string => $this->list_days($record->day)),
                Tables\Grouping\Group::make("level.name")->label(__("Level"))
            ])->filters([

            ])
            ->headerActions([

            ])
            ->actions([

            ])
            ->bulkActions([

            ])
            ;
    }
    public function render()
    {
        return view('livewire.doctor-lectures');
    }
}