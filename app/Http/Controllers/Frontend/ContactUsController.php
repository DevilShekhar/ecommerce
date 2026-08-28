<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactUsController extends Controller
{
    public function index()
    {
        $contact = ContactUs::where('status', 1)
            ->latest()
            ->first();

        return view(
            'frontend.contact-us.index',
            compact('contact')
        );
    }

    public function adminIndex()
    {
        $contacts = ContactUs::latest()->get();

        return view('frontend.contact-us.admin-index', compact('contacts'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('frontend.contact-us.create');
    }

    /**
     * Store Contact Us.
     */
    public function store(Request $request)
    {
        $request->validate([
            'contact_sub_title' => 'nullable|string|max:255',
            'contact_title' => 'required|string|max:255',
            'contact_description' => 'required|string',
            'contact_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'contact_phone' => 'nullable|string|max:50',
            'contact_email' => 'nullable|email|max:255',
            'contact_whatsapp_no' => 'nullable|string|max:50',
            'contact_address' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $data = $request->except('contact_image');
        $data['status'] = $request->has('status') ? 1 : 0;
        if ($request->hasFile('contact_image')) {

            $data['contact_image'] = $request
                ->file('contact_image')
                ->store('contact-us', 'public');
        }

        ContactUs::create($data);

        return redirect()
            ->route('admin.contact-us.index')
            ->with('success', 'Contact Us content created successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit($id)
    {
        $contact = ContactUs::findOrFail($id);

        return view('frontend.contact-us.edit', compact('contact'));
    }

    /**
     * Update Contact Us.
     */
    public function update(Request $request, $id)
    {
        $contact = ContactUs::findOrFail($id);

        $request->validate([
            'contact_sub_title' => 'nullable|string|max:255',
            'contact_title' => 'required|string|max:255',
            'contact_description' => 'required|string',
            'contact_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'contact_phone' => 'nullable|string|max:50',
            'contact_email' => 'nullable|email|max:255',
            'contact_whatsapp_no' => 'nullable|string|max:50',
            'contact_address' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $data = $request->except('contact_image');
        $data['status'] = $request->has('status') ? 1 : 0;
        if ($request->hasFile('contact_image')) {
            if (
                $contact->contact_image &&
                Storage::disk('public')->exists($contact->contact_image)
            ) {
                Storage::disk('public')->delete($contact->contact_image);
            }

            $data['contact_image'] = $request
                ->file('contact_image')
                ->store('contact-us', 'public');
        }

        $contact->update($data);

        return redirect()
            ->route('admin.contact-us.index')
            ->with('success', 'Contact Us content updated successfully.');
    }

    /**
     * Delete Contact Us.
     */
    public function destroy($id)
    {
        $contact = ContactUs::findOrFail($id);
        if (
            $contact->contact_image &&
            Storage::disk('public')->exists($contact->contact_image)
        ) {
            Storage::disk('public')->delete($contact->contact_image);
        }
        $contact->delete();

        return redirect()
            ->route('admin.contact-us.index')
            ->with('success', 'Contact Us content deleted successfully.');
    }

    public function storeEnquiry(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'enquiry_type' => 'required|in:general_queries,order_related,product_related',
            'message' => 'required|string|max:5000',
        ]);

        $contact = ContactUs::first();

        if (! $contact) {
            return redirect()
                ->back()
                ->with('error', 'Contact Us record not found.');
        }

        $contact->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'enquiry_type' => $validated['enquiry_type'],
            'message' => $validated['message'],
        ]);

        return redirect()
            ->back()
            ->with('success', 'Your enquiry has been submitted successfully.');
    }
}
