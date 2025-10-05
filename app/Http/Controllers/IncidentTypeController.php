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

        if ($incidentTypes->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'count' => $incidentTypes->count(),
                'data' => $incidentTypes,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No incident types found.',
            ], 404);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $incidentType = IncidentType::create($validated);

        if ($incidentType) {
            return response()->json([
                'status' => 'success',
                'message' => 'Incident type created successfully.',
                'data' => $incidentType->only([
                    'id',
                    'name',
                    'description',
                    'created_at',
                    'updated_at',
                ]),
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create incident type.',
            ], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        $incidentType = IncidentType::select([
            'id',
            'name',
            'description',
            'created_at',
            'updated_at',
        ])->find($id);

        if ($incidentType) {
            return response()->json([
                'status' => 'success',
                'message' => 'Incident type retrieved successfully.',
                'data' => $incidentType,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Incident type not found.',
            ], 404);
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $incidentType = IncidentType::find($id);

        if ($incidentType) {
            $incidentType->update($validated);
            return response()->json([
                'status' => 'success',
                'message' => 'Incident type updated successfully.',
                'data' => $incidentType->only([
                    'id',
                    'name',
                    'description',
                    'created_at',
                    'updated_at',
            ]),
        ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Incident type not found.',
            ], 404);
        }
    }
    
    public function destroy(int $id): JsonResponse
    {
        $incidentType = IncidentType::find($id);

        if ($incidentType) {
            $incidentType->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Incident type deleted successfully.',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Incident type not found.',
            ], 404);
        }
    }
}