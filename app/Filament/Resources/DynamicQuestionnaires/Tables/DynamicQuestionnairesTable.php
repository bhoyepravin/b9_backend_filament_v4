<?php

namespace App\Filament\Resources\DynamicQuestionnaires\Tables;

use App\Models\DynamicQuestionnaire;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

// In Filament v4.0, actions are in the Filament\Actions namespace
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

class DynamicQuestionnairesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->description(fn (DynamicQuestionnaire $record): string => 
                        'Slug: ' . $record->slug
                    ),
                
                TextColumn::make('structure.formSections')
                    ->label('Sections')
                    ->formatStateUsing(fn ($state): string => 
                        is_array($state) ? count($state) . ' sections' : '0 sections'
                    )
                    ->badge()
                    ->color(fn ($state): string => 
                        is_array($state) && count($state) > 0 ? 'success' : 'gray'
                    ),
                
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->trueColor('success')
                    ->falseIcon('heroicon-o-x-circle')
                    ->falseColor('danger'),
                
                TextColumn::make('sort_order')
                    ->label('Order')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),
                
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->defaultSort('sort_order')
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active'),
                
                Filter::make('has_sections')
                    ->label('Has Sections')
                    ->query(fn (Builder $query): Builder => 
                        $query->whereRaw("JSON_LENGTH(structure->'$.formSections') > 0")
                    ),
            ])
            ->actions([
                EditAction::make()
                    ->icon('heroicon-o-pencil')
                    ->color('primary'),
                    
                Action::make('preview')
                    ->label('Preview')
                    ->icon('heroicon-o-eye')
                    ->color('success')
                    ->url(fn (DynamicQuestionnaire $record): string => 
                        '/api/questionnaire/' . $record->slug
                            )
                ->openUrlInNewTab(),
                    
                Action::make('duplicate')
                    ->label('Duplicate')
                    ->icon('heroicon-o-document-duplicate')
                    ->color('warning')
                    ->action(function (DynamicQuestionnaire $record) {
                        $newRecord = $record->replicate();
                        $newRecord->title = $record->title . ' (Copy)';
                        $newRecord->slug = $record->slug . '-copy-' . time();
                        $newRecord->save();
                    }),
                    
                DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->color('danger'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    
                    BulkAction::make('activate')
                        ->label('Activate Selected')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['is_active' => true])),
                        
                    BulkAction::make('deactivate')
                        ->label('Deactivate Selected')
                        ->icon('heroicon-o-x-mark')
                        ->color('danger')
                        ->action(fn ($records) => $records->each->update(['is_active' => false])),
                ]),
            ])
            ->emptyStateActions([
                \Filament\Actions\CreateAction::make()
                    ->icon('heroicon-o-plus')
                    ->label('Create First Questionnaire'),
            ])
            ->emptyStateDescription('No questionnaires found. Create your first one!')
            ->emptyStateIcon('heroicon-o-clipboard-document')
            ->deferLoading();
    }
}