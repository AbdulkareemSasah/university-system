<?php

namespace App\Tables\Columns;

use App\Models\Lecture;
use App\Models\Level;
use Filament\Tables\Columns\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LectureColumn extends Column
{
    protected string $view = 'tables.columns.lecture-column';

}
