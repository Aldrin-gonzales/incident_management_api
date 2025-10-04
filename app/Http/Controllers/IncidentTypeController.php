<?php

namespace App\Http\Controllers;

use App\Models\IncidentType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class IncidentTypeController extends Controller
{
    public function index(): JsonResponse
    {
        $incidentTypes = IncidentType::select([
            'id',
            'name',
            'description',
            'created_at',
            'updated_at',
        ])->get();

        return response()->json($incidentTypes);
    }
}