<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolDropoutSurvey;

class SurveyController extends Controller {

    function index(Request $request) {
        return view('survey.index');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            // Datos generales
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:10', 'max:99'],
            'gender' => ['required', 'in:male,female,other'],
            'career' => ['required', 'string', 'max:255'],
            'semester' => ['required', 'integer', 'min:1', 'max:8'],
            'working' => ['required', 'boolean'],

            // Factores personales
            'motivation' => ['required', 'string'],
            'abandon' => ['required', 'boolean'],
            'reason' => ['nullable', 'string', 'max:255'],
            'emotional-state' => ['required', 'string'],
            'support' => ['required', 'boolean'],
            'economic-pillar' => ['nullable', 'boolean'],
            'far-from-university' => ['required', 'boolean'],

            // Factores académicos
            'academic-performance' => ['required', 'string'],
            'has-failed' => ['required', 'boolean'],
            'professor-support' => ['required', 'boolean'],
            'resources-access' => ['required', 'boolean'],
        ]);

        // Si todo está bien, guarda
        SchoolDropoutSurvey::create([
            'name' => $validated['name'],
            'age' => $validated['age'],
            'gender' => $validated['gender'],
            'career' => $validated['career'],
            'semester' => $validated['semester'],
            'working' => $request->boolean('working'),

            'motivation' => $validated['motivation'],
            'abandon' => $request->boolean('abandon'),
            'reason' => $validated['reason'] ?? null,
            'emotional_state' => $validated['emotional-state'],
            'support' => $request->boolean('support'),
            'economic_pillar' => $request->boolean('economic-pillar'),
            'far_from_university' => $request->boolean('far-from-university'),

            'academic_performance' => $validated['academic-performance'],
            'has_failed' => $request->boolean('has-failed'),
            'professor_support' => $request->boolean('professor-support'),
            'resources_access' => $request->boolean('resources-access'),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Encuesta guardada correctamente.');
    }
}
