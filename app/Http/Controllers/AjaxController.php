<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Upazila;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /**
     * Get upazilas by district ID.
     */
    public function getUpazilas($district)
    {
        $upazilas = Upazila::where('district_id', $district)->get();

        return response()->json($upazilas);
    }

    /**
     * Get batches by training center ID.
     */
    public function getBatches($training_center)
    {
        $batches = Batch::where('training_center_id', $training_center)->get();

        return response()->json($batches);
    }
}
