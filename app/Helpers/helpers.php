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
            'subjectLevelDoctor.subject',
            'subjectLevelDoctor.user',
            'subjectLevelDoctor.level',
        ])
        ->get();

    $groupedLectures = [];

    foreach ($lectures as $lecture) {
        $day = $lecture->day;
        $levelId = $lecture->subjectleveldoctor->level_id;
        $subjectLevelDoctor = $lecture->subjectLevelDoctor;

        $lectureData = [
            'subject_name' => $subjectLevelDoctor->subject->name,
            'subject_id' => $subjectLevelDoctor->subject->id,
            'doctor_name' => $subjectLevelDoctor->user->name,
            'doctor_id' => $subjectLevelDoctor->user->id,
            'level_name' => $subjectLevelDoctor->level->name,
            'level_id' => $subjectLevelDoctor->level->id,
            'start' => $lecture->start,
            'end' => $lecture->end,
            'classroom_name' => $lecture->classRoom->name,
            'classroom_id' => $lecture->classRoom->id,
        ];

        if (!isset($groupedLectures[$levelId])) {
            $groupedLectures[$levelId] = [];
        }
        if (!isset($groupedLectures[$levelId][$day])) {
            $groupedLectures[$levelId][$day] = [];
        }

        $groupedLectures[$levelId][$day][] = $lectureData;
    }

    return $groupedLectures;
}
