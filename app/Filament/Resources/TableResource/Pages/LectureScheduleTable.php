<?php

namespace App\Filament\Resources\TableResource\Pages;

use App\Filament\Resources\TableResource;
use Filament\Resources\Pages\Page;

class LectureScheduleTable extends Page
{
    protected static string $resource = TableResource::class;

    protected static string $view = 'filament.resources.table-resource.pages.lecture-schedule-table';
}
