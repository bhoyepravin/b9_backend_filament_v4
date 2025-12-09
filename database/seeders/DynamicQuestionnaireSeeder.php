<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DynamicQuestionnaire;
use Illuminate\Support\Str;

class DynamicQuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questionnaires = [
            [
                'title' => 'Client Assessment Form',
                'slug' => 'client-assessment-form',
                'is_active' => true,
                'sort_order' => 1,
                'structure' => [
                    'contactInfo' => [
                        [
                            'address' => '123 Wellness Way, Wellness City, 12345',
                            'phone' => '+1 (234) 567-890',
                            'email' => 'contact@b9concept.com',
                            'hours' => 'Mon - Fri: 9am - 5pm'
                        ]
                    ],
                    'formSections' => [
                        [
                            'title' => 'Your Details',
                            'fields' => [
                                [
                                    'id' => 'form-name',
                                    'label' => 'Name',
                                    'type' => 'text',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => 'Enter your full name'
                                ],
                                [
                                    'id' => 'form-email',
                                    'label' => 'Email',
                                    'type' => 'email',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => 'Enter your email address'
                                ],
                                [
                                    'id' => 'form-phone',
                                    'label' => 'Phone',
                                    'type' => 'tel',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => 'Enter your phone number'
                                ],
                                [
                                    'id' => 'form-address',
                                    'label' => 'Address',
                                    'type' => 'text',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => false,
                                    'placeholder' => 'Enter your address'
                                ],
                                [
                                    'id' => 'form-message',
                                    'label' => 'Your Message (Optional)',
                                    'type' => 'textarea',
                                    'colSpan' => 'md:col-span-2',
                                    'required' => false,
                                    'placeholder' => 'Any additional message...'
                                ]
                            ]
                        ],
                        [
                            'title' => 'Step 1: Current Situation Assessment',
                            'fields' => [
                                [
                                    'id' => 'problem',
                                    'label' => 'What specific problem are you experiencing?',
                                    'type' => 'select',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => 'Please select an option...',
                                    'options' => [
                                        ['value' => 'anxiety', 'label' => 'Anxiety'],
                                        ['value' => 'stress', 'label' => 'Stress'],
                                        ['value' => 'lack_of_confidence', 'label' => 'Lack of Confidence'],
                                        ['value' => 'relationship_issues', 'label' => 'Relationship Issues'],
                                        ['value' => 'career_challenges', 'label' => 'Career Challenges'],
                                        ['value' => 'health_issues', 'label' => 'Health Issues'],
                                        ['value' => 'financial_concerns', 'label' => 'Financial Concerns'],
                                        ['value' => 'burnout', 'label' => 'Burnout'],
                                        ['value' => 'lack_of_motivation', 'label' => 'Lack of Motivation'],
                                        ['value' => 'other', 'label' => 'Other']
                                    ]
                                ],
                                [
                                    'id' => 'duration',
                                    'label' => 'How long has this been persisting?',
                                    'type' => 'select',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => 'Please select an option...',
                                    'options' => [
                                        ['value' => 'less_than_1_month', 'label' => 'Less than 1 Month'],
                                        ['value' => '1_3_months', 'label' => '1-3 Months'],
                                        ['value' => '3_6_months', 'label' => '3-6 Months'],
                                        ['value' => '6_12_months', 'label' => '6-12 Months'],
                                        ['value' => 'more_than_1_year', 'label' => 'More than 1 Year'],
                                        ['value' => 'other', 'label' => 'Other']
                                    ]
                                ],
                                [
                                    'id' => 'triggers-assessment',
                                    'label' => 'Specific triggers that started/worsened this?',
                                    'type' => 'select',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => 'Please select an option...',
                                    'options' => [
                                        ['value' => 'work_deadlines', 'label' => 'Work Deadlines'],
                                        ['value' => 'personal_loss', 'label' => 'Personal Loss'],
                                        ['value' => 'conflict', 'label' => 'Conflict'],
                                        ['value' => 'health_issues', 'label' => 'Health Issues'],
                                        ['value' => 'financial_crisis', 'label' => 'Financial Crisis'],
                                        ['value' => 'pandemic_related_stress', 'label' => 'Pandemic-Related Stress'],
                                        ['value' => 'other', 'label' => 'Other']
                                    ]
                                ],
                                [
                                    'id' => 'medications',
                                    'label' => 'Current medications for this issue?',
                                    'type' => 'select',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => 'Please select an option...',
                                    'options' => [
                                        ['value' => 'no_medications', 'label' => 'No Medications'],
                                        ['value' => 'antidepressants', 'label' => 'Antidepressants'],
                                        ['value' => 'anti_anxiety_medications', 'label' => 'Anti-Anxiety Medications'],
                                        ['value' => 'sleep_aids', 'label' => 'Sleep Aids'],
                                        ['value' => 'herbal_remedies', 'label' => 'Herbal Remedies'],
                                        ['value' => 'other', 'label' => 'Other']
                                    ]
                                ]
                            ]
                        ],
                        [
                            'title' => 'Step 2: Emotional Patterns & Triggers',
                            'fields' => [
                                [
                                    'id' => 'distress-intensifiers',
                                    'label' => 'What intensifies your distress?',
                                    'type' => 'select',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => 'Please select an option...',
                                    'options' => [
                                        ['value' => 'deadlines', 'label' => 'Deadlines'],
                                        ['value' => 'crowded_places', 'label' => 'Crowded Places'],
                                        ['value' => 'family_expectations', 'label' => 'Family Expectations'],
                                        ['value' => 'financial_pressure', 'label' => 'Financial Pressure'],
                                        ['value' => 'negative_thoughts', 'label' => 'Negative Thoughts'],
                                        ['value' => 'public_speaking', 'label' => 'Public Speaking'],
                                        ['value' => 'social_interactions', 'label' => 'Social Interactions'],
                                        ['value' => 'other', 'label' => 'Other']
                                    ]
                                ],
                                [
                                    'id' => 'physical-sensations',
                                    'label' => 'Physical sensations when distressed?',
                                    'type' => 'select',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => 'Please select an option...',
                                    'options' => [
                                        ['value' => 'tightness_in_chest', 'label' => 'Tightness in Chest'],
                                        ['value' => 'sweating', 'label' => 'Sweating'],
                                        ['value' => 'racing_thoughts', 'label' => 'Racing Thoughts'],
                                        ['value' => 'nausea', 'label' => 'Nausea'],
                                        ['value' => 'restlessness', 'label' => 'Restlessness'],
                                        ['value' => 'headaches', 'label' => 'Headaches'],
                                        ['value' => 'shaking', 'label' => 'Shaking'],
                                        ['value' => 'other', 'label' => 'Other']
                                    ]
                                ],
                                [
                                    'id' => 'negative-thoughts',
                                    'label' => 'Recurring negative thoughts?',
                                    'type' => 'select',
                                    'colSpan' => 'md:col-span-2',
                                    'required' => true,
                                    'placeholder' => 'Please select an option...',
                                    'options' => [
                                        ['value' => 'i_cant_do_it', 'label' => '"I can\'t do it"'],
                                        ['value' => 'im_not_good_enough', 'label' => '"I\'m not good enough"'],
                                        ['value' => 'things_will_never_improve', 'label' => '"Things will never improve"'],
                                        ['value' => 'i_will_always_fail', 'label' => '"I\'ll always fail"'],
                                        ['value' => 'im_a_burden', 'label' => '"I\'m a burden"'],
                                        ['value' => 'i_will_be_judged', 'label' => '"I\'ll be judged"']
                                    ]
                                ]
                            ]
                        ],
                        [
                            'title' => 'Step 3: Define Your Desired Outcome',
                            'fields' => [
                                [
                                    'id' => 'resolution',
                                    'label' => 'What\'s your ideal resolution?',
                                    'type' => 'select',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => 'Please select an option...',
                                    'options' => [
                                        ['value' => 'feeling_calm', 'label' => 'Feeling Calm'],
                                        ['value' => 'improved_confidence', 'label' => 'Improved Confidence'],
                                        ['value' => 'better_relationships', 'label' => 'Better Relationships'],
                                        ['value' => 'career_growth', 'label' => 'Career Growth'],
                                        ['value' => 'improved_health', 'label' => 'Improved Health'],
                                        ['value' => 'financial_stability', 'label' => 'Financial Stability'],
                                        ['value' => 'other', 'label' => 'Other']
                                    ]
                                ],
                                [
                                    'id' => 'timeline',
                                    'label' => 'Timeline for seeing progress?',
                                    'type' => 'select',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => 'Please select an option...',
                                    'options' => [
                                        ['value' => '1_week', 'label' => '1 Week'],
                                        ['value' => '1_month', 'label' => '1 Month'],
                                        ['value' => '3_months', 'label' => '3 Months'],
                                        ['value' => '6_months', 'label' => '6 Months'],
                                        ['value' => 'more_than_6_months', 'label' => 'More than 6 Months'],
                                        ['value' => 'other', 'label' => 'Other']
                                    ]
                                ],
                                [
                                    'id' => 'confidence',
                                    'label' => 'Confidence in resolving this issue?',
                                    'type' => 'select',
                                    'colSpan' => 'md:col-span-2',
                                    'required' => true,
                                    'placeholder' => 'Please select an option...',
                                    'options' => [
                                        ['value' => 'very_confident', 'label' => 'Very Confident'],
                                        ['value' => 'somewhat_confident', 'label' => 'Somewhat Confident'],
                                        ['value' => 'neutral', 'label' => 'Neutral'],
                                        ['value' => 'not_very_confident', 'label' => 'Not Very Confident'],
                                        ['value' => 'not_confident_at_all', 'label' => 'Not Confident at All']
                                    ]
                                ]
                            ]
                        ],
                        [
                            'title' => 'Step 4: Deeper Insights',
                            'fields' => [
                                [
                                    'id' => 'happy-memories',
                                    'label' => 'In happy memories, what do you notice first?',
                                    'type' => 'select',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => 'Please select an option...',
                                    'options' => [
                                        ['value' => 'visual', 'label' => 'Visual (Images)'],
                                        ['value' => 'auditory', 'label' => 'Auditory (Sounds)'],
                                        ['value' => 'kinesthetic', 'label' => 'Kinesthetic (Feelings)'],
                                        ['value' => 'smell', 'label' => 'Smell'],
                                        ['value' => 'taste', 'label' => 'Taste']
                                    ]
                                ],
                                [
                                    'id' => 'relaxation-aids',
                                    'label' => 'What helps you feel relaxed?',
                                    'type' => 'select',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => 'Please select an option...',
                                    'options' => [
                                        ['value' => 'calm_music', 'label' => 'Calm Music'],
                                        ['value' => 'nature_sounds', 'label' => 'Nature Sounds'],
                                        ['value' => 'lavender_scents', 'label' => 'Lavender Scents'],
                                        ['value' => 'candlelight', 'label' => 'Candlelight'],
                                        ['value' => 'warm_baths', 'label' => 'Warm Baths'],
                                        ['value' => 'other', 'label' => 'Other']
                                    ]
                                ],
                                [
                                    'id' => 'support-system',
                                    'label' => 'Who supports you most?',
                                    'type' => 'select',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => 'Please select an option...',
                                    'options' => [
                                        ['value' => 'family', 'label' => 'Family'],
                                        ['value' => 'friends', 'label' => 'Friends'],
                                        ['value' => 'therapist', 'label' => 'Therapist'],
                                        ['value' => 'mentor', 'label' => 'Mentor'],
                                        ['value' => 'colleague', 'label' => 'Colleague'],
                                        ['value' => 'none', 'label' => 'None'],
                                        ['value' => 'other', 'label' => 'Other']
                                    ]
                                ],
                                [
                                    'id' => 'recharge-activities',
                                    'label' => 'Activities that help you recharge?',
                                    'type' => 'select',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => 'Please select an option...',
                                    'options' => [
                                        ['value' => 'exercise', 'label' => 'Exercise'],
                                        ['value' => 'meditation', 'label' => 'Meditation'],
                                        ['value' => 'reading', 'label' => 'Reading'],
                                        ['value' => 'journaling', 'label' => 'Journaling'],
                                        ['value' => 'time_outdoors', 'label' => 'Time Outdoors'],
                                        ['value' => 'creative_hobbies', 'label' => 'Creative Hobbies'],
                                        ['value' => 'other', 'label' => 'Other']
                                    ]
                                ]
                            ]
                        ],
                        [
                            'title' => 'Step 5: Choose Your Transformation Package',
                            'fields' => [
                                [
                                    'id' => 'package',
                                    'label' => 'Select Your Transformation Package',
                                    'type' => 'select',
                                    'colSpan' => 'md:col-span-full',
                                    'required' => true,
                                    'placeholder' => 'Please select a package...',
                                    'options' => [
                                        [
                                            'value' => '1530',
                                            'label' => 'Cognitive Transformation - For a specific, targeted issue. ($1,530)'
                                        ],
                                        [
                                            'value' => '6120',
                                            'label' => 'Complete Transformation - For comprehensive, life-changing results. ($6,120)'
                                        ],
                                        [
                                            'value' => '12240',
                                            'label' => 'Executive Package - A premium, all-inclusive package for leaders. ($12,240)'
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        [
                            'title' => 'Step 6: B9Concept Location',
                            'fields' => [
                                [
                                    'id' => 'location',
                                    'label' => 'Select Your Preferred Location',
                                    'type' => 'select',
                                    'colSpan' => 'md:col-span-full',
                                    'required' => true,
                                    'placeholder' => 'Please select a location...',
                                    'options' => [
                                        [
                                            'value' => '',
                                            'label' => 'Please select a location...',
                                            'disabled' => true
                                        ],
                                        ['value' => 'usa-chicago', 'label' => 'USA (Chicago)'],
                                        ['value' => 'usa-los-angeles', 'label' => 'USA (Los Angeles)'],
                                        ['value' => 'usa-new-jersey', 'label' => 'USA (New Jersey)'],
                                        ['value' => 'usa-dallas', 'label' => 'USA (Dallas)'],
                                        ['value' => 'uk-london', 'label' => 'United Kingdom (London)'],
                                        ['value' => 'ca-vancouver', 'label' => 'Canada (Vancouver)'],
                                        ['value' => 'in-nashik', 'label' => 'India (Nashik)'],
                                        ['value' => 'in-noida', 'label' => 'India (Noida)'],
                                        ['value' => 'uae-dubai', 'label' => 'UAE (Dubai)'],
                                        ['value' => 'sg-singapore', 'label' => 'Singapore (Singapore)'],
                                        ['value' => 'au-milburn', 'label' => 'Australia (Milburn)']
                                    ]
                                ]
                            ]
                        ],
                        [
                            'title' => 'Step 8: Secure Your Transformation',
                            'fields' => [
                                [
                                    'id' => 'card-name',
                                    'label' => 'Name on Card',
                                    'type' => 'text',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => 'John M. Doe'
                                ],
                                [
                                    'id' => 'card-number',
                                    'label' => 'Card Number',
                                    'type' => 'text',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => '1234 5678 9123 0000'
                                ],
                                [
                                    'id' => 'card-expiry',
                                    'label' => 'Expiration (MM/YY)',
                                    'type' => 'text',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => 'MM/YY'
                                ],
                                [
                                    'id' => 'card-cvc',
                                    'label' => 'CVC',
                                    'type' => 'text',
                                    'colSpan' => 'md:col-span-1',
                                    'required' => true,
                                    'placeholder' => '123'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        foreach ($questionnaires as $questionnaireData) {
            // Check if questionnaire already exists
            $existing = DynamicQuestionnaire::where('slug', $questionnaireData['slug'])->first();
            
            if (!$existing) {
                DynamicQuestionnaire::create($questionnaireData);
                $this->command->info("Created questionnaire: {$questionnaireData['title']}");
            } else {
                $this->command->info("Questionnaire already exists: {$questionnaireData['title']}");
            }
        }
    }
}