<?php

namespace App\Filament\Resources\DynamicQuestionnaires\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\View;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Illuminate\Support\Str;

class DynamicQuestionnaireForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Basic Information')
                    ->schema([
                        TextInput::make('title')
                            ->label('Questionnaire Title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Client Assessment Form')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('slug', Str::slug($state));
                            }),
                        
                        TextInput::make('slug')
                            ->label('URL Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Used in API calls: /api/questionnaire/{slug}')
                            ->prefix('/api/questionnaire/'),
                        
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Show this questionnaire on the website'),
                            
                        TextInput::make('sort_order')
                            ->label('Display Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),
                    ])
                    ->columns(2),
                
                Section::make('Questionnaire Structure')
                    ->description('Build your questionnaire with sections, questions, and options')
                    ->schema([
                        Repeater::make('structure.contactInfo')
                            ->label('Contact Information')
                            ->schema([
                                TextInput::make('address')
                                    ->label('Address')
                                    ->placeholder('123 Wellness Way, Wellness City, 12345'),
                                    
                                TextInput::make('phone')
                                    ->label('Phone')
                                    ->placeholder('+1 (234) 567-890'),
                                    
                                TextInput::make('email')
                                    ->label('Email')
                                    ->placeholder('contact@b9concept.com'),
                                    
                                TextInput::make('hours')
                                    ->label('Business Hours')
                                    ->placeholder('Mon - Fri: 9am - 5pm'),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): string => 'Contact Info')
                            ->defaultItems(1),
                            
                        Repeater::make('structure.formSections')
                            ->label('Form Sections')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Section Title')
                                    ->required()
                                    ->placeholder('e.g., Step 1: Current Situation Assessment'),
                                    
                                Repeater::make('fields')
                                    ->label('Fields in this Section')
                                    ->schema([
                                        TextInput::make('id')
                                            ->label('Field ID')
                                            ->required()
                                            ->placeholder('e.g., problem, duration')
                                            ->helperText('Must be unique across all fields'),
                                            
                                        TextInput::make('label')
                                            ->label('Question/Label')
                                            ->required()
                                            ->placeholder('e.g., What specific problem are you experiencing?'),
                                            
                                        Select::make('type')
                                            ->label('Field Type')
                                            ->required()
                                            ->options([
                                                'text' => 'Text Input',
                                                'textarea' => 'Text Area',
                                                'select' => 'Dropdown Select',
                                                'radio' => 'Radio Buttons',
                                                'checkbox' => 'Checkboxes',
                                                'email' => 'Email',
                                                'tel' => 'Phone',
                                                'number' => 'Number',
                                                'date' => 'Date',
                                                'time' => 'Time',
                                                'datetime' => 'Date & Time',
                                            ])
                                            ->default('select')
                                            ->live(),
                                            
                                        Repeater::make('options')
                                            ->label('Options (for select/radio/checkbox)')
                                            ->schema([
                                                TextInput::make('value')
                                                    ->label('Option Value')
                                                    ->required()
                                                    ->placeholder('e.g., anxiety, stress'),
                                                    
                                                TextInput::make('label')
                                                    ->label('Option Label')
                                                    ->required()
                                                    ->placeholder('e.g., Anxiety, Stress'),
                                                    
                                                Toggle::make('disabled')
                                                    ->label('Disabled')
                                                    ->default(false),
                                            ])
                                            ->columns(3)
                                            ->visible(fn (Get $get): bool => 
                                                in_array($get('type'), ['select', 'radio', 'checkbox'])
                                            ),
                                            
                                        TextInput::make('placeholder')
                                            ->label('Placeholder Text')
                                            ->placeholder('e.g., Please select an option...'),
                                            
                                        Select::make('colSpan')
                                            ->label('Column Span')
                                            ->options([
                                                'md:col-span-1' => '1 Column',
                                                'md:col-span-2' => '2 Columns',
                                                'md:col-span-3' => '3 Columns',
                                                'md:col-span-4' => '4 Columns',
                                                'md:col-span-full' => 'Full Width',
                                            ])
                                            ->default('md:col-span-1'),
                                            
                                        Toggle::make('required')
                                            ->label('Required Field')
                                            ->default(true),
                                            
                                        TextInput::make('validation')
                                            ->label('Custom Validation Rules')
                                            ->placeholder('e.g., max:255,min:3')
                                            ->helperText('Laravel validation rules separated by commas'),
                                    ])
                                    ->columns(2)
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): string => 
                                        ($state['label'] ?? 'Untitled Field') . ' (' . ($state['type'] ?? 'text') . ')'
                                    ),
                            ])
                            ->columns(1)
                            ->collapsible()
                            ->itemLabel(fn (array $state): string => $state['title'] ?? 'Untitled Section')
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->collapsible(),
                
                Section::make('Preview')
                    ->description('Preview your questionnaire structure')
                    ->schema([
                        View::make('filament.components.questionnaire-preview')
                            ->visible(fn (Get $get): bool => !empty($get('structure'))),
                    ])
                    ->collapsed()
                    ->collapsible(),
            ]);
    }
}