<?php

namespace App\Livewire;

use App\Models\Lecture;
use App\Tables\Columns\LectureColumn;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Livewire\Component;


class LectureTable extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;
    use Translatable;

    public \App\Models\Table $my_table;
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
            ->query(Lecture::query())
            ->columns([
                Tables\Columns\Layout\Grid::make()->schema([
                    Tables\Columns\TextColumn::make("subject.name"),
                    Tables\Columns\TextColumn::make("doctor.name"),
                    Tables\Columns\TextColumn::make("departments"),
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
    public function render()
    {
        return view('livewire.lecture-table');
    }
}
