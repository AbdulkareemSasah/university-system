<?php

function GetTranslation(object $model, string $language): object // Return type is always object
{
    $translatedModel = new stdClass();

    foreach ($model as $key => $value) {
        // 1. Check if the value is already a JSON object
        if (is_object($value)) {
            // Directly access language property, handle missing language
            $translatedModel->$key = isset($value->$language) ? $value->$language : $value;
        } else {
            // 2. Decode JSON string if necessary
            $nValue = json_decode($value);

            if ($nValue !== null) { // Ensure successful decoding
                // Access language property, handle missing language
                $translatedModel->$key = isset($nValue->$language) ? $nValue->$language : $value;
            } else {
                // 3. Handle decoding errors (optional)
                // You might want to log or handle unexpected JSON errors here
                $translatedModel->$key = $value; // Return original value on decode error
            }
        }
    }

    return $translatedModel;
}

function GetTranslationArray(array $model, string $language): object
{
    $translatedModel = new stdClass();

    foreach ($model as $key => $value) {
        if (is_array($value)) {
            // If the value is an array, access the language property
            $translatedModel->$key = $value[$language] ?? "";
        } else if (is_object($value)) {
            // Access the language property if it exists, otherwise use null
            $translatedModel->$key = isset($value->$language) ? $value->$language : "";
        } else {
            // Decode JSON string if necessary
            $decodedValue = json_decode($value);

            if (json_last_error() === JSON_ERROR_NONE) {
                // Access the language property if it exists, otherwise use null
                $translatedModel->$key = isset($decodedValue->$language) ? $decodedValue->$language : $value;
            } else {
                // Handle decoding errors
                $translatedModel->$key = ""; // Return null on decode error
            }
        }
    }

    return $translatedModel;
}


use App\Models\General;
use App\Models\Lecture;
use App\Models\ClassRoom;
use App\Models\SubjectLevelDoctor;
use App\Models\Subject;
use App\Models\Doctor;
use App\Models\Level;

function getLecturesGroupedByDay($tableId)
{
    $lectures = Lecture::where('table_id', $tableId)
        ->with([
            'classRoom',
            'subject',
            'doctor',
            'level',
            'departments',
        ])
        ->get();

    $groupedLectures = [];
    $allDays = ['1', '2', '3', '4', '5', "6"];
    foreach ($allDays as $day) {
        if (!isset($groupedLectures[$day])) {
            $groupedLectures[$day] = [];
        }

        $allLevels = Level::all();
        foreach ($allLevels as $level) {
            if (!isset($groupedLectures[$day][$level->id])) {
                $groupedLectures[$day][$level->id] = [];
            }
        }
    }
    foreach ($lectures as $lecture) {
        $day = $lecture->day;
        $level = $lecture->level;
        $doctor = $lecture->doctor;
        $subject = $lecture->subject;
        $classroom = $lecture->classRoom;
        $departments = $lecture->departments;

        $lectureData = [
            'subject_name' => $subject->name,
            'subject_id' => $subject->id,
            'doctor_name' => $doctor->name,
            'doctor_id' => $doctor->id,
            'start' => $lecture->start,
            'end' => $lecture->end,
            "departments" => $departments->pluck("name", "slug")->toArray(),
            'classroom_name' => $classroom->name,
            'classroom_id' => $classroom->id,
        ];

        if (!isset($groupedLectures[$day])) {
            $groupedLectures[$day] = [];
        }
        if (!isset($groupedLectures[$day][$level->id])) {
            $groupedLectures[$day][$level->id] = [];
        }

        $groupedLectures[$day][$level->id][] = $lectureData;
    }

    return $groupedLectures;
}
function getLecturesGroupedByTimeDay($tableId)
{
    $lectures = Lecture::where('table_id', $tableId)
        ->with([
            'classRoom',
            'subject',
            'doctor',
            'level',
            'departments',
        ])
        ->get();

    $groupedLectures = [];


    foreach ($lectures as $lecture) {
        $day = $lecture->day;
        $level = $lecture->level;
        $doctor = $lecture->doctor;
        $subject = $lecture->subject;
        $classroom = $lecture->classRoom;
        $departments = $lecture->departments;
        $start = $lecture->start;

        $end =  $lecture->end;
        $lectureData = [
            'subject_name' => $subject->name,
            'subject_id' => $subject->id,
            'doctor_name' => $doctor->name,
            'doctor_id' => $doctor->id,
            'start' => $lecture->start,
            'end' => $lecture->end,
            "departments" => $departments->pluck("name", "slug")->toArray(),
            'classroom_name' => $classroom->name,
            'classroom_id' => $classroom->id,
        ];
        $time = substr($start,0,5).' - '.substr($end,0,5);
        if (!isset($groupedLectures[$day])) {
            $groupedLectures[$day] = [];
        }
        if (!isset($groupedLectures[$day][$time])) {
            $groupedLectures[$day][$time] = [];
        }
        if (!isset($groupedLectures[$day][$time][$level->id])) {
            $groupedLectures[$day][$time][$level->id] = [];
        }


        $groupedLectures[$day][$time][$level->id][] = $lectureData;
    }

    foreach (days_availabel() as $day => $value) {
        if (!isset($groupedLectures[$day])) {
            $groupedLectures[$day] = [];
            if((count($groupedLectures[$day]) == 0)) {
                $groupedLectures[$day]['-'] = [];
            }
            ksort($groupedLectures[$day]);
        }
        $allLevels = Level::all();
        foreach ($groupedLectures[$day] as $time => $levels) {
            foreach ($allLevels as $level) {
                if (!isset($groupedLectures[$day][$time][$level->id])) {
                    $groupedLectures[$day][$time][$level->id] = [];
                }
                ksort($groupedLectures[$day][$time][$level->id]);
            }
            ksort($groupedLectures[$day][$time]);
        }

    }
    ksort($groupedLectures);

    return $groupedLectures;
}
function isRouteActive($route, $data = null)
{
    $routeName = is_array($route) ? $route[0] : $route;
    $routeData = is_array($route) ? array_slice($route, 1) : [];

    return request()->routeIs($routeName, ...$routeData);
}
function list_days($key) {
    switch ($key) {
        case "1":
            return __("Saturday");
        case "2":
            return __("Sunday");
        case "3":
            return __("Monday");
        case "4":
            return __("Tuesday");
        case "5":
            return __("Wednesday");
        case "6":
            return __("Thursday");
        case "7":
            return __("Friday");
        default:
            return __("Not Found");
    }
}
function days_availabel()
{
    $days  =  General::query()->first()->get("schooling_days")->toArray()[0]["schooling_days"];
    $days_translation=  [];
    foreach ($days as  $day)  {
        $days_translation[$day] = list_days($day);
    }

    return $days_translation;
}
