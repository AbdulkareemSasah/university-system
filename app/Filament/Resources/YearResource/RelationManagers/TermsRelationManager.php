<?php

namespace App\Filament\Resources\YearResource\RelationManagers;

use App\Filament\Resources\TermResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\Concerns\Translatable;

class TermsRelationManager extends RelationManager
{
    use Translatable;
    protected static string $relationship = 'terms';

    public function form(Form $form): Form
    {
        return TermResource::form($form);
    }

    public function table(Table $table): Table
    {
        return TermResource::table($table);
    }
}
