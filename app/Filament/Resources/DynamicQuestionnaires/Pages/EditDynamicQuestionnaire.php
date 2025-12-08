<?php

namespace App\Filament\Resources\DynamicQuestionnaires\Pages;

use App\Filament\Resources\DynamicQuestionnaires\DynamicQuestionnaireResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditDynamicQuestionnaire extends EditRecord
{
    protected static string $resource = DynamicQuestionnaireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
