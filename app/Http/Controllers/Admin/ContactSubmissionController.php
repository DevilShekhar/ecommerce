<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactSubmissionController extends Controller
{
    public function index()
    {
        if (Auth::user()->role?->name !== 'SuperAdmin') {
            abort(403, 'Unauthorized action.');
        }

        $submissions = ContactSubmission::with([
            'page',
            'section',
        ])
            ->latest()
            ->paginate(15);

        return view(
            'admin.contact_submissions.index',
            compact('submissions')
        );
    }

    public function store(Request $request, Page $page, PageSection $section)
    {
        if ($section->section_type !== 'contact') {
            abort(404);
        }
        if ($section->page_id !== $page->id) {
            abort(404);
        }
        $fields = is_array($section->form_fields)
            ? $section->form_fields
            : json_decode($section->form_fields ?? '[]', true);

        $rules = [];

        foreach ($fields as $field) {

            $name = $field['name'] ?? null;

            if (! $name) {
                continue;
            }

            $fieldRules = [];

            if (! empty($field['required'])) {
                $fieldRules[] = 'required';
            } else {
                $fieldRules[] = 'nullable';
            }

            switch ($field['type'] ?? 'text') {

                case 'email':
                    $fieldRules[] = 'email';
                    break;

                case 'number':
                    $fieldRules[] = 'numeric';
                    break;

                case 'phone':
                    $fieldRules[] = 'string';
                    break;

                case 'file':
                    $fieldRules[] = 'file';
                    $fieldRules[] = 'max:5120';
                    break;

                case 'select':
                case 'radio':
                case 'checkbox':

                    $options = $field['options'] ?? [];

                    if (is_string($options)) {
                        $options = array_map(
                            'trim',
                            explode(',', $options)
                        );
                    }

                    if (! empty($options)) {
                        $fieldRules[] = 'in:'.implode(',', $options);
                    }

                    break;

                default:
                    $fieldRules[] = 'string';
                    break;
            }

            $rules[$name] = $fieldRules;
        }

        $validator = Validator::make(
            $request->all(),
            $rules
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $submittedData = [];

        foreach ($fields as $field) {

            $name = $field['name'] ?? null;

            if (! $name) {
                continue;
            }

            if ($field['type'] === 'file') {

                if ($request->hasFile($name)) {

                    $submittedData[$name] = $request
                        ->file($name)
                        ->store('contact-submissions', 'public');
                }

            } else {

                $value = $request->input($name);

                // Checkbox can return an array
                if (is_array($value)) {
                    $submittedData[$name] = $value;
                } else {
                    $submittedData[$name] = $value;
                }
            }
        }
        ContactSubmission::create([
            'page_id' => $page->id,
            'page_section_id' => $section->id,
            'data' => $submittedData,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with(
            'success',
            'Thank you for reaching out. We’ve received your message and will get back to you soon.'
        );
    }

    /**
     * Show single submission.
     * Super Admin only.
     */
    public function show(ContactSubmission $submission)
    {
        if (Auth::user()->role?->name !== 'SuperAdmin') {
            abort(403, 'Unauthorized action.');
        }

        $submission->load([
            'page',
            'section',
        ]);

        return view(
            'admin.contact_submissions.show',
            compact('submission')
        );
    }
}
