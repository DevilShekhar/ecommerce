<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactSubmissionController extends Controller
{
    public function index()
    {
        if (Auth::user()->role?->name !== 'SuperAdmin') {
            abort(403, 'Unauthorized action.');
        } $submissions = ContactSubmission::latest('created_at')->paginate(15);

        return view('admin.contact_submissions.index', compact('submissions'));
    }

    public function storeInquiry(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'interest' => 'required|string|max:100',
            'message' => 'required|string|max:5000',
        ]);

        ContactSubmission::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'interest' => $request->interest,
            'message' => $request->message,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Thank you for reaching out. We have received your enquiry.');
    }

   public function show(ContactSubmission $submission)
{
    if (Auth::user()->role?->name !== 'SuperAdmin') {
        abort(403, 'Unauthorized action.');
    }

    return view(
        'admin.contact_submissions.show',
        compact('submission')
    );
}
}
