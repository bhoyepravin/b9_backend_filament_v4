<?php

namespace App\Filament\Resources\DynamicQuestionnaires;

use App\Filament\Resources\DynamicQuestionnaires\Pages\CreateDynamicQuestionnaire;
use App\Filament\Resources\DynamicQuestionnaires\Pages\EditDynamicQuestionnaire;
use App\Filament\Resources\DynamicQuestionnaires\Pages\ListDynamicQuestionnaires;
use App\Filament\Resources\DynamicQuestionnaires\Schemas\DynamicQuestionnaireForm;
use App\Filament\Resources\DynamicQuestionnaires\Tables\DynamicQuestionnairesTable;
use App\Models\DynamicQuestionnaire;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DynamicQuestionnaireResource extends Resource
{
    protected static ?string $model = DynamicQuestionnaire::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return DynamicQuestionnaireForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DynamicQuestionnairesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDynamicQuestionnaires::route('/'),
            'create' => CreateDynamicQuestionnaire::route('/create'),
            'edit' => EditDynamicQuestionnaire::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
