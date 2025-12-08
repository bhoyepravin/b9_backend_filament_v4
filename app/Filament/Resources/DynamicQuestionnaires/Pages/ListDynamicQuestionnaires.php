<?php

namespace App\Filament\Resources\DynamicQuestionnaires\Pages;

use App\Filament\Resources\DynamicQuestionnaires\DynamicQuestionnaireResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDynamicQuestionnaires extends ListRecords
{
    protected static string $resource = DynamicQuestionnaireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
