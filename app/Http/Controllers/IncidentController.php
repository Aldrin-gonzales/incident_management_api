<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IncidentController extends Controller {
public function index(): JsonResponse {
    $incidents = Incident::select([
        'id',
        'description',
        'status',
        'incident_type_id',
        'reported_by',
        'created_at',
        'updated_at',
    ])->get();  

    return response()->json($incidents);
}
public function store(Request $request): JsonResponse {
    $validated = $request->validate([
        'description' => 'required|string',
        'status' => 'required|string|in:reported,investigating,resolved',
        'incident_type_id' => 'required|exists:incident_types,id',
        'reported_by' => 'required|exists:users,id',
    ]);

    $incident = Incident::create($validated);

    return response()->json([
        'message' => 'Incident created successfully.',
        'data' => $incident->only([
            'id',
            'description',
            'status',
            'incident_type_id',
            'reported_by',
            'created_at',
            'updated_at',
        ]),
    ]);
}
public function show(int $id): JsonResponse {
    $incident = Incident::select([
        'id',
        'description',
        'status',
        'incident_type_id',
        'reported_by',
        'created_at',
        'updated_at',
    ])->findOrFail($id);

     return response()->json([
        'message' => 'Incident retrieved successfully.',
        'data' => $incident,
    ]);
}
  public function destroy(int $id): JsonResponse {
    $incident = Incident::findOrFail($id);
    $incident->delete();

    return response()->json([
        'message' => 'Incident deleted successfully.',
    ]);
  }    
  public function update(int $id, Request $request): JsonResponse {
    $validated = $request->validate([
        'description' => 'required|string',
        'status' => 'required|string|in:reported,investigating,resolved',
        'incident_type_id' => 'required|exists:incident_types,id',
        'reported_by' => 'required|exists:users,id',
    ]);

    $incident = Incident::findOrFail($id);
    $incident->update($validated);

    return response()->json([
        'message' => 'Incident updated successfully.',
        'data' => $incident->only([
            'id',
            'description',
            'status',
            'incident_type_id',
            'reported_by',
            'created_at',
            'updated_at',
        ]),
    ]);
  }
}