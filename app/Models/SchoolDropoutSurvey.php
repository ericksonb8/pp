<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolDropoutSurvey extends Model
{
    use HasFactory;

    protected $fillable = [
        // Datos generales
        'name',
        'age',
        'gender',
        'career',
        'semester',
        'working',

        // Factores personales
        'motivation',
        'abandon',
        'reason',
        'emotional_state',
        'support',
        'economic_pillar',
        'far_from_university',

        // Factores académicos
        'academic_performance',
        'has_failed',
        'professor_support',
        'resources_access'
    ];

    protected $casts = [
        'working' => 'boolean',
        'abandon' => 'boolean',
        'support' => 'boolean',
        'economic_pillar' => 'boolean',
        'far_from_university' => 'boolean',
        'has_failed' => 'boolean',
        'professor_support' => 'boolean',
        'resources_access' => 'boolean',
    ];
}
