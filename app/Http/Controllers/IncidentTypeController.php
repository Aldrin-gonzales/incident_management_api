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
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $incidentType = IncidentType::create($validated);

        return response()->json([
            'message' => 'Incident type created successfully.',
            'data' => $incidentType->only([
                'id',
                'name',
                'description',
                'created_at',
                'updated_at',
            ]),
        ]);
    }
    public function show(int $id): JsonResponse
    {
        $incidentType = IncidentType::select([
            'id',
            'name',
            'description',
            'created_at',
            'updated_at',
        ])->findOrFail($id);

        return response()->json($incidentType);
    }
    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $incidentType = IncidentType::findOrFail($id);
        $incidentType->update($validated);

        return response()->json([
            'message' => 'Incident type updated successfully.',
            'data' => $incidentType->only([
                'id',
                'name',
                'description',
                'created_at',
                'updated_at',
            ]),
        ]);
    }
    public function destroy(int $id): JsonResponse
    {
        $incidentType = IncidentType::findOrFail($id);
        $incidentType->delete();

        return response()->json([
            'message' => 'Incident type deleted successfully.',
        ]);
    }
}