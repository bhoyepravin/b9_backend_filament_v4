<?php

namespace App\Filament\Resources\DynamicQuestionnaires\Pages;

use App\Filament\Resources\DynamicQuestionnaires\DynamicQuestionnaireResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDynamicQuestionnaire extends CreateRecord
{
    protected static string $resource = DynamicQuestionnaireResource::class;
}
