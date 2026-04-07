<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactMessage;

class ContactController extends Controller
{
    /**
     * Store a newly created contact message in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'district_id' => 'required|exists:districts,id',
            'course' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        try {
            ContactMessage::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'আপনার বার্তাটি সফলভাবে পাঠানো হয়েছে। আমরা শীঘ্রই আপনার সাথে যোগাযোগ করব।'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'দুঃখিত, বার্তাটি পাঠানো যায়নি। আবার চেষ্টা করুন।'
            ], 500);
        }
    }
}
