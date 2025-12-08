<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DynamicQuestionnaire;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    // Get all active questionnaires
    public function index()
    {
        $questionnaires = DynamicQuestionnaire::where('is_active', true)
            ->orderBy('sort_order')
            ->get(['id', 'title', 'slug', 'structure']);
            
        return response()->json([
            'success' => true,
            'data' => $questionnaires,
            'message' => 'Questionnaires retrieved successfully.'
        ]);
    }

    // Get specific questionnaire by slug
    public function show($slug)
    {
        $questionnaire = DynamicQuestionnaire::where('slug', $slug)
            ->where('is_active', true)
            ->first();
            
        if (!$questionnaire) {
            return response()->json([
                'success' => false,
                'message' => 'Questionnaire not found or inactive.'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $questionnaire->id,
                'title' => $questionnaire->title,
                'slug' => $questionnaire->slug,
                'structure' => $questionnaire->structure,
                'created_at' => $questionnaire->created_at,
                'updated_at' => $questionnaire->updated_at,
            ],
            'message' => 'Questionnaire retrieved successfully.'
        ]);
    }

    // Submit questionnaire response
    public function store(Request $request, $slug)
    {
        $questionnaire = DynamicQuestionnaire::where('slug', $slug)
            ->where('is_active', true)
            ->first();
            
        if (!$questionnaire) {
            return response()->json([
                'success' => false,
                'message' => 'Questionnaire not found or inactive.'
            ], 404);
        }
        
        // Validate based on questionnaire structure
        $validationRules = $this->buildValidationRules($questionnaire->structure);
        
        $validated = $request->validate($validationRules);
        
        // Store the response (you can save to database, send email, etc.)
        $responseId = $this->processResponse($questionnaire, $validated);
        
        return response()->json([
            'success' => true,
            'data' => [
                'response_id' => $responseId,
                'questionnaire_id' => $questionnaire->id,
                'submitted_data' => $validated,
            ],
            'message' => 'Questionnaire submitted successfully.'
        ], 201);
    }

    // Build validation rules from questionnaire structure
    private function buildValidationRules($structure): array
    {
        $rules = [];
        
        if (!isset($structure['formSections']) || !is_array($structure['formSections'])) {
            return $rules;
        }
        
        foreach ($structure['formSections'] as $section) {
            if (!isset($section['fields']) || !is_array($section['fields'])) {
                continue;
            }
            
            foreach ($section['fields'] as $field) {
                if (!isset($field['id']) || !isset($field['required'])) {
                    continue;
                }
                
                $fieldId = $field['id'];
                $fieldRules = [];
                
                // Required rule
                if ($field['required'] ?? false) {
                    $fieldRules[] = 'required';
                } else {
                    $fieldRules[] = 'nullable';
                }
                
                // Type-specific rules
                switch ($field['type'] ?? 'text') {
                    case 'email':
                        $fieldRules[] = 'email';
                        break;
                    case 'number':
                        $fieldRules[] = 'numeric';
                        break;
                    case 'tel':
                        $fieldRules[] = 'regex:/^[0-9\-\+\s\(\)]{10,15}$/';
                        break;
                    case 'date':
                        $fieldRules[] = 'date';
                        break;
                    case 'datetime':
                        $fieldRules[] = 'date_format:Y-m-d H:i:s';
                        break;
                }
                
                // Custom validation rules
                if (isset($field['validation']) && !empty($field['validation'])) {
                    $customRules = explode(',', $field['validation']);
                    $fieldRules = array_merge($fieldRules, $customRules);
                }
                
                $rules[$fieldId] = implode('|', $fieldRules);
            }
        }
        
        return $rules;
    }

    // Process and store the response
    private function processResponse(DynamicQuestionnaire $questionnaire, array $data)
    {
        // You can save to database here
        // Example:
        // $response = QuestionnaireResponse::create([
        //     'questionnaire_id' => $questionnaire->id,
        //     'response_data' => json_encode($data),
        //     'ip_address' => request()->ip(),
        //     'user_agent' => request()->userAgent(),
        // ]);
        
        // For now, return a unique ID
        return uniqid('resp_', true);
    }
}