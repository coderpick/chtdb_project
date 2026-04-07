<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ContactMessage;

class AdminMessageController extends Controller
{
    /**
     * Display a listing of the contact messages.
     */
    public function index()
    {
        $messages = ContactMessage::with('district')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Display the specified contact message.
     */
    public function show(ContactMessage $message)
    {
        // Mark as read if it is still new
        if ($message->status === 'new') {
            $message->update(['status' => 'read']);
        }

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Terminate the contact message from storage.
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'বার্তাটি সফলভাবে ডিলিট করা হয়েছে।');
    }
}
