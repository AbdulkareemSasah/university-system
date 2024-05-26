<?php

namespace App\Filament\Resources\TableResource\Pages;

use App\Filament\Resources\TableResource;
use App\Models\Department;
use App\Models\Lecture;
use App\Models\Level;
use Filament\Resources\Pages\Page;

class LectureScheduleTable extends Page
{
    protected static string $resource = TableResource::class;

    protected static string $view = 'filament.resources.table-resource.pages.lecture-schedule-table';
    public $data = [];

    public function mount(): void
    {
        $this->getData();
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
    protected function getData(): array
    {
        $levels = Level::all();

        $data = [];
        foreach (["1","2", "3","4","5","6"]  as $day){
            foreach ($levels as $level){
                $data[$day][$level->id]["level"] = $level;
                $data[$day][$level->id]["lectures"][] = [];
            }
        }
        $groupedLecturesPerDay = Lecture::with('subject', 'level', 'classRoom', 'departments', 'doctor')->get()->groupBy(function ($lecture) {
            return [$lecture->day];
        });


        foreach ($groupedLecturesPerDay as $key => $lectures) {
            foreach ($lectures as $lecture) {
                $data[$lecture->day][$lecture->level_id]["level"] = $lecture->level;
                $data[$lecture->day][$lecture->level_id]["lectures"][] = $lecture;
            }

        }
        $this->data = $data;
        return $data;
    }
}
