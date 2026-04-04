<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CareerRequest;
use App\Http\Resources\CareerResource;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Get user's career info.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $career = $user->career;

        return response()->json([
            'success' => true,
            'data' => $career ? new CareerResource($career) : null,
        ]);
    }

    /**
     * Update career info.
     */
    public function update(CareerRequest $request)
    {
        $user = $request->user();
        $career = $user->career()->firstOrCreate(['user_id' => $user->id]);

        $data = $request->validated();
        $career->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Career information updated',
            'data' => new CareerResource($career),
        ]);
    }
}
